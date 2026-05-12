<?php

namespace App\Http\Controllers\Artist;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class InboxController extends Controller
{
    public function index(): View
    {
        return view('artist.inbox');
    }

    public function markAllRead(): RedirectResponse
    {
        $user = auth()->user();
        $user->unreadNotifications->markAsRead();
        return back();
    }
}
