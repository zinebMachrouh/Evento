<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function index(Event $event){
        return view('organizer.reservations',compact('event'));
    }

    public function confirm(Reservation $reservation)
    {
        $reservation->status = 'confirmed';
        $reservation->save();

        return back()->with('success', 'Reservation confirmed successfully.');
    }

    public function cancel(Reservation $reservation)
    {
        $reservation->status = 'pending';
        $reservation->save();

        return back()->with('success', 'Reservation confirmation cancelled successfully.');
    }

    public function delete(Reservation $reservation)
    {
        $reservation->delete();

        return back()->with('success', 'Reservation deleted successfully.');
    }
}
