@extends('layout')

@section('title')
    Dashboard
@endsection

@section('content')
        <div id="app">
        <aside class="app-aside">
            <h2><img src="{{ asset('light-logo.png') }}" alt="logo"></h2>
            <nav>
                <a href="#" title="All Applicants" class="active"><i
                        class="bi bi-grid-1x2-fill"></i></a>
                <a href="#" title="All Jobs"><i class="bi bi-file-earmark"></i>
                <a href="#" title="Add Offer"><i class="bi bi-plus-lg"></i></a>
            </nav>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"><i class="fa-solid fa-right-from-bracket"></i></button>
            </form>
        </aside>
        <article class="app-art">
            <div class="article-header">
                <h1>Hello {{ Auth::user()->name }}</h1>
            </div>
            <div class="article-main">
                <h2>All Events</h2>
                <div class="cards">
                    {{-- @foreach ($applicants as $app)
                        <div class="plan">
                            <div class="inner">
                                <span class="pricing">
                                    @foreach ($app->jobs as $job)
                                        <span>{{ $job->title }}</span>
                                    @endforeach
                                </span>
                                <div class="content">
                                    <h4 class="sub-title">{{ $app->title }}</h4>
                                    <p class="title">{{ $app->fname }} {{ $app->lname }}</p>
                                    <p class="info">{{ $app->about }}</p>

                                </div>
                                <ul class="features">
                                    <li>
                                        <span class="icon">
                                            <svg height="24" width="24" viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path d="M0 0h24v24H0z" fill="none"></path>
                                                <path fill="currentColor"
                                                    d="M10 15.172l9.192-9.193 1.415 1.414L10 18l-6.364-6.364 1.414-1.414z">
                                                </path>
                                            </svg>
                                        </span>
                                        <span>{{ $app->user->email }}</span>
                                    </li>
                                    <li>
                                        <span class="icon">
                                            <svg height="24" width="24" viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path d="M0 0h24v24H0z" fill="none"></path>
                                                <path fill="currentColor"
                                                    d="M10 15.172l9.192-9.193 1.415 1.414L10 18l-6.364-6.364 1.414-1.414z">
                                                </path>
                                            </svg>
                                        </span>
                                        <span>0{{ $app->user->phoneNumber }}</span>
                                    </li>
                                    <li>
                                        <span class="icon">
                                            <svg height="24" width="24" viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path d="M0 0h24v24H0z" fill="none"></path>
                                                <path fill="currentColor"
                                                    d="M10 15.172l9.192-9.193 1.415 1.414L10 18l-6.364-6.364 1.414-1.414z">
                                                </path>
                                            </svg>
                                        </span>
                                        <span>{{ $app->currentPost }}</span>
                                    </li>
                                </ul>
                                <div class="action">
                                    <a href="{{ route('downloadCV', $app->user) }}" target="_blank" class="request">Download CV</a>
                                </div>
                            </div>
                        </div>
                    @endforeach --}}
                </div>
            </div>
        </article>
    </div>
@endsection