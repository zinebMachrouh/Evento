@extends('layout')

@section('title')
    Dashboard
@endsection


@section('content')
    <div id="app">
        <aside class="app-aside">
            <img src="{{ asset('logo.png') }}" alt="logo">
            <nav>
                <a href="{{route('categories.index')}}" title="All Categories" ><i
                        class="bi bi-grid-1x2-fill"></i></a>
                <a href="{{ route('client.dashboard') }}" title="Statistics"><i class="fa-solid fa-chart-pie"></i></a>
                <a href="" title="All Users"><i class="fa-solid fa-users"></i></a>
                <a href="{{route('admin.events')}}" title="All Events" class="n-act"><i class="fa-solid fa-ticket"></i></a>
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

                </div>
            </div>
            <div class="article-main">
                <h2>All Events</h2>
                <table>
                    <thead>
                        <th>#</th>
                        <th>Event</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Location</th>
                        <th>Date / Time</th>
                        <th>Total Seats</th>
                        <th>Organizer</th>
                        <th>Actions</th>
                    </thead>
                    <tbody>
                        @foreach ($events as $event)
                            <tr>
                                <td>#</td>
                                <td>{{ $event->title }}</td>
                                <td>{{ $event->category->name }}</td>
                                <td>{{ $event->price }}</td>
                                <td>{{ $event->location }}</td>
                                <td> {{ date('F d Y / H:i', strtotime($event->date)) }}</td>
                                <td>{{ $event->totalSeats }}</td>
                                <td>{{ $event->user->name }}</td>
                                <td class="table-actions">
                                    <a href="{{ route('event.confirm', $event) }}" class="confirm"><i
                                            class="fa-solid fa-check"></i></a>
                                    <form action="{{ route('event.delete', $event) }}" method="POST">
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
