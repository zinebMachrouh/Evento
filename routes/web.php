<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\OrganizerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
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

require __DIR__.'/auth.php';

Route::get('/login/google', [SocialteController::class, 'redirectToGoogle'])->name('google');
Route::get('/login/google/callback', [SocialteController::class, 'handleGoogleCallback'])->name('google.test');

Route::get('/auth/facebook', [SocialteController::class, 'redirectToFacebook'])->name('facebook');
Route::get('/auth/facebook/callback', [SocialteController::class, 'handleFacebookCallback']);

Route::middleware(['auth', 'role:admin'])->group(function () {
    
});

Route::middleware(['auth', 'role:organizer'])->group(function () {
    Route::get('/organizer/dashboard', [EventController::class, 'index'])->name('organizer.dashboard');
    Route::get('/event/create', [EventController::class, 'create'])->name('event.create');
    Route::post('/event/store', [EventController::class, 'store'])->name('event.store');

});

Route::middleware(['auth', 'role:client'])->group(function () {
    
});