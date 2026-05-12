<?php

namespace App\Http\Controllers\Organiser;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class InboxController extends Controller
{
    public function index(): View
    {
        return view('organiser.inbox');
    }

    public function markAllRead(): RedirectResponse
    {
        $user = auth()->user();
        $user->unreadNotifications->markAsRead();
        return back();
    }
}
