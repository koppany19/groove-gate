<?php

namespace App\Notifications;

use App\Models\Ticket;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class TicketPurchased extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public Ticket $ticket;
    public function __construct(Ticket $ticket)
    {
        $this->ticket = $ticket;
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
            'message' => $this->ticket->user->name . ' purchased a ' . $this->ticket->ticketType->name . ' ticket for ' . $this->ticket->ticketType->event->name,
            'ticket_id' => $this->ticket->id,
            'event_id' => $this->ticket->ticketType->event_id,
            'type' => 'ticket_purchased',
        ];
    }
}
