@extends('layout')

@section('title')
    Dashboard
@endsection

@section('content')
    <div id="app">
        <aside class="app-aside">
            <img src="{{ asset('logo.png') }}" alt="logo">
            <nav>
                <a href="{{ route('client.dashboard') }}" title="All Events"><i class="bi bi-grid-1x2-fill"></i></a>
                <a href="{{ route('client.reservations') }}" title="All Reservations" class="n-act"><i
                        class="fa-solid fa-ticket"></i></a>
                <a href="#" title="Statistics"><i class="fa-solid fa-chart-pie"></i></a>
            </nav>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"><i class="fa-solid fa-right-from-bracket"></i></button>
            </form>
        </aside>
        <article class="app-art">
            <div class="article-header">
                <h1>Hello {{ Auth::user()->name }}</h1>
                <div class="header-right">
                    <form action="#" method="GET" class="search-bar">
                        <input type="text" name="search" id="search"
                            placeholder="Find The Perfect Event..."{{ request('search') }}>
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </form>
                    <div class="profile">
                        <img src="{{ asset('storage/' . Auth::user()->picture) }}" alt="profile picture" class="profilePic">
                    </div>
                </div>
            </div>
            <div class="article-main">
                <h2>All Events</h2>
                <div class="reservations">
                    <table>
                        <thead>
                            <th>#</th>
                            <th>Event</th>
                            <th>Seat</th>
                            <th>Reservation Time</th>
                            <th>Reservation Status</th>
                            <th>Actions</th>
                        </thead>
                        <tbody>
                            @foreach ($reservations as $reserv)
                                <tr>
                                    <td>#</td>
                                    <td><strong>{{ $reserv->event->title }}</strong></td>
                                    <td>{{ $reserv->seatNumber ?? '-' }}</td>
                                    <td>{{ date('F d Y / H:i', strtotime($reserv->created_at)) }}</td>
                                    <td>{{ $reserv->status }}</td>
                                    <td class="table-actions">
                                        @if ($reserv->status === 'confirmed')
                                            <a href="{{route('downloadTicketPdf',$reserv->ticket)}}" class="ticket"><i class="fa-solid fa-ticket"></i></a>
                                            <form action="{{ route('reservation.destroy', $reserv) }}" method="POST">
                                                @csrf
                                                @method('delete')
                                                <button type="submit"><i class="fa-solid fa-xmark"></i></button>
                                            </form>
                                        @else
                                            <form action="{{ route('reservation.destroy', $reserv) }}" method="POST">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" style="width: fit-content !important; padding:0px 22px !important;">Delete</button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </article>
    </div>
@endsection
