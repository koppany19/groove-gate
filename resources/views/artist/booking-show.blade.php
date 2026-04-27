<x-layout>
    <div class="min-h-screen bg-(--color-artist-bg) text-white -m-8 p-6 md:p-10">
        <div class="max-w-[1400px] mx-auto">

            <div class="flex items-center gap-4 mb-8">
                <a href="{{ route('artist.bookings') }}"
                   class="p-2 rounded-xl bg-white/5 hover:bg-white/10 border border-white/10 transition-all">
                    <svg width="18" height="18" fill="none" stroke="currentColor"
                         stroke-width="2" viewBox="0 0 24 24">
                        <path d="M19 12H5M12 19l-7-7 7-7"/>
                    </svg>
                </a>
                <div>
                    <h1 class="text-3xl font-black text-white tracking-tight">Booking Request</h1>
                    <p class="text-sm text-gray-400 mt-1">
                        from {{ $booking->event->organiserProfile->company_name
                                ?? $booking->event->organiserProfile->user->name }}
                    </p>
                </div>
            </div>

            <div class="w-full h-100 rounded-3xl overflow-hidden mb-8 bg-white/5">
                @if($booking->event->cover_image)
                    <img src="{{ str_starts_with($booking->event->cover_image, 'http')
                                    ? $booking->event->cover_image
                                    : Storage::url($booking->event->cover_image) }}"
                         alt="{{ $booking->event->name }}"
                         class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full bg-gradient-to-br from-blue-950 via-gray-900 to-gray-900
                                flex items-center justify-center">
                        <svg width="48" height="48" fill="none" stroke="currentColor"
                             stroke-width="1" viewBox="0 0 24 24" class="text-gray-700">
                            <rect x="3" y="4" width="18" height="18" rx="2"/>
                            <line x1="3" y1="10" x2="21" y2="10"/>
                        </svg>
                    </div>
                @endif
            </div>

            <div class="mb-8">
                <div class="flex items-center gap-3 mb-3">
                    <h2 class="text-2xl font-black text-white">{{ $booking->event->name }}</h2>
                    <span class="px-3 py-1 rounded-full text-xs font-bold border {{ $booking->status->color() }}">
                        {{ $booking->status->label() }}
                    </span>
                </div>
                <div class="flex flex-wrap items-center gap-3">
                    <span class="flex items-center gap-1.5 text-sm text-gray-400">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2">
                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                            <circle cx="12" cy="10" r="3"/>
                        </svg>
                        {{ $booking->event->location }}
                    </span>
                    <span class="text-gray-700">·</span>
                    <span class="flex items-center gap-1.5 text-sm text-gray-400">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2">
                            <rect x="3" y="4" width="18" height="18" rx="2"/>
                            <line x1="3" y1="10" x2="21" y2="10"/>
                        </svg>
                        {{ $booking->event->start_date->format('M d, Y') }}
                        @if($booking->event->end_date)
                            – {{ $booking->event->end_date->format('M d, Y') }}
                        @endif
                    </span>
                    @if($booking->event->capacity)
                        <span class="text-gray-700">·</span>
                        <span class="flex items-center gap-1.5 text-sm text-gray-400">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none"
                                 stroke="currentColor" stroke-width="2">
                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                                <circle cx="9" cy="7" r="4"/>
                            </svg>
                            {{ number_format($booking->event->capacity) }} capacity
                        </span>
                    @endif
                </div>
            </div>

            <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">

                <div class="xl:col-span-2 space-y-6">

                    <div class="bg-(--color-card) border border-white/5 rounded-3xl p-8 shadow-xl">
                        <h3 class="text-lg font-bold text-white mb-4">About the Event</h3>
                        @if($booking->event->description)
                            <p class="text-gray-300 leading-relaxed">
                                {{ $booking->event->description }}
                            </p>
                        @else
                            <p class="text-gray-600 text-sm">No description provided.</p>
                        @endif
                    </div>

                    <div class="bg-(--color-card) border border-white/5 rounded-3xl p-8 shadow-xl">
                        <h3 class="text-lg font-bold text-white mb-5">Organiser</h3>
                        <div class="flex items-center gap-4 mb-5">
                            <div class="w-12 h-12 rounded-full overflow-hidden bg-white/5 flex-shrink-0 flex items-center justify-center">
                                @if($booking->event->organiserProfile->user->avatar)
                                    <img src="{{ str_starts_with($booking->event->organiserProfile->user->avatar, 'http')
                                                    ? $booking->event->organiserProfile->user->avatar
                                                    : Storage::url($booking->event->organiserProfile->user->avatar) }}"
                                         alt="{{ $booking->event->organiserProfile->user->name }}"
                                         class="w-full h-full object-cover">
                                @else
                                    <span class="text-lg font-black text-orange-400">
                                        {{ strtoupper(substr($booking->event->organiserProfile->user->name, 0, 1)) }}
                                    </span>
                                @endif
                            </div>
                            <div>
                                <p class="text-white font-semibold">
                                    {{ $booking->event->organiserProfile->company_name
                                        ?? $booking->event->organiserProfile->user->name }}
                                </p>
                                <p class="text-gray-500 text-sm">
                                    {{ $booking->event->organiserProfile->user->name }}
                                </p>
                            </div>
                        </div>

                        <div class="space-y-3 pt-4 border-t border-white/5">
                            @if($booking->event->organiserProfile->location)
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-gray-500">Location</span>
                                    <span class="text-sm text-gray-300">
                                        {{ $booking->event->organiserProfile->location }}
                                    </span>
                                </div>
                            @endif
                            @if($booking->event->organiserProfile->phone)
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-gray-500">Phone</span>
                                    <span class="text-sm text-gray-300">
                                        {{ $booking->event->organiserProfile->phone }}
                                    </span>
                                </div>
                            @endif
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-500">Total Events</span>
                                <span class="text-sm text-gray-300">
                                    {{ $booking->event->organiserProfile->events()->count() }}
                                </span>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="space-y-6">

                    <div class="bg-(--color-card) border border-white/5 rounded-3xl overflow-hidden shadow-xl">
                        <div class="px-6 pt-6 pb-4 border-b border-white/5">
                            <h3 class="text-base font-bold text-white">Booking Details</h3>
                            <p class="text-xs text-gray-500 mt-0.5">Request information</p>
                        </div>

                        <div class="px-6 py-5 space-y-4">
                            @if($booking->performance_date)
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-gray-500">Performance date</span>
                                    <span class="text-sm font-semibold text-white">
                                        {{ $booking->performance_date->format('M d, Y') }}
                                    </span>
                                </div>
                            @endif

                            @if($booking->fee)
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-gray-500">Offered fee</span>
                                    <span class="text-sm font-bold text-white">
                                        €{{ number_format($booking->fee, 2) }}
                                    </span>
                                </div>
                            @endif

                            @if($booking->duration)
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-gray-500">Set duration</span>
                                    <span class="text-sm font-semibold text-white">
                                        {{ $booking->duration }} min
                                    </span>
                                </div>
                            @endif

                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-500">Received</span>
                                <span class="text-sm text-gray-400">
                                    {{ $booking->created_at->diffForHumans() }}
                                </span>
                            </div>
                        </div>

                        @if($booking->message)
                            <div class="px-6 pb-5 border-t border-white/5 pt-4">
                                <p class="text-xs text-gray-500 mb-2">Message</p>
                                <p class="text-gray-300 text-sm leading-relaxed">
                                    "{{ $booking->message }}"
                                </p>
                            </div>
                        @endif
                    </div>

                    @if($booking->status === \App\BookingStatus::PENDING)
                        <div class="space-y-3">
                            <form action="{{ route('artist.bookings.accept', $booking) }}" method="POST">
                                @csrf @method('PATCH')
                                <button type="submit"
                                        class="w-full py-3.5 rounded-2xl text-white font-bold text-sm bg-emerald-500 hover:opacity-90 transition-all flex items-center justify-center gap-2">
                                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none"
                                         stroke="currentColor" stroke-width="2">
                                        <polyline points="20 6 9 17 4 12"/>
                                    </svg>
                                    Accept Booking
                                </button>
                            </form>
                            <form action="{{ route('artist.bookings.decline', $booking) }}" method="POST">
                                @csrf @method('PATCH')
                                <button type="submit"
                                        class="w-full py-3.5 rounded-2xl text-gray-400 font-medium text-sm border border-white/10 hover:border-white/20 hover:text-white transition-all">
                                    Decline
                                </button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-layout>
