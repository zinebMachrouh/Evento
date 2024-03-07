<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Event;
use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::where('user_id', Auth::user()->id)->paginate(9);

        return view('organizer.dashboard', compact('events'));
    }

    public function create()
    {
        $categories = Category::get();
        return view('organizer.addEvent', compact('categories'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'date' => ['required', 'date', function ($attribute, $value, $fail) {
                if (Carbon::parse($value)->lt(now())) {
                    $fail("The $attribute must be a date and time not earlier than now.");
                }
            },],
            'location' => 'required|string',
            'totalSeats' => 'required|min:0|integer',
            'category_id' => 'required',
            'setting' => 'required',
            'price' => 'required',
        ]);

        $event = Event::create([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'date' => $validatedData['date'],
            'location' => $validatedData['location'],
            'totalSeats' => $validatedData['totalSeats'],
            'category_id' => $validatedData['category_id'],
            'user_id' => Auth::user()->id,
            'setting' => $validatedData['setting'],
            'price' => $validatedData['price'],
        ]);

        $event->seats = $event->totalSeats;
        $event->save();

        return redirect()->route('organizer.dashboard');
    }

    public function update(Event $event)
    {
        $categories = Category::get();

        return view('organizer.modifyEvent', compact('event', 'categories'));
    }


    public function modify(Request $request, Event $event)
    {
        $validatedData = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'date' => ['required', 'date', function ($attribute, $value, $fail) {
                if (Carbon::parse($value)->lt(now())) {
                    $fail("The $attribute must be a date and time not earlier than now.");
                }
            },],
            'location' => 'required|string',
            'totalSeats' => 'required|min:0|integer',
            'category_id' => 'required',
            'setting' => 'required',
            'price' => 'required',
        ]);
        
        $event->updateTotalSeats($validatedData['totalSeats']);

        $event->update([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'date' => $validatedData['date'],
            'location' => $validatedData['location'],
            'category_id' => $validatedData['category_id'],
            'setting' => $validatedData['setting'],
            'price' => $validatedData['price'],
        ]);

        return redirect()->route('organizer.dashboard');
    }

    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()->route('organizer.dashboard');
    }
    public function details(Event $event)
    {
        $events = Event::where('category_id',$event->category_id)->where('id','<>',$event->id)->limit(10)->get();
        return view('client.details', compact('event','events'));
    }
}
