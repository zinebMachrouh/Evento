<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        $events = Event::where('status','pending')->get();
        return view('admin.events', compact('events'));

    }
    public function statistics(){
        $data = [
            'totalEvents' => Event::count(),
            'confirmedEvents' => Event::where('status', 'confirmed')->count(),
            'pendingEvents' => Event::where('status', 'pending')->count(),
            'totalUsers' => User::where('role_id', 3)->count(),
        ];
        return view('admin.dashboard', compact('data'));

    }
}
