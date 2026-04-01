@props(['user','profile'])

<div class="relative w-full h-[450px] bg-cover bg-center">
    <div class="absolute inset-0 bg-gradient-to-t from-(--artist-background) via-(--artist-background)/60 to-(--artist-background)/20"></div>

    <div class="absolute top-6 right-8 z-10">
        <a href="{{ route('artist.profile.edit') }}"
           class="flex items-center gap-2 px-5 py-2.5 rounded-full text-sm font-semibold
                  text-white bg-white/10 hover:bg-white/20 border border-white/20
                  backdrop-blur-md transition-all duration-300">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="2">
                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
            </svg>
            Edit Profile
        </a>
    </div>

    <div class="absolute bottom-0 left-0 w-full z-10">
        <div class="max-w-7xl mx-auto px-6 md:px-12 pb-10 flex flex-col md:flex-row items-end gap-8">

            <div class="relative shrink-0">
                <div class="w-32 h-32 md:w-40 md:h-40 rounded-full overflow-hidden
                            border-4 border-(--artist-background) bg-[#151E2D]
                            flex items-center justify-center shadow-2xl relative z-10">
                    @if($user->avatar)
                        <img src="{{ $user->avatar }}"
                             alt="{{ $profile->stage_name ?? $user->name }}"
                             class="w-full h-full object-cover">
                    @else
                        <span class="text-5xl font-black text-blue-400">
                            {{ strtoupper(substr($profile->stage_name ?? $user->name, 0, 1)) }}
                        </span>
                    @endif
                </div>

                @if($profile->is_available ?? true)
                    <div class="absolute bottom-2 right-2 md:bottom-4 md:right-4
                                flex items-center gap-2 bg-(--artist-background) rounded-full
                                pl-1.5 pr-3 py-1 border border-white/10 z-20 shadow-lg">
                        <span class="relative flex h-3 w-3">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75">

                            </span>
                            <span class="relative inline-flex rounded-full h-3 w-3 bg-emerald-500">

                            </span>
                        </span>
                        <span class="text-[10px] font-bold uppercase tracking-wider text-gray-300">
                            Available
                        </span>
                    </div>
                @endif
            </div>

            <div class="flex-1 pb-2">
                <div class="flex items-center gap-3 mb-2">
                    <h1 class="text-5xl md:text-7xl font-black text-white tracking-tight drop-shadow-lg">
                        {{ $profile->stage_name ?? $user->name }}
                    </h1>
                    <svg class="w-8 h-8 text-blue-400 drop-shadow-md"
                         fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                              d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                              clip-rule="evenodd"/>
                    </svg>
                </div>

                <div class="flex flex-wrap items-center gap-3 mt-4">

                    @if($profile->location)
                        <span class="flex items-center gap-1.5 text-sm font-medium text-gray-300
                                     bg-white/5 px-4 py-1.5 rounded-full backdrop-blur-sm
                                     border border-white/10 shadow-sm">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none"
                                 stroke="currentColor" stroke-width="2">
                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                                <circle cx="12" cy="10" r="3"/>
                            </svg>
                            {{ $profile->location }}
                        </span>
                    @endif

                    @if($profile->artist_type)
                        <span class="px-4 py-1.5 rounded-full text-xs font-bold uppercase
                                     tracking-wider bg-blue-500/15 text-blue-400
                                     border border-blue-500/30">
                            {{ $profile->artist_type->value }}
                        </span>
                    @endif

                    @if($profile->genre)
                        @foreach(array_slice($profile->genre, 0, 3) as $genre)
                            <span class="px-4 py-1.5 rounded-full text-xs font-bold uppercase
                                         tracking-wider bg-blue-500/15 text-blue-400
                                         border border-blue-500/30">
                                {{ $genre }}
                            </span>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
