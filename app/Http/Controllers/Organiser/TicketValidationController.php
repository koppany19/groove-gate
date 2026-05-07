<?php

namespace App\Http\Controllers\Organiser;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketValidationController extends Controller
{
    public function validate(Request $request, Event $event)
    {
        $user = auth()->user();
        if($event->organiser_profile_id !== $user->organiserProfile->id) {
            abort(403);
        }

        $validated = $request->validate([
            'barcode' => 'required|string|size:9',
        ]);

        $ticket = Ticket::where('barcode', '=', $validated['barcode'])->with('ticketType')->first();
        if (!$ticket) {
            return back()->with('validation_error', 'Ticket not found.');
        }
        if ($ticket->ticketType->event_id !== $event->id) {
            return back()->with('validation_error', 'This ticket belongs to a different event.');
        }
        if ($ticket->admission_time) {
            return back()->with('validation_error', 'Already admitted at ' . $ticket->admission_time->format('H:i') . '.');
        }

        $ticket->update(['admission_time' => now()]);
        return back()->with('validation_success', 'Valid ticket – admitted at ' . now()->format('H:i') . '!');
    }
}
