<?php

namespace App\Http\Controllers;

use App\BookingStatus;
use App\Http\Requests\StoreBookingRequest;
use App\Models\Booking;
use App\Models\Event;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function store(StoreBookingRequest $request)
    {
        $validated = $request->validated();

        $event = Event::findOrFail($validated['event_id']);
        if($event->organiser_profile_id !== $request->user()->organiserProfile->id) {
            abort(403, 'Unauthorized action.');
        }

        $exists = Booking::where('event_id', '=', $validated['event_id'])->where('artist_profile_id', '=', $validated['artist_profile_id'])->exists();
        if($exists) {
            return redirect()->route('organiser.events.show', ['event' => $event])->with('error', 'Event already booked.');
        }

        $validated['status'] = BookingStatus::PENDING->value;
        Booking::create($validated);
        return back()->with('success', 'Booking request sent successfully.');
    }

    public function accept(Booking $booking)
    {
        if($booking->artistProfile()->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $booking->update(['status' => BookingStatus::ACCEPTED->value]);
        return back()->with('success', 'Event accepted successfully.');
    }

    public function decline(Booking $booking)
    {
        if($booking->artistProfile()->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $booking->update(['status' => BookingStatus::DECLINED->value]);
        return back()->with('success', 'Event accepted successfully.');
    }
}
