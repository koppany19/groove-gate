<?php

namespace App\Livewire;

use App\MessageType;
use App\Models\Conversation;
use Illuminate\View\View;
use Livewire\Component;

class MessageThread extends Component
{
    public Conversation $conversation;
    public string $body = '';

    public function mount(Conversation $conversation): void
    {
        $this->conversation = $conversation;
    }

    public function getMessagesProperty()
    {
        return $this->conversation->messages()->with('sender')->oldest()->get();
    }

    public function send(): void
    {
        $this->validate(['body' => 'required|string|max:1000']);

        if ($this->conversation->organiser_id !== auth()->id() && $this->conversation->artist_id !== auth()->id()) {
            abort(403);
        }

        $this->conversation->messages()->create([
            'sender_id' => auth()->id(),
            'type'      => MessageType::TEXT,
            'body'      => $this->body,
        ]);

        $this->body = '';
        $this->conversation->messages()->where('sender_id', '!=', auth()->id())->whereNull('read_at')->update(['read_at' => now()]);
    }

    public function render(): View
    {
        return view('livewire.message-thread', ['messages' => $this->getMessagesProperty()]);
    }
}
