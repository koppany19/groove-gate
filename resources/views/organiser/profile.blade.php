<x-layout>
    <div class="min-h-screen bg-(--color-artist-bg) text-white -m-8">

        <x-organiser.profile.hero :user="$user" :profile="$profile" />

        <div class="max-w-7xl mx-auto px-6 md:px-12 grid grid-cols-1
                    xl:grid-cols-3 gap-8 mt-8 pb-20">

            <div class="xl:col-span-2 space-y-6">

                <div class="bg-(--color-card) border border-white/5 rounded-3xl p-8 shadow-xl">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-9 h-9 rounded-xl bg-orange-500/10 border border-orange-500/20
                                    flex items-center justify-center shrink-0">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                 stroke="#f97316" stroke-width="2">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                                <polyline points="14 2 14 8 20 8"/>
                                <line x1="16" y1="13" x2="8" y2="13"/>
                                <line x1="16" y1="17" x2="8" y2="17"/>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-lg font-bold text-white">About</h2>
                            <p class="text-xs text-gray-500">Company description</p>
                        </div>
                    </div>

                    @if($profile->description)
                        <p class="text-gray-300 leading-relaxed">{{ $profile->description }}</p>
                    @else
                        <div class="flex items-center gap-3 py-4">
                            <div class="w-8 h-8 rounded-lg bg-white/5 flex items-center justify-center">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none"
                                     stroke="currentColor" stroke-width="2" class="text-gray-600">
                                    <circle cx="12" cy="12" r="10"/>
                                    <line x1="12" y1="8" x2="12" y2="12"/>
                                    <line x1="12" y1="16" x2="12.01" y2="16"/>
                                </svg>
                            </div>
                            <p class="text-gray-600 text-sm">No description added yet.</p>
                        </div>
                    @endif
                </div>

            </div>

            <div class="space-y-6">
                <x-organiser.profile.info-card :user="$user" :profile="$profile" />
            </div>

        </div>
    </div>
</x-layout>
