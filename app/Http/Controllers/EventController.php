<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Event;
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
            'seats' => 'required',
            'category_id' => 'required',
            'setting' => 'required',
            'price' => 'required',
        ]);

        Event::create([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'date' => $validatedData['date'],
            'location' => $validatedData['location'],
            'seats' => $validatedData['seats'],
            'category_id' => $validatedData['category_id'],
            'user_id' => Auth::user()->id,
            'setting' => $validatedData['setting'],
            'price' => $validatedData['price'],
        ]);

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
            'seats' => 'required',
            'category_id' => 'required',
            'setting' => 'required',
            'price' => 'required',
        ]);

        $event->update([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'date' => $validatedData['date'],
            'location' => $validatedData['location'],
            'seats' => $validatedData['seats'],
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
}
