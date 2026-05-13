<x-layout>
    <div class="min-h-screen bg-(--color-artist-bg) text-white -m-8 p-6 md:p-10">
        <div class="max-w-[1100px] mx-auto">

            <div class="flex items-center gap-4 mb-6">
                <a href="{{ $backRoute }}"
                   class="p-2 rounded-xl bg-white/5 hover:bg-white/10 border border-white/10 transition-all">
                    <x-icon name="arrow-left" size="18" />
                </a>

                <div class="flex items-center gap-3">
                    <div class="message-avatar">
                        @if($other->avatar)
                            <img src="{{ str_starts_with($other->avatar, 'http') ? $other->avatar : Storage::url($other->avatar) }}"
                                 class="w-full h-full object-cover">
                        @else
                            <span class="text-sm font-black text-(--color-artist)">
                                {{ strtoupper(substr($other->name, 0, 1)) }}
                            </span>
                        @endif
                    </div>
                    <div>
                        <p class="text-white font-bold text-sm">{{ $other->name }}</p>
                        <p class="text-xs text-(--color-muted)">{{ $conversation->booking->event->name }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-(--color-surface-3) border border-white/5 rounded-3xl p-6 shadow-xl">
                <livewire:message-thread :conversation="$conversation" />
            </div>

        </div>
    </div>
</x-layout>
