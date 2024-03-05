<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Event;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrganizerController extends Controller
{
    public function statistics()
    {
        $userId = Auth::user()->id; 

        $events = Event::where('user_id', $userId)->get();

        $data = [
            'totalEvents' => $events->count(),
            'confirmedEvents' => $events->where('status', 'confirmed')->count(),
            'pendingEvents' => $events->where('status', 'pending')->count(),
            'totalReservations' => Reservation::whereIn('event_id', $events->pluck('id'))->count(),
            'uniqueUsers' => Reservation::whereIn('event_id', $events->pluck('id'))->distinct('user_id')->count('user_id'),
        ];
        return view('organizer.statistics', compact('data'));
    }
}
