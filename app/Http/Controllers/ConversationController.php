<?php

namespace App\Http\Controllers;

use App\MessageType;
use App\Models\Conversation;
use Illuminate\Http\Request;

class ConversationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function artistIndex()
    {
        $artist = auth()->id();
        $conversations = Conversation::where('artist_id', '=', $artist)->with([
            'booking.event',
            'booking.artistProfile.user',
            'organiser',
            'lastMessage',
        ])->latest()->get();

        return view('artist.messages.index', compact('conversations'));
    }

    public function organiserIndex()
    {
        $organiser = auth()->id();
        $conversations = Conversation::where('organiser_id', '=', $organiser)->with([
            'booking.event',
            'booking.artistProfile.user',
            'organiser',
            'lastMessage',
        ])->latest()->get();

        return view('organiser.messages.index', compact('conversations'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Conversation $conversation)
    {
        if($conversation->artist_id !== auth()->id() && $conversation->organiser_id !== auth()->id()) {
            abort(403);
        }
        $validated = $request->validate([
            'body' => 'required|string|max:1000',
        ]);
        $conversation->messages()->create([
            'body' => $validated['body'],
            'type' => MessageType::TEXT,
            'sender_id' => auth()->id(),
        ]);

        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Conversation $conversation)
    {
        if ($conversation->artist_id !== auth()->id() && $conversation->organiser_id !== auth()->id()) {
            abort(403);
        }

        $conversation->load(['booking.event', 'booking.artistProfile.user', 'organiser', 'artist', 'messages.sender']);
        $conversation->messages()->where('sender_id', '!=', auth()->id())->whereNull('read_at')->update(['read_at' => now()]);

        $isArtist  = auth()->user()->role->value === 'artist';
        $backRoute = $isArtist ? route('artist.messages.index') : route('organiser.messages.index');
        $other     = $isArtist ? $conversation->organiser : $conversation->artist;

        return view('messages.show', compact('conversation', 'backRoute', 'other'));
    }
}
