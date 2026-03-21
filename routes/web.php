<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmailVerificationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

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

// Audience routes
Route::middleware(['auth', 'role:audience', 'verified'])
    ->prefix('audience')
    ->name('audience.')
    ->group(function () {
        Route::get('/events', function () {
            return view('audience.dashboard');
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
