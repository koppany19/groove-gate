@props(['event'])

<div class="relative w-full h-[500px] overflow-hidden">

    @if($event->cover_image)
        <img src="{{ str_starts_with($event->cover_image, 'http') ? $event->cover_image : Storage::url($event->cover_image) }}"
             alt="{{ $event->name }}"
             class="absolute inset-0 w-full h-full object-cover">
    @else
        <div class="absolute inset-0 bg-gradient-to-br from-gray-900 via-blue-950 to-gray-900"></div>
        <div class="absolute top-10 right-20 w-72 h-72 rounded-full bg-blue-500/5 blur-3xl"></div>
        <div class="absolute bottom-20 left-40 w-96 h-96 rounded-full bg-purple-500/5 blur-3xl"></div>
    @endif

    <div class="absolute inset-0 bg-gradient-to-t from-(--color-artist-bg) via-(--color-artist-bg)/50 to-transparent"></div>
    <div class="absolute inset-0 bg-gradient-to-r from-(--color-artist-bg)/40 to-transparent"></div>

    <div class="absolute top-6 right-8 z-10 flex items-center gap-3">
        <a href="{{ route('organiser.events.edit', $event) }}"
           class="flex items-center gap-2 px-4 py-2 rounded-full text-sm font-semibold text-white bg-white/10 hover:bg-white/20 border border-white/20 backdrop-blur-md transition-all">
            <x-icon name="edit" size="13" />
            Edit
        </a>

        @if($event->status === \App\EventStatus::DRAFT)
            <form action="{{ route('organiser.events.publish', $event) }}" method="POST">
                @csrf @method('PATCH')
                <button type="submit"
                        class="flex items-center gap-2 px-4 py-2 rounded-full text-sm font-semibold
                               text-white bg-emerald-500/80 hover:bg-emerald-500
                               border border-emerald-500/50 backdrop-blur-md transition-all">
                    <x-icon name="check" size="13" />
                    Publish
                </button>
            </form>
        @endif

        @if($event->status === \App\EventStatus::PUBLISHED)
            <form action="{{ route('organiser.events.cancel', $event) }}" method="POST">
                @csrf @method('PATCH')
                <button type="submit"
                        onclick="return confirm('Are you sure?')"
                        class="flex items-center gap-2 px-4 py-2 rounded-full text-sm font-semibold text-white bg-red-500/20 hover:bg-red-500/40 border border-red-500/30 backdrop-blur-md transition-all">
                    <x-icon name="cancel" size="13" />
                    Cancel Event
                </button>
            </form>
        @endif
    </div>

    <div class="absolute bottom-0 left-0 w-full z-10">
        <div class="max-w-7xl mx-auto px-6 md:px-12 pb-10">

            <div class="mb-4">
                <x-organiser.events.event-status-badge :status="$event->status" />
            </div>

            <h1 class="text-5xl md:text-7xl font-black text-white tracking-tight drop-shadow-lg mb-5">
                {{ $event->name }}
            </h1>

            <div class="flex flex-wrap gap-3">
                <span class="flex items-center gap-1.5 text-sm text-purple-300 bg-purple-500/10 backdrop-blur-sm px-4 py-2 rounded-full border border-purple-500/20">
                    <x-icon name="location" size="13" />
                    {{ $event->location }}
                </span>

                @if($event->capacity)
                    <span class="flex items-center gap-1.5 text-sm text-emerald-300 bg-emerald-500/10 backdrop-blur-sm px-4 py-2 rounded-full border border-emerald-500/20">
                        <x-icon name="users" size="13" />
                        {{ number_format($event->capacity) }} capacity
                    </span>
                @endif
            </div>
        </div>
    </div>
</div>
