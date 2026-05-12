<x-layout>

    <div class="min-h-screen bg-(--color-artist-bg) text-white -m-8 p-6 md:p-10">
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
                    <x-icon name="plus" size="16" />
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
                        <x-icon name="calendar" size="36" stroke-width="1.5" class="text-gray-600" />
                    </div>

                    <h2 class="text-xl font-bold text-white mb-2">No events yet</h2>
                    <p class="text-gray-500 text-sm mb-6">
                        Create your first event to get started.
                    </p>
                    <a href="{{ route('organiser.events.create') }}"
                       class="flex items-center gap-2 px-6 py-3 rounded-full text-sm font-bold text-white bg-blue-500 hover:opacity-90 transition-all">
                        <x-icon name="plus" size="16" />
                        Create Event
                    </a>
                </div>
            @endif
        </div>
    </div>
</x-layout>
