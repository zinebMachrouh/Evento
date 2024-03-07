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
                <h2>All Events</h2>
                <div class="cards">
                    @foreach ($events as $event)
                        <div class="plan">
                            <div class="inner">
                                <span class="pricing">
                                    <span>{{ $event->price }} Dhs</span>
                                </span>
                                <div class="content">
                                    <h4 class="sub-title">{{ $event->category->name }}</h4>
                                    <p class="card-title">{{ $event->title }}</p>
                                    <p class="info">{{ $event->description }}</p>

                                </div>
                                <ul class="features">
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
                                <div class="actions">
                                    <a href="{{ route('event.reserve', $event) }}" class="request">Reserve Place</a>
                                    <a href="{{route('event.details',$event)}}" class="modify"><i
                                            class="fa-solid fa-arrow-up-right-from-square"></i></a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="pagination">
                {{ $events->links() }}
            </div>
        </article>
    </div>
@endsection
