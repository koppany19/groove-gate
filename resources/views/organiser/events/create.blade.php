<x-layout>
    <div class="min-h-screen bg-(--color-artist-bg) text-white -m-8 p-6 md:p-10">
        <div class="max-w-[1400px] mx-auto">

            <div class="mb-10">
                <div class="flex items-center gap-2 text-xs text-gray-500 mb-4">
                    <a href="{{ route('organiser.events.index') }}"
                       class="hover:text-white transition-colors">All Events</a>
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2">
                        <path d="M9 18l6-6-6-6"/>
                    </svg>
                    <span class="text-white">New Event</span>
                </div>

                <div class="flex items-center gap-4">
                    <a href="{{ route('organiser.events.index') }}"
                       class="p-2 rounded-xl bg-white/5 hover:bg-white/10
                              border border-white/10 transition-all">
                        <svg width="18" height="18" fill="none" stroke="currentColor"
                             stroke-width="2" viewBox="0 0 24 24">
                            <path d="M19 12H5M12 19l-7-7 7-7"/>
                        </svg>
                    </a>
                    <div>
                        <h1 class="text-3xl font-black text-white tracking-tight">
                            Create Event
                        </h1>
                        <p class="text-sm text-gray-400 mt-1">
                            Fill in the details to create a new event
                        </p>
                    </div>
                </div>
            </div>

            <form action="{{ route('organiser.events.store') }}" method="POST"
                  enctype="multipart/form-data">
                @csrf

                <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
                    <div class="xl:col-span-2 space-y-6">
                        <x-organiser.events.event-form.basic-info />
                        <x-organiser.events.event-form.details />
                    </div>
                    <div class="space-y-6">
                        <x-organiser.events.event-form.save-card label="Create Event" />
                        <x-organiser.events.event-form.cover-upload />
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-layout>
