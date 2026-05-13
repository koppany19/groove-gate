<?php

namespace App\Http\Controllers\Organiser;

use App\Http\Controllers\Controller;
use App\Http\Requests\Organiser\StoreTicketTypeRequest;
use App\Models\Event;
use App\Models\TicketType;
use Illuminate\Http\Request;

class TicketTypeController extends Controller
{
    public function store(StoreTicketTypeRequest $request, Event $event)
    {
        $validated = $request->validated();
        if($event->organiser_profile_id !== auth()->user()->organiserProfile->id) {
            abort(403);
        }

        $existingQuantity = $event->ticketTypes()->sum('quantity');
        $newQuantity = $validated['quantity'];
        if ($existingQuantity + $newQuantity > $event->capacity) {
            return back()->withErrors([
                'quantity' => 'Total ticket quantity cannot exceed event capacity of ' . $event->capacity . '. Available: ' . ($event->capacity - $existingQuantity) . ' tickets.'
            ])->withInput();
        }

        $event->ticketTypes()->create($validated);
        return back()->with('success', 'Ticket Type created');
    }

    public function update(StoreTicketTypeRequest $request, Event $event, TicketType $ticketType)
    {
        $validated = $request->validated();
        if($event->organiser_profile_id !== auth()->user()->organiserProfile->id) {
            abort(403);
        }

        $existingQuantity = $event->ticketTypes()->where('id', '!=', $ticketType->id) ->sum('quantity');
        $newQuantity = $validated['quantity'];
        if ($existingQuantity + $newQuantity > $event->capacity) {
            return back()->withErrors([
                'quantity' => 'Total ticket quantity cannot exceed event capacity of ' . $event->capacity . '. Available: ' . ($event->capacity - $existingQuantity) . ' tickets.'
            ])->withInput();
        }

        $ticketType->update($validated);
        return back()->with('success', 'Ticket Type updated');
    }

    public function destroy(Event $event, TicketType $ticketType)
    {
        if($event->organiser_profile_id !== auth()->user()->organiserProfile->id) {
            abort(403);
        }

        if($ticketType->tickets()->count() > 0) {
            return back()->with('error', 'Ticket Type cannot be deleted because it has some tickets');
        }
        $ticketType->delete();

        return back()->with('success', 'Ticket Type deleted');

    }

}
