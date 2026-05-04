<x-layout>
    <div class="min-h-screen bg-(--artist-background) text-white -m-8 p-6 md:p-10">
        <div class="max-w-[1400px] mx-auto">

            <div class="mb-10">
                <h1 class="text-3xl font-black text-white tracking-tight">Events</h1>
                <p class="text-sm text-gray-400 mt-1">{{ $events->total() }} upcoming events</p>
            </div>

            @if($events->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6 mb-8">
                    @foreach($events as $event)
                        <x-audience.event-card :event="$event" />
                    @endforeach
                </div>
                {{ $events->links() }}

            @else
                <div class="flex flex-col items-center justify-center py-24">
                    <div class="w-20 h-20 rounded-full bg-white/5 flex items-center justify-center mb-6">
                        <svg width="36" height="36" fill="none" stroke="currentColor"
                             stroke-width="1.5" viewBox="0 0 24 24" class="text-gray-600">
                            <rect x="3" y="4" width="18" height="18" rx="2"/>
                            <line x1="3" y1="10" x2="21" y2="10"/>
                        </svg>
                    </div>
                    <h2 class="text-xl font-bold text-white mb-2">No events yet</h2>
                    <p class="text-gray-500 text-sm">Check back soon for upcoming events.</p>
                </div>
            @endif
        </div>
    </div>
</x-layout>
