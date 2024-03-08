@extends('layout')

@section('title')
    Modify Event
@endsection

@section('content')
    <div id="login-body">
        <a href="{{ route('organizer.dashboard') }}" class="back">
            <i class="fa-solid fa-arrow-left"></i>
        </a>
        <div class="form-container">
            <h2 class="title">EVENT<img src="{{ asset('logo.png') }}" alt="logo" style="width: 21px;"></h2>
            <form class="form" method="POST" action="{{ route('event.modify', $event->id) }}">
                @csrf
                @method('PUT')
                <div class="input-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" placeholder="Enter Title"
                        value="{{ $event->title }}">
                </div>
                <div class="input-group">
                    <label for="description">Description</label>
                    <input type="text" name="description" id="description" placeholder="Enter Description"
                        value="{{ $event->description }}">
                </div>
                <div class="input-group">
                    <label for="date">Date</label>
                    <input type="datetime-local" name="date" id="date" placeholder="Enter Date"
                        value="{{ $event->date }}">
                </div>
                <div class="input-group">
                    <label for="location">Location</label>
                    <input type="text" name="location" id="location" placeholder="Enter Location"
                        value="{{ $event->location }}">
                </div>
                <div style="display: flex; align-items: center; justify-content: space-between;">
                    <div class="input-group" style="margin: 0px !important;">
                        <label for="price">Price</label>
                        <input type="number" name="price" id="price" placeholder="Enter Price"
                            value="{{ $event->price }}">
                    </div>
                    <div class="input-group" style="margin: 0px !important;">
                        <label for="totalSeats">Seats</label>
                        <input type="number" name="totalSeats" id="totalSeats" placeholder="Enter Seats"
                            value="{{ $event->seats }}">
                    </div>
                </div>
                <div class="input-group">
                    <label for="category_id">Category</label>
                    <select name="category_id" id="category_id">
                        <option value="" hidden>Pick A Category</option>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat->id }}" {{ $cat->id == $event->category_id ? 'selected' : '' }}>
                                {{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="roles">
                    <span>Validation :</span>
                    <label>
                        <input type="radio" name="setting" value="1" required
                            {{ $event->setting == 1 ? 'checked' : '' }}>
                        Automatic
                    </label>
                    <label>
                        <input type="radio" name="setting" value="0" required
                            {{ $event->setting == 0 ? 'checked' : '' }}>
                        Manual
                    </label>
                </div>
                <div class="buttons">
                    <button class="modi" type="submit">Modify Event</button>
                </div>
            </form>
            <form action="{{ route('event.destroy', $event->id) }}" method="POST" class="delete">
                @csrf
                @method('delete')
                <button type="submit">Delete Event</button>
            </form>
        </div>
    </div>
@endsection
