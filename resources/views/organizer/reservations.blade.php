@extends('layout')

@section('title')
    Reservations
@endsection

@section('content')
    <div id="app">
        <aside class="app-aside">
            <img src="{{ asset('logo.png') }}" alt="logo">
            <nav>
                <a href="{{ route('organizer.dashboard') }}" title="All Events" class="n-act"><i
                        class="bi bi-grid-1x2-fill"></i></a>
                <a href="{{ route('organizer.statistics') }}" title="Statistics"><i class="fa-solid fa-chart-pie"></i></a>
                <a href="{{ route('event.create') }}" title="Add Event"><i class="bi bi-plus-lg"></i></a>
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
                        <img src="{{ asset(Auth::user()->picture) }}" alt="profile picture" class="profilePic">
                    </div>
                </div>
            </div>
            <div class="article-main">
                <h2>{{ $event->title }}</h2>
                <table>
                    <thead>
                        <th>#</th>
                        <th>Client Name</th>
                        <th>Client Email</th>
                        <th>Reservation Time</th>
                        <th>Reservation Status</th>
                        @if ($event->setting === 0)
                            <th>Actions</th>
                        @else
                            <th></th>
                        @endif
                    </thead>
                    <tbody>
                        @foreach ($event->reservations as $reserv)
                            <tr>
                                <td>#</td>
                                <td>{{ $reserv->user->name }}</td>
                                <td>{{ $reserv->user->email }}</td>
                                <td>{{ date('F d Y / H:i', strtotime($reserv->created_at)) }}</td>
                                <td>{{ $reserv->status }}</td>
                                <td class="table-actions">
                                    @if ($event->setting === 0)
                                        @if ($reserv->status == 'pending')
                                            <a href="{{ route('reservation.confirm', $reserv) }}" class="confirm"><i
                                                    class="fa-solid fa-check"></i></a>
                                        @elseif($reserv->status == 'confirmed')
                                            <a href="{{ route('reservation.cancel', $reserv) }}" class="cancel"><i
                                                    class="fa-solid fa-ban"></i></a>
                                        @endif
                                    @endif
                                    <form action="{{ route('reservation.delete', $reserv) }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button type="submit"><i class="fa-solid fa-xmark"></i></button>
                                    </form>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </article>
    </div>
@endsection
