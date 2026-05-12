<?php

namespace App\Notifications;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class BookingDeclined extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public Booking $booking;
    public function __construct(Booking $booking)
    {
        $this->booking = $booking;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toDatabase(object $notifiable): array
    {
        return [
            'message' => $this->booking->artistProfile->stage_name . ' declined your booking request for ' . $this->booking->event->name,
            'booking_id' => $this->booking->id,
            'event_id' => $this->booking->event_id,
            'type' => 'booking_declined',
        ];
    }
}
