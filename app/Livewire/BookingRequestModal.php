<?php

namespace App\Livewire;

use App\BookingStatus;
use App\EventStatus;
use App\MessageType;
use App\Models\ArtistAvailability;
use App\Models\ArtistProfile;
use App\Models\Booking;
use App\Models\Conversation;
use App\Models\Event;
use App\Notifications\BookingReceived;
use Illuminate\View\View;
use Livewire\Component;

class BookingRequestModal extends Component
{
    public bool $open = false;
    public int $artistProfileId ;
    public ?int $selectedEventId = null;
    public ?string $performanceDate = null;
    public ?float $fee = null;
    public ?int $duration = null;
    public ?string $message = null;
    public bool $success = false;

    public function getEvents()
    {
        return auth()->user()->organiserProfile->events()->whereIn('status', [EventStatus::DRAFT->value, EventStatus::PUBLISHED->value])->get();
    }

    public function updatedSelectedEventId()
    {
        $this->performanceDate = null;
    }

    public function getArtistPrice(): ?string
    {
        $artist = ArtistProfile::find($this->artistProfileId);
        if ($artist?->price_min && $artist?->price_max) {
            return '€' . number_format($artist->price_min) . ' – €' . number_format($artist->price_max);
        }
        return null;
    }

    public function getAvailableDates()
    {
         if(!$this->selectedEventId) return [];

         $event = Event::find($this->selectedEventId);
         if(!$event) return [];

         $unavailableDates = ArtistAvailability::where('artist_profile_id', $this->artistProfileId)
             ->where('is_available', false)
             ->pluck('date')
             ->map(fn($date) => \Carbon\Carbon::parse($date)->format('Y-m-d'))
             ->toArray();

         $dates = [];
         $start = $event->start_date->copy();
         $end = $event->end_date ?? $event->start_date;

         while($start->lte($end)) {
             $formatted = $start->format('Y-m-d');
             if(!in_array($formatted, $unavailableDates)) {
                 $dates[] = $formatted;
             }
             $start->addDay();
         }
         return $dates;
    }

    public function submit()
    {
        $validated = $this->validate([
            'selectedEventId' => 'required|exists:events,id',
            'performanceDate' => 'required|date',
            'fee' => 'nullable|numeric|min:0',
            'message' => 'nullable|string|max:10000'
        ]);

        $exist = Booking::where('event_id', $this->selectedEventId)->where('artist_profile_id', $this->artistProfileId)->exists();
        if($exist)
        {
            $this->addError('selectedEventId', trans('Already booked for this event'));
            return;
        }

        $booking = Booking::create([
            'event_id' => $this->selectedEventId,
            'artist_profile_id' => $this->artistProfileId,
            'fee' => $this->fee,
            'message' => $this->message,
            'duration' => $this->duration,
            'performance_date' => $this->performanceDate,
            'status' => BookingStatus::PENDING,
        ]);

        $booking->artistProfile->user->notify( new BookingReceived ($booking->load(['event.organiserProfile.user', 'artistProfile'])));

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

        $this->success = true;
        $this->open = false;
    }

    public function render(): View
    {
        return view('livewire.booking-request-modal', [
            'events' => $this->getEvents(),
            'availableDates' => $this->getAvailableDates(),
        ]);
    }
}
