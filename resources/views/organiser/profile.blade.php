<x-layout>
    <div class="min-h-screen bg-(--color-artist-bg) text-white -m-8">

        <x-organiser.profile.hero :user="$user" :profile="$profile" />

        <div class="max-w-7xl mx-auto px-6 md:px-12 grid grid-cols-1
                    xl:grid-cols-3 gap-8 mt-8 pb-20">

            <div class="xl:col-span-2 space-y-6">

                <div class="bg-[#1A1D24] border border-white/5 rounded-3xl p-8 shadow-xl
                            hover:border-white/10 transition-all"
                     x-data="{ expanded: false }">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-8 h-8 rounded-xl bg-white/5 border border-white/10
                                    flex items-center justify-center shrink-0">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none"
                                 stroke="currentColor" stroke-width="2" class="text-gray-400">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                                <polyline points="14 2 14 8 20 8"/>
                                <line x1="16" y1="13" x2="8" y2="13"/>
                                <line x1="16" y1="17" x2="8" y2="17"/>
                            </svg>
                        </div>
                        <h2 class="text-base font-bold text-white">About</h2>
                    </div>

                    @if($profile->description)
                        <p class="text-gray-300 leading-relaxed text-sm"
                           :class="expanded ? '' : 'line-clamp-3'">
                            {{ $profile->description }}
                        </p>
                        <button @click="expanded = !expanded"
                                class="text-xs text-gray-500 hover:text-white mt-3 transition-colors">
                            <span x-text="expanded ? 'Show less ↑' : 'Show more...'"></span>
                        </button>
                    @else
                        <p class="text-gray-600 text-sm">No description added yet.</p>
                    @endif
                </div>

            </div>

            <div class="space-y-6">
                <x-organiser.profile.info-card :user="$user" :profile="$profile" />
            </div>

        </div>
    </div>
</x-layout>
