@extends('layout')

@section('title')
    Create Event
@endsection

@section('content')
    <div id="login-body">
        <a href="{{ route('organizer.dashboard') }}" class="back">
            <i class="fa-solid fa-arrow-left"></i>
        </a>
        <div class="form-container">
            <h2 class="title">EVENT<img src="{{ asset('logo.png') }}" alt="logo" style="width: 21px;"></h2>
            <form class="form" method="POST" action="{{ route('event.store') }}">
                @csrf
                <div class="input-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" placeholder="Enter Title">
                </div>
                <div class="input-group">
                    <label for="description">Description</label>
                    <input type="text" name="description" id="description" placeholder="Enter Description">
                </div>
                <div class="input-group">
                    <label for="date">Date</label>
                    <input type="datetime-local" name="date" id="date" placeholder="Enter Date">
                </div>
                <div class="input-group">
                    <label for="location">Location</label>
                    <input type="text" name="location" id="location" placeholder="Enter Location">
                </div>
                <div style="display: flex; align-items: center; justify-content: space-between;">
                    <div class="input-group">
                        <label for="price">Price</label>
                        <input type="number" name="price" id="price" placeholder="Enter Price">
                    </div>

                    <div class="input-group" style="margin: 0px !important;">
                        <label for="seats">Seats</label>
                        <input type="number" name="seats" id="seats" placeholder="Enter Seats">
                    </div>

                </div>
                <div class="input-group">
                    <label for="category_id">Category</label>
                    <select name="category_id" id="category_id">
                        <option value="" hidden>Pick A Category</option>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="roles">
                    <span>Validation :</span>
                    <label>
                        <input type="radio" name="setting" value="1" required>
                        Automatic
                    </label>
                    <label>
                        <input type="radio" name="setting" value="0" required>
                        Manual
                    </label>
                </div>

                <button class="sign">Create Event</button>
            </form>


        </div>
    </div>
@endsection
