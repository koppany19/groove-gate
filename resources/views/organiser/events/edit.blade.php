<x-layout>
    <div class="min-h-screen bg-(--color-artist-bg) text-white -m-8 p-6 md:p-10">
        <div class="max-w-[1400px] mx-auto">

            <div class="mb-10">
                <div class="flex items-center gap-2 text-xs text-gray-500 mb-4">
                    <a href="{{ route('organiser.events.index') }}"
                       class="hover:text-white transition-colors">All Events</a>
                    <x-icon name="arrow-right" size="12" />
                    <a href="{{ route('organiser.events.show', $event) }}"
                       class="hover:text-white transition-colors">{{ $event->name }}</a>
                    <x-icon name="arrow-right" size="12" />
                    <span class="text-white">Edit</span>
                </div>

                <div class="flex items-center gap-4">
                    <a href="{{ route('organiser.events.show', $event) }}"
                       class="p-2 rounded-xl bg-white/5 hover:bg-white/10
                              border border-white/10 transition-all">
                        <x-icon name="arrow-left" size="18" />
                    </a>
                    <div>
                        <div class="flex items-center gap-3">
                            <h1 class="text-3xl font-black text-white tracking-tight">
                                Edit Event
                            </h1>
                            <x-organiser.events.event-status-badge :status="$event->status" />
                        </div>
                        <p class="text-sm text-gray-400 mt-1">{{ $event->name }}</p>
                    </div>
                </div>
            </div>

            <form action="{{ route('organiser.events.update', $event) }}" method="POST"
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
                    <div class="xl:col-span-2 space-y-6">
                        <x-organiser.events.event-form.basic-info :event="$event" />
                        <x-organiser.events.event-form.details :event="$event" />
                    </div>
                    <div class="space-y-6">
                        <x-organiser.events.event-form.save-card :event="$event" label="Save Changes" />
                        <x-organiser.events.event-form.cover-upload :event="$event" />
                    </div>
                </div>

            </form>

            <div class="bg-(--color-card) border border-red-500/10 rounded-3xl p-5 mt-8">
                <div class="flex items-center gap-2 mb-4">
                    <div class="w-7 h-7 rounded-lg bg-red-500/10 flex items-center justify-center">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="#ef4444" stroke-width="2">
                            <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/>
                            <line x1="12" y1="9" x2="12" y2="13"/>
                            <line x1="12" y1="17" x2="12.01" y2="17"/>
                        </svg>
                    </div>
                    <p class="text-xs font-semibold text-red-400 uppercase tracking-wider">Danger Zone</p>
                </div>
                <form action="{{ route('organiser.events.destroy', $event) }}" method="POST"
                      onsubmit="return confirm('Are you sure? This cannot be undone.')">
                    @csrf @method('DELETE')
                    <button type="submit"
                            class="w-full py-2.5 rounded-xl text-sm font-medium text-red-400
                       border border-red-500/20 hover:bg-red-500/10 transition-all">
                        Delete Event
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-layout>
