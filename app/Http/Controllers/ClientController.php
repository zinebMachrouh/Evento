<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        $events = Event::where('status', 'confirmed')->where('seats', '<>', 0)->paginate(9);
        return view('client.dashboard', compact('events'));
    }
}
