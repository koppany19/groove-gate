<?php

namespace App\Http\Controllers;

use App\BookingStatus;
use App\Http\Requests\StoreBookingRequest;
use App\MessageType;
use App\Models\Booking;
use App\Models\Conversation;
use App\Models\Event;
use App\Notifications\BookingAccepted;
use App\Notifications\BookingDeclined;
use App\Notifications\BookingReceived;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $artist = $user->artistProfile;
        $bookings = $user->artistProfile->bookings()->with(['event', 'event.organiserProfile.user'])->when(request('status'), fn($q, $status) => $q->where('status', $status))->latest()->get();

        $counts = [
            'all' => $artist->bookings()->count(),
            'pending' => $artist->bookings()->where('status', BookingStatus::PENDING->value)->count(),
            'accepted' => $artist->bookings()->where('status', BookingStatus::ACCEPTED->value)->count(),
            'declined' => $artist->bookings()->where('status', BookingStatus::DECLINED->value)->count(),
        ];
        return view('artist.bookings', compact('bookings', 'user', 'counts'));
    }

    public function show(Booking $booking)
    {
        if ($booking->artistProfile->user_id !== auth()->id()) {
            abort(403);
        }
        $booking->load(['event','event.organiserProfile' ,'event.organiserProfile.user']);

        return view('artist.booking-show', compact('booking'));
    }
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
        $booking = Booking::create($validated);

        $booking->artistProfile->user->notify(new BookingReceived($booking->load(['event.organiserProfile.user', 'artistProfile'])));

        $conversation = Conversation::create([
            'booking_id'   => $booking->id,
            'organiser_id' => auth()->id(),
            'artist_id'    => $booking->artistProfile->user_id,
        ]);

        $conversation->messages()->create([
            'sender_id' => auth()->id(),
            'type'      => MessageType::BOOKING,
            'metadata'  => [
                'booking_id'       => $booking->id,
                'event_name'       => $booking->event->name,
                'event_location'   => $booking->event->location,
                'performance_date' => $booking->performance_date?->format('M d, Y'),
                'duration'         => $booking->duration,
                'fee'              => $booking->fee,
            ],
        ]);

        return back()->with('success', 'Booking request sent successfully.');
    }

    public function accept(Booking $booking)
    {
        if($booking->artistProfile->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $booking->update(['status' => BookingStatus::ACCEPTED->value]);
        $booking->event->organiserProfile->user->notify(
            new BookingAccepted($booking->load(['event', 'artistProfile']))
        );
        return back()->with('success', 'Event accepted successfully.');
    }

    public function decline(Booking $booking)
    {
        if($booking->artistProfile->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $booking->update(['status' => BookingStatus::DECLINED->value]);
        $booking->event->organiserProfile->user->notify(
            new BookingDeclined($booking->load(['event', 'artistProfile']))
        );
        return back()->with('success', 'Event declined successfully.');
    }
}
