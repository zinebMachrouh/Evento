@extends('layout')

@section('title')
    Statistics
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script defer>
        document.addEventListener('DOMContentLoaded', function() {
            var ctx = document.getElementById('myChart').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Total Events', 'Confirmed Events', 'Pending Events', 'Total Reservations',
                        'Total Unique Users'
                    ],
                    datasets: [{
                        label: 'Evento',
                        data: {!! json_encode(array_values($data)) !!},
                        backgroundColor: [
                            '#FFC73974',
                            '#9A7AFC74',
                            '#a78bfa74',
                            '#BCA7FA74',
                            '#CCBCFA74',
                        ],
                        borderColor: [
                            '#FFC739',
                            '#9A7AFC',
                            '#a78bfa',
                            '#BCA7FA',
                            '#CCBCFA',
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
@endsection

@section('content')
    <div id="app">
        <aside class="app-aside">
            <img src="{{ asset('logo.png') }}" alt="logo">
            <nav>
                <a href="{{ route('organizer.dashboard') }}" title="All Events"><i class="bi bi-grid-1x2-fill"></i></a>
                <a href="{{ route('organizer.statistics') }}" title="Statistics" class="n-act"><i
                        class="fa-solid fa-chart-pie"></i></a>
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
                        <img src="{{ asset('storage/' . Auth::user()->picture) }}" alt="profile picture" class="profilePic">
                    </div>
                </div>
            </div>
            <div class="article-main">
                <h2>Statistics</h2>
                <canvas id="myChart" width="400" height="190"></canvas>
            </div>
        </article>
    </div>
@endsection
