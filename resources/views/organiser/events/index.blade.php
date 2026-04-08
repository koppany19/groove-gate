<x-layout>

    <div class="min-h-screen bg-(--artist-background) text-white -m-8 p-6 md:p-10">
        <div class="max-w-[1400px] mx-auto">

            <div class="flex items-center justify-between mb-10">
                <div>
                    <h1 class="text-3xl font-black text-white tracking-tight">
                        My Events
                    </h1>
                    <p class="text-sm text-gray-400 mt-1">
                        {{ $events->total() }} events total
                    </p>
                </div>
                <a href="{{ route('organiser.events.create') }}"
                   class="flex items-center gap-2 px-5 py-2.5 rounded-full text-sm font-bold text-white bg-blue-500 hover:opacity-90 transition-all shadow-[0_0_15px_rgba(59,130,246,0.3)]">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2">
                        <line x1="12" y1="5" x2="12" y2="19"/>
                        <line x1="5" y1="12" x2="19" y2="12"/>
                    </svg>
                    New Event
                </a>
            </div>

            @if($events->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6 mb-8">
                    @foreach($events as $event)
                        <x-organiser.events.event-card :event="$event" />
                    @endforeach
                </div>

                {{ $events->links() }}

            @else
                <div class="flex flex-col items-center justify-center py-24">
                    <div class="w-20 h-20 rounded-full bg-white/5 flex items-center justify-center mb-6">
                        <svg width="36" height="36" fill="none" stroke="currentColor"
                             stroke-width="1.5" viewBox="0 0 24 24" class="text-gray-600">
                            <rect x="3" y="4" width="18" height="18" rx="2"/>
                            <line x1="16" y1="2" x2="16" y2="6"/>
                            <line x1="8" y1="2" x2="8" y2="6"/>
                            <line x1="3" y1="10" x2="21" y2="10"/>
                        </svg>
                    </div>

                    <h2 class="text-xl font-bold text-white mb-2">No events yet</h2>
                    <p class="text-gray-500 text-sm mb-6">
                        Create your first event to get started.
                    </p>
                    <a href="{{ route('organiser.events.create') }}"
                       class="flex items-center gap-2 px-6 py-3 rounded-full text-sm font-bold text-white bg-blue-500 hover:opacity-90 transition-all">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2">
                            <line x1="12" y1="5" x2="12" y2="19"/>
                            <line x1="5" y1="12" x2="19" y2="12"/>
                        </svg>
                        Create Event
                    </a>
                </div>
            @endif
        </div>
    </div>
</x-layout>
