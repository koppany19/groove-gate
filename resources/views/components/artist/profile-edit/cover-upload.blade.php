@props(['user', 'profile'])

<div class="bg-(--color-edit-background) border border-white/5 rounded-3xl p-6 shadow-xl">
    <h2 class="text-lg font-bold text-white mb-5 flex items-center gap-2">
        <div class="w-1 h-5 bg-blue-500 rounded-full"></div>
        Images
    </h2>

    <div class="space-y-6">

        <div class="space-y-2">
            <label class="text-sm font-medium text-gray-300">Cover Image</label>
            <div class="relative w-full h-32 rounded-2xl overflow-hidden border border-white/10
                        bg-white/5 flex items-center justify-center group cursor-pointer">

                @if($profile->cover_image)
                    <img src="{{ str_starts_with($profile->cover_image, 'http')
                                ? $profile->cover_image
                                : Storage::url($profile->cover_image) }}"
                         alt="Cover"
                         class="absolute inset-0 w-full h-full object-cover">
                    <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100
                                transition-all flex items-center justify-center">
                        <span class="text-white text-xs font-semibold">Change Cover</span>
                    </div>
                @else
                    <div class="text-center">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="1.5"
                             class="text-gray-600 mx-auto mb-2">
                            <rect x="3" y="3" width="18" height="18" rx="2"/>
                            <circle cx="8.5" cy="8.5" r="1.5"/>
                            <polyline points="21 15 16 10 5 21"/>
                        </svg>
                        <p class="text-xs text-gray-600">Upload cover image</p>
                        <p class="text-xs text-gray-700 mt-0.5">Recommended: 1920x400px</p>
                    </div>
                @endif

                <input type="file" name="cover_image"
                       accept="image/*"
                       class="absolute inset-0 opacity-0 cursor-pointer">
            </div>
            @error('cover_image')
                <p class="text-red-400 text-xs">{{ $message }}</p>
            @enderror
        </div>


        <div class="space-y-2">
            <label class="text-sm font-medium text-gray-300">Profile Photo</label>
            <div class="flex items-center gap-4">

                <div class="w-16 h-16 rounded-full overflow-hidden flex-shrink-0
                            border-2 border-white/10 bg-white/5
                            flex items-center justify-center">
                    @if($user->avatar)
                        <img src="{{ str_starts_with($user->avatar, 'http')
                                    ? $user->avatar
                                    : Storage::url($user->avatar) }}"
                             alt="{{ $user->name }}"
                             class="w-full h-full object-cover">
                    @else
                        <span class="text-xl font-black text-blue-400">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </span>
                    @endif
                </div>

                <div class="flex-1">
                    <label class="flex items-center gap-2 px-4 py-2.5 rounded-xl
                                  border border-white/10 bg-white/5 hover:bg-white/10
                                  text-sm text-gray-300 cursor-pointer transition-all
                                  w-fit">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2">
                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                            <polyline points="17 8 12 3 7 8"/>
                            <line x1="12" y1="3" x2="12" y2="15"/>
                        </svg>
                        Upload new photo
                        <input type="file" name="avatar"
                               accept="image/*"
                               class="hidden">
                    </label>
                    <p class="text-xs text-gray-600 mt-1.5">
                        JPG, PNG or GIF. Max 2MB.
                    </p>
                </div>

            </div>
            @error('avatar')
                <p class="text-red-400 text-xs">{{ $message }}</p>
            @enderror
        </div>
    </div>
</div>
