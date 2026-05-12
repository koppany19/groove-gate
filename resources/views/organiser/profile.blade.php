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
                            <x-icon name="file" size="14" class="text-gray-400" />
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
