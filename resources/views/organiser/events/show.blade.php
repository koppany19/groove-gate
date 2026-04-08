<x-layout>
    <div class="min-h-screen bg-(--color-artist-bg) text-white -m-8">

        <x-organiser.events.event-hero :event="$event" />

        <div class="max-w-7xl mx-auto px-6 md:px-12 grid grid-cols-1 xl:grid-cols-3 gap-8 mt-8 pb-20">

            <div class="xl:col-span-2 space-y-6">

                <div class="bg-(--color-card) border border-white/5 rounded-3xl p-8 shadow-xl">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-9 h-9 rounded-xl bg-blue-500/10 border border-blue-500/20 flex items-center justify-center shrink-0">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#3b82f6" stroke-width="2">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                                <polyline points="14 2 14 8 20 8"/>
                                <line x1="16" y1="13" x2="8" y2="13"/>
                                <line x1="16" y1="17" x2="8" y2="17"/>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-lg font-bold text-white">About this Event</h2>
                            <p class="text-xs text-gray-500">Event description</p>
                        </div>
                    </div>
                    @if($event->description)
                        <p class="text-gray-300 leading-relaxed">{{ $event->description }}</p>
                    @else
                        <div class="flex items-center gap-3 py-4">
                            <div class="w-8 h-8 rounded-lg bg-white/5 flex items-center justify-center">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-gray-600">
                                    <circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/>
                                </svg>
                            </div>
                            <p class="text-gray-600 text-sm">No description added yet.</p>
                        </div>
                    @endif
                </div>

                <div class="bg-(--color-card) border border-white/5 rounded-3xl p-8 shadow-xl">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-9 h-9 rounded-xl bg-purple-500/10 border border-purple-500/20 flex items-center justify-center shrink-0">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#a855f7" stroke-width="2">
                                <rect x="3" y="4" width="18" height="18" rx="2"/>
                                <line x1="16" y1="2" x2="16" y2="6"/>
                                <line x1="8" y1="2" x2="8" y2="6"/>
                                <line x1="3" y1="10" x2="21" y2="10"/>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-lg font-bold text-white">Event Details</h2>
                            <p class="text-xs text-gray-500">Dates</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">

                        <div class="bg-gradient-to-br from-blue-500/5 to-transparent rounded-2xl p-5 border border-blue-500/10">
                            <div class="flex items-center gap-2 mb-3">
                                <div class="w-6 h-6 rounded-lg bg-blue-500/10 flex items-center justify-center">
                                    <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="#3b82f6" stroke-width="2">
                                        <circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/>
                                    </svg>
                                </div>
                                <p class="text-xs text-blue-400 font-semibold uppercase tracking-wider">Start Date</p>
                            </div>
                            <p class="text-white font-bold text-lg">{{ $event->start_date->format('M d, Y') }}</p>
                            <p class="text-gray-400 text-sm mt-0.5">{{ $event->start_date->format('H:i') }}</p>
                        </div>

                        @if($event->end_date)
                            <div class="bg-gradient-to-br from-gray-500/5 to-transparent rounded-2xl p-5 border border-white/5">
                                <div class="flex items-center gap-2 mb-3">
                                    <div class="w-6 h-6 rounded-lg bg-white/5 flex items-center justify-center">
                                        <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="#9ca3af" stroke-width="2">
                                            <circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/>
                                        </svg>
                                    </div>
                                    <p class="text-xs text-gray-400 font-semibold uppercase tracking-wider">End Date</p>
                                </div>
                                <p class="text-white font-bold text-lg">{{ $event->end_date->format('M d, Y') }}</p>
                                <p class="text-gray-400 text-sm mt-0.5">{{ $event->end_date->format('H:i') }}</p>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="bg-(--color-card) border border-white/5 rounded-3xl p-8 shadow-xl">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-9 h-9 rounded-xl bg-orange-500/10 border border-orange-500/20 flex items-center justify-center shrink-0">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#f97316" stroke-width="2">
                                <path d="M9 18V5l12-2v13"/>
                                <circle cx="6" cy="18" r="3"/>
                                <circle cx="18" cy="16" r="3"/>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-lg font-bold text-white">Lineup</h2>
                            <p class="text-xs text-gray-500">Artists performing at this event</p>
                        </div>
                    </div>

                    <div class="flex flex-col items-center justify-center py-10 rounded-2xl border border-dashed border-white/10 bg-white/[0.02]">
                        <div class="w-14 h-14 rounded-2xl bg-orange-500/10 border border-orange-500/20
                                    flex items-center justify-center mb-4">
                            <svg width="24" height="24" fill="none" stroke="#f97316"
                                 stroke-width="1.5" viewBox="0 0 24 24">
                                <path d="M9 18V5l12-2v13"/>
                                <circle cx="6" cy="18" r="3"/>
                                <circle cx="18" cy="16" r="3"/>
                            </svg>
                        </div>
                        <p class="text-gray-400 text-sm font-medium">No artists booked yet</p>
                        <p class="text-gray-600 text-xs mt-1">Accepted bookings will appear here</p>
                    </div>
                </div>

            </div>

            <div class="space-y-6">
                <x-organiser.events.event-info-card :event="$event" />
            </div>

        </div>
    </div>
</x-layout>
