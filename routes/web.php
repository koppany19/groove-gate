<?php

use App\Http\Controllers\AuthController;
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
Route::middleware(['auth', 'role:organiser'])
    ->prefix('organiser')
    ->name('organiser.')
    ->group(function () {
        Route::get('/dashboard', function () {
            return 'Welcome Organiser!';
        })->name('dashboard');
    });

// Artist routes
Route::middleware(['auth', 'role:artist'])
    ->prefix('artist')
    ->name('artist.')
    ->group(function () {
        Route::get('/dashboard', function () {
            return 'Welcome Artist!';
        })->name('dashboard');
    });

// Audience routes
Route::middleware(['auth', 'role:audience'])
    ->prefix('audience')
    ->name('audience.')
    ->group(function () {
        Route::get('/events', function () {
            return 'Welcome Audience!';
        })->name('dashboard');
    });
