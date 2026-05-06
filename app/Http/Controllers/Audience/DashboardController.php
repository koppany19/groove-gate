<?php

namespace App\Http\Controllers\Audience;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $tickets = $user->tickets()->with(['event', 'ticketType'])->latest()->get();

        $upcomingTickets = $tickets->filter(function ($ticket) {
            return $ticket->event->start_date->isFuture();
        });
        $pastTickets = $tickets->filter(function ($ticket) {
            return $ticket->event->start_date->isPast();
        });

        return view('audience.dashboard', compact('tickets', 'upcomingTickets', 'pastTickets'));
    }
}
