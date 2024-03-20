<?php

namespace App\Http\Controllers;

use App\Mail\TicketEmail;
use App\Models\Event;
use App\Models\Reservation;
use App\Models\Ticket;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

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
        $this->ticket($reservation,$reservation->event);
        $reservation->event->decrement('seats', 1);

        $reservation->save();

        return back()->with('success', 'Reservation confirmed successfully.');
    }

    public function cancel(Reservation $reservation)
    {
        $reservation->status = 'pending';
        $reservation->event->increment('seats', 1);
        $reservation->seatNumber = NULL;
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

    public function generateSeat(Reservation $reserv, Event $event)
    {
        $eventSeats = $event->totalSeats;
        do {
            $seatNum = mt_rand(1, $eventSeats);
            $exists = Reservation::where('event_id', $event->id)->where('seatNumber', $seatNum)->exists();
        } while ($exists);
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
            $this->generateSeat($reserv, $event);
            $this->ticket($reserv,$event);
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
    public function ticket(Reservation $reservation, Event $event){
        $ticket = Ticket::create([
            'reservation_id' => $reservation->id,
            'path' => 'path',
            'unique_id' => Hash::make($event->id . $reservation->id),
        ]);


        $pdf = Pdf::loadView('client.tickets.template', ['ticket' => $ticket,'reservation'=>$reservation, 'event'=> $event]);

        $pdfPath = 'tickets/' . $ticket->id . '.pdf';
        $fullPath = public_path('storage/' . $pdfPath);

        $directoryPath = dirname($fullPath);
        if (!is_dir($directoryPath)) {
            mkdir($directoryPath, 0755, true);
        }
        $pdf->save($fullPath);
        $ticket->update(['path' => $fullPath]);
    }

    public function downloadTicketPdf(Ticket $ticket)
    {
        if (!$ticket->path) {
            abort(404, 'Ticket PDF not found');
        }
        $fileName = 'ticket_' . $ticket->id . '.pdf';
        return Response::download($ticket->path, $fileName);
    }
}
