<?php

namespace App\Http\Controllers\Audience;

use App\EventStatus;
use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::where('status', '=', EventStatus::PUBLISHED)->with('organiserProfile.user')->latest()->paginate(12);

        return view('audience.events.index', compact('events'));
    }


    public function show(Event $event)
    {
        if($event->status !== EventStatus::PUBLISHED) {
            abort(404);
        }
        $event->load('organiserProfile.user', 'ticketTypes', 'confirmedBookings.artistProfile.user');

        return view('audience.events.show', compact('event'));
    }

    public function seats(Event $event)
    {
        if($event->status !== EventStatus::PUBLISHED) { abort(404); }

        if(!$event->has_seats){
            return redirect()->route('audience.events.show', $event);
        }

        if ($event->seats()->count() === 0) {
            $event->generateSeats();
        }

        $event->load(['seats' => function($query) {
            $query->orderBy('seat_number');
        }, 'ticketTypes']);

        $seats = $event->seats->groupBy(function($seat) {
            return substr($seat->seat_number, 0, 1);
        });

        return view('audience.events.seats', compact('event', 'seats'));
    }
}
