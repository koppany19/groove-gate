<?php

namespace App\Http\Controllers\Organiser;

use App\EventStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Organiser\EventRequest;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        $profile = $user->organiserProfile;
        $events = $profile->events()->latest()->paginate(10);

        return view('organiser.events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('organiser.events.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EventRequest $request)
    {
        $data = $request->validated();
        $profile = auth()->user()->organiserProfile;

        if($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('events', 'public');
        }
        $data['status'] = EventStatus::DRAFT;
        $profile->events()->create($data);

        return redirect()->route('organiser.events.index')->with('success', 'Event created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        if($event->organiser_profile_id != auth()->user()->organiserProfile->id) {
            abort(403);
        }
        $event->load(['confirmedBookings.artistProfile.user', 'bookings.artistProfile.user', 'ticketTypes']);

        return view('organiser.events.show', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        if($event->organiser_profile_id != auth()->user()->organiserProfile->id) {
            abort(403);
        }
        return view('organiser.events.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EventRequest $request, Event $event)
    {
        if($event->organiser_profile_id != auth()->user()->organiserProfile->id) {
            abort(403);
        }

        $data = $request->validated();

        if($request->hasFile('cover_image')) {
            if($event->cover_image)
            {
                Storage::disk('public')->delete($event->cover_image);
            }
            $data['cover_image'] = $request->file('cover_image')->store('events', 'public');
        }
        $event->update($data);
        return redirect()->route('organiser.events.index')->with('success', 'Event updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        if($event->organiser_profile_id != auth()->user()->organiserProfile->id) {
            abort(403);
        }

        if($event->cover_image)
        {
            Storage::disk('public')->delete($event->cover_image);
        }
        $event->delete();
        return redirect()->route('organiser.events.index')->with('success', 'Event deleted successfully.');
    }

    public function publish(Event $event)
    {
        if($event->organiser_profile_id != auth()->user()->organiserProfile->id) {
            abort(403);
        }
        $event->update(['status' => EventStatus::PUBLISHED]);
        if($event->has_seats) { $event->generateSeats();}

        return back()->with('success', 'Event published successfully.');
    }

    public function cancel(Event $event)
    {
        if($event->organiser_profile_id != auth()->user()->organiserProfile->id) {
            abort(403);
        }
        $event->update(['status' => EventStatus::CANCELLED]);

        return back()->with('success', 'Event cancelled successfully.');
    }

}
