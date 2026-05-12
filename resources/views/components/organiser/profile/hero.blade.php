@props(['user', 'profile'])

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

        <div class="absolute inset-0 bg-gradient-to-t from-(--color-artist-bg) via-(--color-artist-bg)/60 to-(--color-artist-bg)/20"></div>

    <div class="absolute top-6 right-8 z-10">
        <a href="{{ route('organiser.profile.edit') }}"
           class="flex items-center gap-2 px-5 py-2.5 rounded-full text-sm font-semibold text-white bg-white/10 hover:bg-white/20 border border-white/20 backdrop-blur-md transition-all duration-300">
            <x-icon name="edit" size="14" />
            Edit Profile
        </a>
    </div>

    <div class="absolute bottom-0 left-0 w-full z-10">
        <div class="max-w-7xl mx-auto px-6 md:px-12 pb-10 flex flex-col md:flex-row items-end gap-8">

            <div class="relative shrink-0">
                <div class="w-32 h-32 md:w-40 md:h-40 rounded-full overflow-hidden
                            border-4 border-(--color-artist-bg) bg-[#151E2D]
                            flex items-center justify-center shadow-2xl relative z-10">
                    @if($user->avatar)
                        <img src="{{ str_starts_with($user->avatar, 'http')
                                        ? $user->avatar
                                        : Storage::url($user->avatar) }}"
                             alt="{{ $profile->company_name ?? $user->name }}"
                             class="w-full h-full object-cover">
                    @else
                        <span class="text-5xl font-black text-orange-400">
                            {{ strtoupper(substr($profile->company_name ?? $user->name, 0, 1)) }}
                        </span>
                    @endif
                </div>
            </div>

            <div class="flex-1 pb-2">
                <div class="flex items-center gap-3 mb-2">
                    <h1 class="text-5xl md:text-7xl font-black text-white tracking-tight drop-shadow-lg">
                        {{ $profile->company_name ?? $user->name }}
                    </h1>
                    <svg class="w-8 h-8 text-orange-400 drop-shadow-md"
                         fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                              d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                              clip-rule="evenodd"/>
                    </svg>
                </div>

                <div class="flex flex-wrap items-center gap-3 mt-2">

                    @if($profile->location)
                        <span class="flex items-center gap-1.5 text-sm font-medium text-purple-300
                                     bg-purple-500/10 px-4 py-1.5 rounded-full backdrop-blur-sm
                                     border border-purple-500/20">
                            <x-icon name="location" size="14" />
                            {{ $profile->location }}
                        </span>
                    @endif

                    <span class="flex items-center gap-1.5 text-sm font-medium text-orange-300
                                 bg-orange-500/10 px-4 py-1.5 rounded-full backdrop-blur-sm
                                 border border-orange-500/20">
                        <x-icon name="user" size="14" />
                        Organiser
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
