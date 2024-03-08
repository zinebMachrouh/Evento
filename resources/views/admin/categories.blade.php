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
                <a href="{{ route('client.dashboard') }}" title="Statistics" class="n-act"><i
                        class="fa-solid fa-chart-pie"></i></a>
                <a href="" title="All Users"><i class="fa-solid fa-users"></i></a>
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
                    <form action="{{ route('categories.store') }}" method="POST" class="search-bar">
                        @csrf
                        <input type="text" name="name" id="name" placeholder="Create Category...">
                        <i class="fa-solid fa-plus"></i>
                    </form>

                </div>
            </div>
            <div class="article-main">
                <h2>Categories</h2>
                <div class="cards">
                    @foreach ($categories as $category)
                        <div class="cat">
                            <form action="{{ route('categories.destroy', $category) }}" method="POST">
                                @csrf
                                @method('delete')
                                <button type="submit"><i class="fa-solid fa-xmark"></i></button>
                            </form>
                            <form action="{{route('categories.update', $category)}}" method="post">
                                @csrf
                                @method('PUT')
                                <input type="text" name="name" id="{{$category->id}}" value="{{$category->name}}" onclick="displayButton({{$category->id}})">
                                <button type="submit" class="hidden"><i class="fa-solid fa-pen"></i></button>
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>
        </article>
    </div>
@endsection

@section('script')
    <script>
        function displayButton(id) {
            const input = document.getElementById(id);
            const button = input.nextElementSibling;

            button.classList.toggle('hidden')
        }

    </script>
@endsection