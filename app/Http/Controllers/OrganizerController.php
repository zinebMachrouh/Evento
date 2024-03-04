<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrganizerController extends Controller
{
    public function index(){
        $events = Event::where('user_id',Auth::user()->id)->paginate(9);

        return view('organizer.dashboard', compact('events'));
    }
}
