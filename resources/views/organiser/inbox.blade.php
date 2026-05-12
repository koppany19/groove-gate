<x-layout>
    <div class="min-h-screen bg-(--color-artist-bg) text-white -m-8 p-6 md:p-10">
        <div class="max-w-[1100px] mx-auto">

            <div class="mb-8 flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-black text-white tracking-tight">Inbox</h1>
                    <p class="text-sm text-gray-400 mt-1">
                        {{ auth()->user()->unreadNotifications->count() }} unread notifications
                    </p>
                </div>
                @if(auth()->user()->unreadNotifications->count() > 0)
                    <form action="{{ route('organiser.inbox.read') }}" method="POST">
                        @csrf
                        <button type="submit"
                                class="px-4 py-2 rounded-xl text-sm font-medium text-gray-400 border border-white/10 hover:border-white/20 hover:text-white transition-all">
                            Mark all as read
                        </button>
                    </form>
                @endif
            </div>

            @if(auth()->user()->notifications->isEmpty())
                <div class="flex flex-col items-center justify-center py-24">
                    <div class="w-20 h-20 rounded-full bg-white/5 flex items-center justify-center mb-6">
                        <svg width="36" height="36" fill="none" stroke="currentColor"
                             stroke-width="1.5" viewBox="0 0 24 24" class="text-gray-600">
                            <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/>
                            <path d="M13.73 21a2 2 0 0 1-3.46 0"/>
                        </svg>
                    </div>
                    <h2 class="text-xl font-bold text-white mb-2">No notifications yet</h2>
                    <p class="text-gray-500 text-sm">Booking updates and ticket purchases will appear here.</p>
                </div>
            @else
                <div class="space-y-3">
                    @foreach(auth()->user()->notifications as $notification)
                        <div class="bg-[#1A1D24] border rounded-3xl p-5 shadow-xl transition-all
                                    {{ is_null($notification->read_at)  ? 'border-blue-500/20 hover:border-blue-500/30' : 'border-white/5 hover:border-white/10 opacity-70' }}">
                            <div class="flex items-start gap-4">

                                <div class="w-9 h-9 rounded-xl bg-white/5 border border-white/10
                                            flex items-center justify-center flex-shrink-0 mt-0.5">
                                    @if($notification->data['type'] === 'booking_accepted')
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none"
                                             stroke="#9ca3af" stroke-width="2">
                                            <polyline points="20 6 9 17 4 12"/>
                                        </svg>
                                    @elseif($notification->data['type'] === 'booking_declined')
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none"
                                             stroke="#9ca3af" stroke-width="2">
                                            <line x1="18" y1="6" x2="6" y2="18"/>
                                            <line x1="6" y1="6" x2="18" y2="18"/>
                                        </svg>
                                    @elseif($notification->data['type'] === 'ticket_purchased')
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none"
                                             stroke="#9ca3af" stroke-width="2">
                                            <path d="M2 9a3 3 0 0 1 0 6v2a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-2a3 3 0 0 1 0-6V7a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2v2z"/>
                                        </svg>
                                    @else
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none"
                                             stroke="#9ca3af" stroke-width="2">
                                            <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/>
                                            <path d="M13.73 21a2 2 0 0 1-3.46 0"/>
                                        </svg>
                                    @endif
                                </div>

                                <div class="flex-1 min-w-0">
                                    <div class="flex items-start justify-between gap-4">
                                        <p class="text-sm text-gray-300 leading-relaxed">
                                            {{ $notification->data['message'] }}
                                        </p>
                                        @if(is_null($notification->read_at))
                                            <div class="w-2 h-2 rounded-full bg-blue-500 flex-shrink-0 mt-1.5"></div>
                                        @endif
                                    </div>
                                    <div class="flex items-center gap-4 mt-2">
                                        <p class="text-xs text-gray-600">
                                            {{ $notification->created_at->diffForHumans() }}
                                        </p>
                                        @if(isset($notification->data['event_id']))
                                            <a href="{{ route('organiser.events.show', $notification->data['event_id']) }}"
                                               class="text-xs text-blue-400 hover:text-blue-300 transition-colors">
                                                View event →
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-layout>
