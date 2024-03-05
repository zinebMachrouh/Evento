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
        $data = [
            'totalEvents' => Event::count(),
            'confirmedEvents' => Event::where('status','confirmed')->count(),
            'pendingEvents' => Event::where('status','pending')->count(),
            'totalReservations' => Reservation::count(),
            'uniqueUsers' => Reservation::distinct('user_id')->count('user_id'),
        ];

        return view('organizer.statistics', compact('data'));
    }
}
