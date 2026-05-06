<x-layout>
    <div class="min-h-screen bg-(--color-artist-bg) text-white -m-8 p-6 md:p-10">
        <div class="max-w-[1100px] mx-auto">

            <div class="mb-8">
                <h1 class="text-3xl font-black text-white tracking-tight">My Tickets</h1>
                <p class="text-sm text-gray-400 mt-1">{{ $tickets->count() }} tickets total</p>
            </div>

            <div class="grid grid-cols-3 gap-4 mb-8">
                <x-artist.profile.stat-card
                    label="Total Tickets"
                    :value="$tickets->count()"
                    color="blue"
                />
                <x-artist.profile.stat-card
                    label="Upcoming"
                    :value="$upcomingTickets->count()"
                    color="purple"
                />
                <x-artist.profile.stat-card
                    label="Past"
                    :value="$pastTickets->count()"
                    color="yellow"
                />
            </div>

            @if($tickets->isEmpty())
                <div class="flex flex-col items-center justify-center py-24">
                    <div class="w-20 h-20 rounded-full bg-white/5 flex items-center justify-center mb-6">
                        <svg width="36" height="36" fill="none" stroke="currentColor"
                             stroke-width="1.5" viewBox="0 0 24 24" class="text-gray-600">
                            <path d="M2 9a3 3 0 0 1 0 6v2a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-2a3 3 0 0 1 0-6V7a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2v2z"/>
                        </svg>
                    </div>
                    <h2 class="text-xl font-bold text-white mb-2">No tickets yet</h2>
                    <p class="text-gray-500 text-sm mb-6">Browse events and get your first ticket.</p>
                    <a href="{{ route('audience.events.index') }}"
                       class="flex items-center gap-2 px-6 py-3 rounded-full text-sm font-bold
                              text-white bg-gradient-to-r from-blue-600 to-blue-500
                              hover:from-blue-500 hover:to-blue-400
                              shadow-lg shadow-blue-500/20 transition-all">
                        Browse Events
                    </a>
                </div>
            @else

                @if($upcomingTickets->isNotEmpty())
                    <div class="mb-8">
                        <h2 class="text-base font-bold text-white mb-4">
                            Upcoming
                            <span class="text-gray-600 font-normal text-sm ml-2">
                                {{ $upcomingTickets->count() }} events
                            </span>
                        </h2>
                        <div class="space-y-3">
                            @foreach($upcomingTickets as $ticket)
                                <div class="bg-[#1A1D24] border border-white/5 border-t-2
                                            border-t-blue-500/60 rounded-3xl p-5 shadow-xl
                                            hover:border-white/10 transition-all
                                            flex items-center gap-5">

                                    <div class="w-14 h-14 rounded-2xl overflow-hidden flex-shrink-0 bg-white/5">
                                        @if($ticket->event->cover_image)
                                            <img src="{{ str_starts_with($ticket->event->cover_image, 'http')
                                                            ? $ticket->event->cover_image
                                                            : Storage::url($ticket->event->cover_image) }}"
                                                 class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full bg-gradient-to-br from-blue-950 to-gray-900"></div>
                                        @endif
                                    </div>

                                    <div class="flex-1 min-w-0">
                                        <p class="text-white font-bold text-sm truncate">
                                            {{ $ticket->event->name }}
                                        </p>
                                        <p class="text-gray-500 text-xs mt-0.5">
                                            {{ $ticket->event->location }} ·
                                            {{ $ticket->event->start_date->format('M d, Y') }}
                                        </p>
                                        <span class="inline-block mt-2 text-xs text-blue-400
                                                     bg-blue-500/10 border border-blue-500/20
                                                     px-2.5 py-0.5 rounded-full">
                                            {{ $ticket->ticketType->name }}
                                        </span>
                                    </div>

                                    <div class="flex items-center gap-3 flex-shrink-0">
                                        <div class="text-right">
                                            <p class="text-xs text-gray-500">Paid</p>
                                            <p class="text-sm font-bold text-blue-400">
                                                €{{ number_format($ticket->price, 2) }}
                                            </p>
                                        </div>
                                        <a href="{{ route('audience.tickets.show', $ticket->barcode) }}"
                                           class="flex items-center gap-2 px-4 py-2 rounded-xl
                                                  text-sm font-bold text-white
                                                  bg-gradient-to-r from-blue-600 to-blue-500
                                                  hover:from-blue-500 hover:to-blue-400
                                                  shadow-lg shadow-blue-500/20 transition-all">
                                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none"
                                                 stroke="currentColor" stroke-width="2">
                                                <rect x="3" y="3" width="7" height="7"/>
                                                <rect x="14" y="3" width="7" height="7"/>
                                                <rect x="3" y="14" width="7" height="7"/>
                                                <rect x="14" y="14" width="3" height="3"/>
                                            </svg>
                                            View QR
                                        </a>
                                    </div>

                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if($pastTickets->isNotEmpty())
                    <div>
                        <h2 class="text-base font-bold text-white mb-4">
                            Past events
                            <span class="text-gray-600 font-normal text-sm ml-2">
                                {{ $pastTickets->count() }} events
                            </span>
                        </h2>
                        <div class="space-y-3">
                            @foreach($pastTickets as $ticket)
                                <div class="bg-[#1A1D24] border border-white/5 rounded-3xl p-5
                                            shadow-xl hover:border-white/10 transition-all
                                            flex items-center gap-5 opacity-60">

                                    <div class="w-14 h-14 rounded-2xl overflow-hidden flex-shrink-0 bg-white/5">
                                        @if($ticket->event->cover_image)
                                            <img src="{{ str_starts_with($ticket->event->cover_image, 'http')
                                                            ? $ticket->event->cover_image
                                                            : Storage::url($ticket->event->cover_image) }}"
                                                 class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full bg-gradient-to-br from-gray-900 to-gray-900"></div>
                                        @endif
                                    </div>

                                    <div class="flex-1 min-w-0">
                                        <p class="text-white font-bold text-sm truncate">
                                            {{ $ticket->event->name }}
                                        </p>
                                        <p class="text-gray-500 text-xs mt-0.5">
                                            {{ $ticket->event->location }} ·
                                            {{ $ticket->event->start_date->format('M d, Y') }}
                                        </p>
                                        <span class="inline-block mt-2 text-xs text-gray-500
                                                     bg-white/5 border border-white/10
                                                     px-2.5 py-0.5 rounded-full">
                                            {{ $ticket->ticketType->name }}
                                        </span>
                                    </div>

                                    <div class="flex items-center gap-3 flex-shrink-0">
                                        <div class="text-right">
                                            <p class="text-xs text-gray-500">Paid</p>
                                            <p class="text-sm font-bold text-gray-400">
                                                €{{ number_format($ticket->price, 2) }}
                                            </p>
                                        </div>
                                        <a href="{{ route('audience.tickets.show', $ticket->barcode) }}"
                                           class="flex items-center gap-2 px-4 py-2 rounded-xl
                                                  text-sm font-medium text-gray-400
                                                  border border-white/10 hover:border-white/20
                                                  hover:text-white transition-all">
                                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none"
                                                 stroke="currentColor" stroke-width="2">
                                                <rect x="3" y="3" width="7" height="7"/>
                                                <rect x="14" y="3" width="7" height="7"/>
                                                <rect x="3" y="14" width="7" height="7"/>
                                                <rect x="14" y="14" width="3" height="3"/>
                                            </svg>
                                            View QR
                                        </a>
                                    </div>

                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

            @endif

        </div>
    </div>
</x-layout>
