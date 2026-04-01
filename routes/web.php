<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\OAuthController;
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



// Organiser routes
Route::middleware(['auth', 'role:organiser', 'verified'])
    ->prefix('organiser')
    ->name('organiser.')
    ->group(function () {
        Route::get('/dashboard', function () {
            return view('organiser.dashboard');
        })->name('dashboard');
    });

// Artist routes
Route::middleware(['auth', 'role:artist', 'verified'])
    ->prefix('artist')
    ->name('artist.')
    ->group(function () {
        Route::get('/dashboard', function () {
            return view('artist.dashboard');
        })->name('dashboard');
    });


Route::middleware('auth')->group(function () {
    Route::get('/email/verify', [EmailVerificationController::class, 'notice'])->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', [EmailVerificationController::class, 'verify'])->middleware('signed')->name('verification.verify');
    Route::post('/email/verification-notification', [EmailVerificationController::class, 'send'])->middleware('throttle:6,1')->name('verification.send');
});


Route::middleware(['auth', 'verified', 'role:artist'])
    ->prefix('artist')
    ->name('artist.')
    ->group(function () {
        Route::get('/dashboard', function () {
            return view('artist.dashboard');
        })->name('dashboard');

        Route::get('/profile/edit', function () {
            return 'Edit profile - coming soon';
        })->name('profile.edit');

        Route::get('/tracks', function () {
            return 'Tracks - coming soon';
        })->name('tracks.index');
    });

//OAuth routes
Route::get('/auth/google', [OAuthController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/auth/google/callback', [OAuthController::class, 'handleGoogleCallback'])->name('auth.google.callback');
Route::get('/auth/select-role', [OAuthController::class, 'showSelectRole'])->middleware('auth')->name('auth.select-role');
Route::post('/auth/select-role', [OAuthController::class, 'storeRole'])->middleware('auth')->name('auth.store-role');

// Artist routes
Route::middleware(['auth', 'verified', 'role:artist'])
    ->prefix('artist')
    ->name('artist.')
    ->group(function () {
        Route::get('/dashboard', fn() => view('artist.dashboard'))->name('dashboard');
        Route::get('/profile', fn() => view('artist.profile'))->name('profile');
        Route::get('/bookings', fn() => view('artist.bookings'))->name('bookings');
        Route::get('/inbox', fn() => view('artist.inbox'))->name('inbox');
    });
//Organiser routes
Route::middleware(['auth', 'verified', 'role:organiser'])
    ->prefix('organiser')
    ->name('organiser.')
    ->group(function () {
        Route::get('/dashboard', fn() => view('organiser.dashboard'))->name('dashboard');
        Route::get('/profile', fn() => view('organiser.profile'))->name('profile');
        Route::get('/inbox', fn() => view('organiser.inbox'))->name('inbox');
        Route::get('/artists', fn() => view('organiser.artists'))->name('artists');
        Route::get('/events', fn() => view('organiser.events'))->name('events');
    });

// Audience routes
Route::middleware(['auth', 'role:audience', 'verified'])
    ->prefix('audience')
    ->name('audience.')
    ->group(function () {
        Route::get('/dashboard', function () {return view('audience.dashboard');})->name('dashboard');
        Route::get('/events', function () {return view('audience.events');})->name('events');
    });
