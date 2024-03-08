@extends('layout')

@section('title')
    Dashboard
@endsection

@section('content')
    <div id="app">
        <aside class="app-aside">
            <img src="{{ asset('logo.png') }}" alt="logo">
            <nav>
                <a href="{{ route('categories.index') }}" title="All Categories"><i class="bi bi-grid-1x2-fill"></i></a>
                <a href="{{ route('admin.dashboard') }}" title="Statistics" ><i
                        class="fa-solid fa-chart-pie"></i></a>
                <a href="{{route('admin.users')}}" title="All Users" class="n-act"><i class="fa-solid fa-users"></i></a>
                <a href="{{ route('admin.events') }}" title="All Events"><i class="fa-solid fa-ticket"></i></a>
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
                <h2>All Users</h2>
                <div class="cards">
                    @foreach ($users as $user)
                    <div class="card">
                            <div class="infos">
                                <div class="image">
                                    <img src="{{ asset('storage/' . $user->picture) }}" alt="picture">
                                </div>
                                <div class="comp">
                                    <div>
                                        <p class="name">
                                            {{ $user->name }}
                                        </p>
                                        <p class="function">
                                            {{ $user->email }}
                                        </p>
                                    </div>
                                    <div class="stats">
                                        <p class="flex flex-col">
                                            Reservations
                                            <span class="state-value">
                                                {{$user->reservations_count}}
                                            </span>
                                        </p>
                                        <p class="flex">
                                            Tickets
                                            <span class="state-value">
                                                {{$user->tickets_count}}
                                            </span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div >
                                <form action="{{ route('user.ban', $user) }}" method="POST" class="ban">
                                @csrf
                                @method('delete')
                                <button type="submit">Ban User</button>
                            </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </article>
    </div>
@endsection
