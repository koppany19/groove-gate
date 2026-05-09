<?php

namespace App\Http\Controllers\Artist;

use App\BookingStatus;
use App\Http\Controllers\Controller;


class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $profile = $user->artistProfile;

        $bookings = $profile->bookings()->with(['event', 'event.organiserProfile'])->latest()->get();
        $upcomingShows = $bookings->filter(
            function($booking){
                return $booking->status === BookingStatus::ACCEPTED && $booking->performance_date?->isFuture();
            }
        );
        $showsPlayed = $bookings->filter(
            function($booking) {
                return $booking->status === BookingStatus::ACCEPTED && $booking->performance_date?->isPast();
            }
        );
        $totalEarnings = $bookings->filter(
            function($booking) {
                return $booking->status === BookingStatus::ACCEPTED;
            })->sum('fee');

        $activity = $this->buildActivityLog($bookings);
        $chartData = $this->buildChartData($profile);

        return view('artist.dashboard', compact('bookings', 'upcomingShows', 'showsPlayed', 'totalEarnings', 'activity', 'chartData',));
    }

    private function buildActivityLog($bookings): array
    {
        $items = collect();

        foreach ($bookings as $booking) {
            $items->push([
                'type' => 'booking_' . $booking->status->value,
                'text' => match($booking->status->value) {
                    'pending'  => 'New booking request from <b>' . ($booking->event->organiserProfile->company_name ?? $booking->event->organiserProfile->user->name) . '</b> for ' . $booking->event->name,
                    'accepted' => 'You accepted the booking request for <b>' . $booking->event->name . '</b>',
                    'declined' => 'You declined the booking request for <b>' . $booking->event->name . '</b>',
                },
                'time' => $booking->updated_at,
                'icon' => $booking->status->value,
            ]);
        }
        $bookingReq = $bookings->filter(function($booking){
            return $booking->status === BookingStatus::ACCEPTED && $booking->performance_date?->isFuture();
        });

        foreach ($bookingReq as $booking) {
            $items->push([
                'type' => 'upcoming',
                'text' => 'Upcoming show at <b>' . $booking->event->name . '</b> on ' . $booking->performance_date->format('M d, Y'),
                'time' => $booking->performance_date,
                'icon' => 'upcoming',
            ]);
        }

        return $items->sortByDesc('time')->take(20)->values()->toArray();
    }

    private function buildChartData($profile): array
    {
        $days    = collect();
        $revenue = collect();
        $requests = collect();

        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $days->push($date->format('D'));
            $dayRevenue = $profile->bookings()->where('status', BookingStatus::ACCEPTED->value)->whereDate('updated_at', $date->toDateString())->sum('fee');
            $dayRequests = $profile->bookings()->whereDate('created_at', $date->toDateString())->count();
            $revenue->push(round($dayRevenue, 2));
            $requests->push($dayRequests);
        }

        return [
            'labels'   => $days->toArray(),
            'revenue'  => $revenue->toArray(),
            'requests' => $requests->toArray(),
        ];
    }
}
