<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\OrganizerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\SocialteController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::get('/login/google', [SocialteController::class, 'redirectToGoogle'])->name('google');
Route::get('/login/google/callback', [SocialteController::class, 'handleGoogleCallback'])->name('google.test');

Route::get('/auth/facebook', [SocialteController::class, 'redirectToFacebook'])->name('facebook');
Route::get('/auth/facebook/callback', [SocialteController::class, 'handleFacebookCallback']);

Route::get('/dashboard', [ProfileController::class, 'dashboard'])->name('dashboard')->middleware('auth');

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'statistics'])->name('admin.dashboard');
    Route::get('/admin/events', [AdminController::class, 'index'])->name('admin.events');
    Route::get('/event/confirm/{event}', [EventController::class, 'confirm'])->name('event.confirm');
    Route::delete('/event/delete/{event}', [EventController::class, 'delete'])->name('event.delete');
    Route::get('/admin/dashboard', [AdminController::class, 'statistics'])->name('admin.dashboard');
    Route::get('/admin/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::post('/category/store', [CategoryController::class, 'store'])->name('categories.store');
    Route::put('/category/update/{category}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/category/delete/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
    Route::delete('/user/ban/{user}', [ClientController::class, 'ban'])->name('user.ban');
    Route::get('/admin/users', [ClientController::class, 'show'])->name('admin.users');

});

Route::middleware(['auth', 'role:organizer'])->group(function () {
    Route::get('/organizer/dashboard', [EventController::class, 'index'])->name('organizer.dashboard');
    Route::get('/event/create', [EventController::class, 'create'])->name('event.create');
    Route::post('/event/store', [EventController::class, 'store'])->name('event.store');
    Route::get('/event/update/{event}', [EventController::class, 'update'])->name('event.update');
    Route::put('/event/modify{event}', [EventController::class, 'modify'])->name('event.modify');
    Route::delete('/event/destroy/{event}', [EventController::class, 'destroy'])->name('event.destroy');
    Route::get('/organizer/statistics', [OrganizerController::class, 'statistics'])->name('organizer.statistics');
    Route::get('/event/reservations/{event}', [ReservationController::class, 'index'])->name('event.reservations');
    Route::delete('/reservation/delete/{reservation}', [ReservationController::class, 'delete'])->name('reservation.delete');
    Route::get('/reservation/confirm/{reservation}', [ReservationController::class, 'confirm'])->name('reservation.confirm');
    Route::get('/reservation/cancel/{reservation}', [ReservationController::class, 'cancel'])->name('reservation.cancel');
});

Route::middleware(['auth', 'role:client'])->group(function () {
    Route::get('/client/dashboard', [ClientController::class, 'index'])->name('client.dashboard');
    Route::get('/event/reserve/{event}', [ReservationController::class, 'reserve'])->name('event.reserve');
    Route::get('/event/details/{event}', [EventController::class, 'details'])->name('event.details');
    Route::delete('/reservation/destroy/{reservation}', [ReservationController::class, 'delete'])->name('reservation.destroy');
    Route::get('/client/reservations', [ReservationController::class, 'show'])->name('client.reservations');
    Route::get('/events/search', [EventController::class, 'search'])->name('events.search');

});
