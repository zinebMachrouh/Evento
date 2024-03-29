@extends('layout')

@section('title')
    Dashboard
@endsection

@section('content')
    <div id="app">
        <aside class="app-aside">
            <img src="{{ asset('logo.png') }}" alt="logo">
            <nav>
                <a href="{{ route('client.dashboard') }}" title="All Events" class="n-act"><i
                        class="bi bi-grid-1x2-fill"></i></a>
                <a href="{{ route('client.reservations') }}" title="All Reservations"><i class="fa-solid fa-ticket"></i></a>
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
                <h2>Event Details</h2>
                <div class="container">
                    <div class="event-details">
                        <h2>{{ $event->title }}</h2>
                        <h4>{{ $event->category->name }}</h4>
                        <p>{{ $event->description }}</p>
                        <ul class="features">
                            <li>
                                <span class="icon">
                                    <i class="fa-solid fa-dollar-sign"></i>
                                </span>
                                <span>{{ $event->price }}</span>
                            </li>
                            <li>
                                <span class="icon">
                                    <i class="fa-solid fa-location-dot"></i>
                                </span>
                                <span>{{ $event->location }}</span>
                            </li>
                            <li>
                                <span class="icon">
                                    <i class="fa-regular fa-clock"></i>
                                </span>
                                <span>{{ date('F d Y / H:i', strtotime($event->date)) }}</span>
                            </li>
                            <li>
                                <span class="icon">
                                    <i class="fa-solid fa-ticket"></i>
                                </span>
                                <span>Available Seats : {{ $event->seats }}</span>
                            </li>
                        </ul>
                        <div class="organizer">
                            <h4>Organized By:</h4>
                            <span>{{ $event->user->name }}</span>
                        </div>
                    </div>
                    <div class="more">
                        <h2 style="color: #FFC739 !important;">Similar Events</h2>
                        <div class="events">
                            @foreach ($events as $eve)
                                <div class="event">
                                    <div class="mini">
                                        <h4 style="color: #ffcf54;">{{ $eve->title }}</h4>
                                        <p>{{ $eve->location }}, {{ date('F d Y', strtotime($eve->date)) }}</p>
                                    </div>
                                    <h4>{{ $eve->price }} Dhs</h4>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </article>
    </div>
@endsection
