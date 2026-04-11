@props(['user','profile'])

<div class="relative w-full h-[450px] bg-cover bg-center">
    @if($profile->cover_image)
        <img src="{{ str_starts_with($profile->cover_image, 'http') ? $profile->cover_image : Storage::url($profile->cover_image) }}"
             alt="Cover"
             class="absolute inset-0 w-full h-full object-cover">
    @else
        <div class="absolute inset-0 bg-gradient-to-br from-gray-900 via-blue-950 to-gray-900"></div>
        <div class="absolute top-10 right-20 w-64 h-64 rounded-full bg-blue-500/5 blur-3xl"></div>
        <div class="absolute bottom-20 left-40 w-80 h-80 rounded-full bg-purple-500/5 blur-3xl"></div>
    @endif

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
                        <img src="{{ str_starts_with($user->avatar, 'http')
                                    ? $user->avatar
                                    : Storage::url($user->avatar) }}"
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
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-3 w-3 bg-emerald-500"></span>
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
                                     tracking-wider bg-purple-500/15 text-purple-400
                                     border border-purple-500/30">
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

                    @if($profile->spotify_url || $profile->soundcloud_url || $profile->youtube_url || $profile->instagram_url)
                        <div class="w-px h-5 bg-white/20"></div>

                        @if($profile->spotify_url)
                            <a href="{{ $profile->spotify_url }}" target="_blank"
                               class="w-8 h-8 rounded-full bg-green-500/10 border border-green-500/20
                                      flex items-center justify-center text-green-400
                                      hover:opacity-80 transition-all">
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M12 0C5.4 0 0 5.4 0 12s5.4 12 12 12 12-5.4 12-12S18.66 0 12 0zm5.521 17.34c-.24.359-.66.48-1.021.24-2.82-1.74-6.36-2.101-10.561-1.141-.418.122-.779-.179-.899-.539-.12-.421.18-.78.54-.9 4.56-1.021 8.52-.6 11.64 1.32.42.18.479.659.301 1.02zm1.44-3.3c-.301.42-.841.6-1.262.3-3.239-1.98-8.159-2.58-11.939-1.38-.479.12-1.02-.12-1.14-.6-.12-.48.12-1.021.6-1.141C9.6 9.9 15 10.561 18.72 12.84c.361.181.54.78.241 1.2zm.12-3.36C15.24 8.4 8.82 8.16 5.16 9.301c-.6.179-1.2-.181-1.38-.721-.18-.601.18-1.2.72-1.381 4.26-1.26 11.28-1.02 15.721 1.621.539.3.719 1.02.419 1.56-.299.421-1.02.599-1.559.3z"/>
                                </svg>
                            </a>
                        @endif

                        @if($profile->soundcloud_url)
                            <a href="{{ $profile->soundcloud_url }}" target="_blank"
                               class="w-8 h-8 rounded-full bg-orange-500/10 border border-orange-500/20
                                      flex items-center justify-center text-orange-400
                                      hover:opacity-80 transition-all">
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M11.56 8.87V17h8.76c.96-.19 1.68-.96 1.68-1.96 0-1.08-.84-1.96-1.96-1.96-.2 0-.36.04-.56.08C19.32 11.6 17.64 10 15.6 10c-.36 0-.72.08-1.04.2-.48-1.56-1.92-2.72-3.64-2.72-.52 0-1 .12-1.44.36.32.28.57.6.76.96.24-.12.48-.2.76-.2 1.16 0 2.04.88 2.04 2.04V8.87zM0 15.56c0 .84.68 1.52 1.52 1.52s1.52-.68 1.52-1.52v-4.4c0-.84-.68-1.52-1.52-1.52S0 10.32 0 11.16v4.4zm4.36 1.04c0 .84.68 1.52 1.52 1.52s1.52-.68 1.52-1.52V9.4c0-.84-.68-1.52-1.52-1.52S4.36 8.56 4.36 9.4v7.2zm4.44.48c0 .84.68 1.52 1.52 1.52s1.52-.68 1.52-1.52V8.88c0-.84-.68-1.52-1.52-1.52S8.8 8.04 8.8 8.88v8.2z"/>
                                </svg>
                            </a>
                        @endif

                        @if($profile->youtube_url)
                            <a href="{{ $profile->youtube_url }}" target="_blank"
                               class="w-8 h-8 rounded-full bg-red-500/10 border border-red-500/20
                                      flex items-center justify-center text-red-400
                                      hover:opacity-80 transition-all">
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                                </svg>
                            </a>
                        @endif

                        @if($profile->instagram_url)
                            <a href="{{ $profile->instagram_url }}" target="_blank"
                               class="w-8 h-8 rounded-full bg-pink-500/10 border border-pink-500/20
                                      flex items-center justify-center text-pink-400
                                      hover:opacity-80 transition-all">
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 1 0 0 12.324 6.162 6.162 0 0 0 0-12.324zM12 16a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm6.406-11.845a1.44 1.44 0 1 0 0 2.881 1.44 1.44 0 0 0 0-2.881z"/>
                                </svg>
                            </a>
                        @endif
                    @endif

                </div>
            </div>

        </div>
    </div>
</div>
