@extends('layout')

@section('title')
    Welcome
@endsection

@section('content')
    <section class="article">
        <header id="welcome">
            <h2>EVENT<img src="{{ asset('logo.png') }}" alt="logo"></h2>
            <nav>
                <a href="#">Home</a>
                <a href="#">Dashboard</a>
                <a href="#">Blog</a>
                <a href="#">About</a>
                <a href="#">Contact</a>
                @if (Route::has('login'))
                    <div>
                        @auth
                            
                        @else
                            <a href="{{ route('login') }}">Log in</a>

                        @endauth
                    </div>
                @endif
            </nav>
            @auth
                <a href="{{ url('organizer/dashboard') }}" class="active">Dashboard</a>
            @else
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="active">Register</a>
                @endif
            @endauth
                <span onclick="openNav()" class="open"><i class="fa-solid fa-bars-staggered"></i></span>
            </header>
            <div id="mySidenav" class="sidenav">
                <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                <a href="#" class="first">Home</a>
                <a href="#">Dashboard</a>
                <a href="#">Blog</a>
                <a href="#">About</a>
                <a href="#">Contact</a>
                @auth
                    <a href="{{ url('/dashboard') }}">Dashboard</a>
                @else
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}">Register</a>
                    @endif
                    <a href="{{ route('login') }}">Log in</a>
                @endauth
            </div>
            <main id="hero-section">
                <div class="left-hero">
                    <h1>Welcome to Evento – Your Trusted Partner for Premium Events!</h1>
                    <p>Experience seamless event discovery, booking, and ticket creation, all in one platform. Trust Evento for
                        memorable moments, as your satisfaction is our utmost priority</p>
                    <div class="botonat">
                        <a href="#">Explore Now</a>
                        <a href="#">Contact Us</a>
                    </div>
                    <div class="mini-cards">
                        <div class="mini-card">
                            <h4>+5000</h4>
                            <span>Clients</span>
                        </div>
                        <div class="mini-card">
                            <h4>+1500</h4>
                            <span>Events</span>
                        </div>
                        <div class="mini-card">
                            <h4>+200</h4>
                            <span>Organizers</span>
                        </div>
                    </div>
                </div>
                <div class="right-hero">
                    <img src="{{ asset('assets/right1.png') }}" alt="">
                </div>
            </main>
        </section>
    @endsection
