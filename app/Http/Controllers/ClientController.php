<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        $events = Event::where('status', 'confirmed')->where('seats', '<>', 0)->paginate(9);
        return view('client.dashboard', compact('events'));
    }

    public function show()
    {
        $users = User::withCount(['reservations', 'tickets'])
        ->where('role_id', 3)
        ->get();

        return view('admin.users', compact('users'));
    }

    public function ban(User $user){
        $user->delete();
        return back()->with('success', 'Client Banned successfully.');
    }
}
