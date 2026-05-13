<x-layout>
    <div class="min-h-screen bg-(--color-artist-bg) text-white -m-8 p-6 md:p-10">
        <div class="max-w-[1100px] mx-auto">

            <div class="mb-8">
                <h1 class="text-3xl font-black text-white tracking-tight">Messages</h1>
                <p class="text-sm text-(--color-muted) mt-1">{{ $conversations->count() }} conversations</p>
            </div>

            @if($conversations->isEmpty())
                <div class="empty-state">
                    <div class="w-20 h-20 rounded-full bg-white/5 flex items-center justify-center mb-6">
                        <x-icon name="inbox" size="36" stroke-width="1.5" class="text-(--color-muted-2)" />
                    </div>
                    <h2 class="text-xl font-bold text-white mb-2">No messages yet</h2>
                    <p class="text-(--color-muted) text-sm">Send a booking request to start a conversation.</p>
                </div>
            @else
                <div class="space-y-3">
                    @foreach($conversations as $conversation)
                        <a href="{{ route('organiser.messages.show', $conversation) }}" class="conversation-card">
                            <div class="flex items-center gap-4">

                                <div class="conversation-avatar">
                                    @if($conversation->artist->avatar)
                                        <img src="{{ str_starts_with($conversation->artist->avatar, 'http') ? $conversation->artist->avatar : Storage::url($conversation->artist->avatar) }}"
                                             class="w-full h-full object-cover">
                                    @else
                                        <span class="text-sm font-black text-(--color-artist)">
                                            {{ strtoupper(substr($conversation->artist->name, 0, 1)) }}
                                        </span>
                                    @endif
                                </div>

                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center justify-between gap-4 mb-1">
                                        <p class="text-white font-bold text-sm truncate">
                                            {{ $conversation->booking->artistProfile->stage_name ?? $conversation->artist->name }}
                                        </p>
                                        @if($conversation->unreadCount(auth()->id()) > 0)
                                            <span class="unread-badge">
                                                {{ $conversation->unreadCount(auth()->id()) }}
                                            </span>
                                        @endif
                                    </div>
                                    <p class="text-xs text-(--color-muted) truncate mb-1">
                                        {{ $conversation->booking->event->name }}
                                    </p>
                                    @if($conversation->lastMessage)
                                        <p class="text-xs text-(--color-muted-2) truncate">
                                            {{ $conversation->lastMessage->body ?? 'Booking request' }}
                                            · {{ $conversation->lastMessage->created_at->diffForHumans() }}
                                        </p>
                                    @endif
                                </div>

                            </div>
                        </a>
                    @endforeach
                </div>
            @endif

        </div>
    </div>
</x-layout>
