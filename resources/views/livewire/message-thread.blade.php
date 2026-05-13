<div wire:poll.5000ms="$refresh">

    <div class="space-y-4 mb-6 max-h-[500px] overflow-y-auto px-1" id="message-list">
        @foreach($messages as $message)

            @if($message->isBookingCard())
                <div class="flex justify-center">
                    <div class="booking-card">

                        <div class="flex items-center gap-2 mb-3">
                            <x-icon name="ticket" size="14" class="text-blue-400" />
                            <p class="text-xs font-bold text-blue-400 uppercase tracking-wider">Booking Request</p>
                        </div>

                        <p class="text-white font-bold text-base mb-1">
                            {{ $message->metadata['event_name'] }}
                        </p>

                        @if($message->metadata['event_location'] ?? null)
                            <p class="text-xs text-(--color-muted) mb-3">
                                {{ $message->metadata['event_location'] }}
                            </p>
                        @endif

                        <div class="space-y-2 border-t border-white/5 pt-3">
                            @if($message->metadata['performance_date'] ?? null)
                                <div class="booking-card-row">
                                    <span class="text-(--color-muted)">Performance date</span>
                                    <span class="font-semibold text-white">{{ $message->metadata['performance_date'] }}</span>
                                </div>
                            @endif
                            @if($message->metadata['duration'] ?? null)
                                <div class="booking-card-row">
                                    <span class="text-(--color-muted)">Duration</span>
                                    <span class="font-semibold text-white">{{ $message->metadata['duration'] }} min</span>
                                </div>
                            @endif
                            @if($message->metadata['fee'] ?? null)
                                <div class="booking-card-row">
                                    <span class="text-(--color-muted)">Offered fee</span>
                                    <span class="font-bold text-blue-400">€{{ number_format($message->metadata['fee'], 2) }}</span>
                                </div>
                            @endif
                        </div>

                        <a href="{{ route('artist.bookings.show', $message->metadata['booking_id']) }}"
                           class="flex items-center justify-center gap-2 mt-4 py-2 rounded-xl text-xs font-bold text-blue-400 border border-blue-500/20 hover:bg-blue-500/10 transition-all">
                            View Booking →
                        </a>
                    </div>
                </div>

            @else
                @php $isMe = $message->sender_id === auth()->id(); @endphp

                <div class="flex {{ $isMe ? 'justify-end' : 'justify-start' }} items-end gap-2">

                    @if(!$isMe)
                        <div class="message-avatar">
                            @if($message->sender->avatar)
                                <img src="{{ str_starts_with($message->sender->avatar, 'http') ? $message->sender->avatar : Storage::url($message->sender->avatar) }}"
                                     class="w-full h-full object-cover">
                            @else
                                <span class="text-xs font-black text-blue-400">
                                    {{ strtoupper(substr($message->sender->name, 0, 1)) }}
                                </span>
                            @endif
                        </div>
                    @endif

                    <div class="max-w-xs">
                        <div class="{{ $isMe ? 'message-bubble-me' : 'message-bubble-other' }}">
                            <p class="text-sm leading-relaxed">{{ $message->body }}</p>
                        </div>
                        <p class="text-xs text-(--color-muted-2) mt-1 {{ $isMe ? 'text-right' : 'text-left' }}">
                            {{ $message->created_at->format('H:i') }}
                            @if($isMe && $message->isRead())
                                · <span class="text-blue-400">Read</span>
                            @endif
                        </p>
                    </div>

                    @if($isMe)
                        <div class="message-avatar">
                            @if(auth()->user()->avatar)
                                <img src="{{ str_starts_with(auth()->user()->avatar, 'http') ? auth()->user()->avatar : Storage::url(auth()->user()->avatar) }}"
                                     class="w-full h-full object-cover">
                            @else
                                <span class="text-xs font-black text-blue-400">
                                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                </span>
                            @endif
                        </div>
                    @endif
                </div>
            @endif
        @endforeach
    </div>

    {{-- Message input --}}
    <div class="border-t border-white/5 pt-4">
        <div class="flex items-end gap-3">
            <textarea wire:model="body"
                      wire:keydown.enter.prevent="send"
                      rows="2"
                      placeholder="Write a message..."
                      class="message-input flex-1"></textarea>

            <button wire:click="send"
                    class="send-btn">
                <x-icon name="arrow-right" size="18" stroke-width="2.5" />
            </button>
        </div>
        <p class="text-xs text-(--color-muted-2) mt-2">Press Enter to send</p>
    </div>

    <script>
        document.addEventListener('livewire:updated', () => {
            const list = document.getElementById('message-list')
            if (list) list.scrollTop = list.scrollHeight
        })
    </script>
</div>
