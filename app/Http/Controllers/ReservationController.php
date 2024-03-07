<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Reservation;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ReservationController extends Controller
{
    public function index(Event $event)
    {
        return view('organizer.reservations', compact('event'));
    }

    public function confirm(Reservation $reservation)
    {
        $reservation->status = 'confirmed';
        $this->generateSeat($reservation, $reservation->event);

        $ticket = Ticket::create([
            'reservation_id' => $reservation->id,
            'path' => 'path',
            'unique_id' => Hash::make($reservation->event->id . $reservation->id),
        ]);
        $reservation->event->decrement('seats', 1);

        $reservation->save();

        return back()->with('success', 'Reservation confirmed successfully.');
    }

    public function cancel(Reservation $reservation)
    {
        $reservation->status = 'pending';
        $reservation->event->increment('seats', 1);
        $reservation->save();

        return back()->with('success', 'Reservation confirmation cancelled successfully.');
    }

    public function delete(Reservation $reservation)
    {
        $reservation->delete();
        if ($reservation->status === 'confirmed') {
            $reservation->event->increment('seats', 1);
        }
        return back()->with('success', 'Reservation deleted successfully.');
    }

    public function generateSeat(Reservation $reserv, Event $event) {
        $eventSeats = $event->seats;
        $taken = Reservation::where('event_id', $event->id)
            ->pluck('seatNumber')
            ->toArray();
        do {
            $seatNum = mt_rand(1, $eventSeats);
        } while (in_array($seatNum, $taken));
        $reserv->seatNumber = $seatNum;
        $reserv->save();
    }

    public function reserve(Event $event)
    {
        $status = $event->setting ? 'confirmed' : 'pending';

        $reserv = Reservation::create([
            'user_id' => Auth::user()->id,
            'event_id' => $event->id,
            'status' => $status,
        ]);

        if ($reserv->status === 'confirmed') {
            $this->generateSeat($reserv,$event);

            $ticket = Ticket::create([
                'reservation_id' => $reserv->id,
                'path' => 'path',
                'unique_id' => Hash::make($event->id . $reserv->id),
            ]);
        }

        if ($event->setting) {
            $event->decrement('seats', 1);
        }
        return back()->with('success', 'Reservation deleted successfully.');
    }

    public function show()
    {
        $reservations = Reservation::where('user_id', Auth::user()->id)->orderBy('updated_at', 'desc')->get();
        return view('client.reservations', compact('reservations'));
    }
}
