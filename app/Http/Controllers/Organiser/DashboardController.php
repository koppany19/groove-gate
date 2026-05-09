<?php

namespace App\Http\Controllers\Organiser;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $profile = $user->organiserProfile;

        $events = $profile->events()->latest()->get();
        $bookings = $profile->bookings()->with(['artistProfile.user', 'event'])->latest()->get();
        $totalRevenue = $profile->events()->with('tickets')->get()->sum(function ($event) {
            return $event->tickets->sum('price');
        });
        $ticketsSold = $profile->events()->with('tickets')->get()->sum(function ($event) {
            return $event->tickets->count();
        });
        $activity = $this->activityLog($profile);
        $chartData = $this->chart($profile);

        return view('organiser.dashboard', compact('events', 'bookings', 'totalRevenue', 'ticketsSold', 'activity', 'chartData'));
    }

    private function activityLog($profile)
    {
        $items = collect();
        $bookingReq = $profile->bookings()->with(['artistProfile.user', 'event'])->latest()->take(20)->get();
        foreach($bookingReq  as $booking ) {
            $items->push([
                'type'    => 'booking_' . $booking->status->value,
                'text'    => match($booking->status->value) {
                    'pending'  => '<b>' . $booking->artistProfile->stage_name . '</b> booking request sent for ' . $booking->event->name,
                    'accepted' => '<b>' . $booking->artistProfile->stage_name . '</b> accepted your booking request for ' . $booking->event->name,
                    'declined' => '<b>' . $booking->artistProfile->stage_name . '</b> declined your booking request for ' . $booking->event->name,
                },
                'time'    => $booking->updated_at,
                'icon'    => $booking->status->value,
            ]);
        }
        $ticketReq = $profile->events()->with('tickets.user')->get();
        foreach ($ticketReq as $event) {
            foreach ($event->tickets as $ticket) {
                $items->push([
                    'type' => 'ticket',
                    'text' => '<b>' . $ticket->user->name . '</b> purchased a ticket for ' . $event->name,
                    'time' => $ticket->created_at,
                    'icon' => 'ticket',
                ]);
            }
        }
        $eventReq = $profile->events()->whereNotNull('updated_at')->get();
        foreach ($eventReq as $event) {
            if ($event->status->value === 'published') {
                $items->push([
                    'type' => 'event',
                    'text' => 'Event <b>' . $event->name . '</b> was published',
                    'time' => $event->updated_at,
                    'icon' => 'event',
                ]);
            }
        }

        return $items->sortByDesc('time')->take(20)->values()->toArray();
    }

    private function chart($profile): array
    {
        $events = $profile->events()->with('tickets')->get();
        $labels  = [];
        $tickets = [];
        $revenue = [];

        for ($i = 6; $i >= 0; $i--) {
            $date= now()->subDays($i);
            $dateStr = $date->toDateString();
            $labels[] = $date->format('D');
            $tickets[] = $events->sum(fn($event) =>
                $event->tickets->filter(fn($t) => $t->created_at->toDateString() === $dateStr)->count()
            );
            $revenue[] = round($events->sum(fn($event) =>
                $event->tickets->filter(fn($t) => $t->created_at->toDateString() === $dateStr)->sum('price')
            ), 2);
        }

        return compact('labels', 'tickets', 'revenue');
    }
}
