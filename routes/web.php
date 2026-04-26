<?php

use App\Http\Controllers\Artist\ProfileController;
use App\Http\Controllers\Artist\TrackController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\OAuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\Organiser\ArtistBrowseController;
use App\Http\Controllers\Organiser\EventController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route(auth()->user()->role->value . '.dashboard');
    }
    return view('welcome');
})->name('home');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');



Route::middleware('auth')->group(function () {
    Route::get('/email/verify', [EmailVerificationController::class, 'notice'])->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', [EmailVerificationController::class, 'verify'])->middleware('signed')->name('verification.verify');
    Route::post('/email/verification-notification', [EmailVerificationController::class, 'send'])->middleware('throttle:6,1')->name('verification.send');
});



//OAuth routes
Route::get('/auth/google', [OAuthController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/auth/google/callback', [OAuthController::class, 'handleGoogleCallback'])->name('auth.google.callback');
Route::get('/auth/select-role', [OAuthController::class, 'showSelectRole'])->middleware('auth')->name('auth.select-role');
Route::post('/auth/select-role', [OAuthController::class, 'storeRole'])->middleware('auth')->name('auth.store-role');


//Organiser routes
Route::middleware(['auth', 'verified', 'role:organiser'])
    ->prefix('organiser')
    ->name('organiser.')
    ->group(function () {
        Route::get('/dashboard', fn() => view('organiser.dashboard'))->name('dashboard');

        Route::get('/profile', [App\Http\Controllers\Organiser\ProfileController::class, 'show'])->name('profile');
        Route::get('/profile/edit', [App\Http\Controllers\Organiser\ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/profile', [App\Http\Controllers\Organiser\ProfileController::class, 'update'])->name('profile.update');

        Route::get('/inbox', fn() => view('organiser.inbox'))->name('inbox');

        Route::get('/artists', [ArtistBrowseController::class, 'index'])->name('artists.index');
        Route::get('/artists/{artist}', [ArtistBrowseController::class, 'show'])->name('artists.show');

        Route::resource('events', EventController::class);
        Route::patch('/events/{event}/publish', [EventController::class, 'publish'])->name('events.publish');
        Route::patch('/events/{event}/cancel', [EventController::class, 'cancel'])->name('events.cancel');

        Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
    });

// Audience routes
Route::middleware(['auth', 'role:audience', 'verified'])
    ->prefix('audience')
    ->name('audience.')
    ->group(function () {
        Route::get('/dashboard', function () {return view('audience.dashboard');})->name('dashboard');
        Route::get('/events', function () {return view('audience.events');})->name('events');
    });

//Artist routes
Route::middleware(['auth', 'verified', 'role:artist'])
    ->prefix('artist')
    ->name('artist.')
    ->group(function () {
        Route::get('/dashboard', fn() => view('artist.dashboard'))->name('dashboard');
        Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
        Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::get('/bookings', fn() => view('artist.bookings'))->name('bookings');
        Route::get('/inbox', fn() => view('artist.inbox'))->name('inbox');
        Route::post('/tracks', [TrackController::class, 'store'])->name('tracks.store');
        Route::delete('/tracks/{track}', [TrackController::class, 'destroy'])->name('tracks.destroy');

        Route::patch('/bookings/{booking}/accept', [BookingController::class, 'accept'])->name('bookings.accept');
        Route::patch('/bookings/{booking}/decline', [BookingController::class, 'decline'])->name('bookings.decline');
    });
