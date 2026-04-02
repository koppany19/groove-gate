@props(['profile'])

<div class="bg-(--color-edit-background) border border-white/5 rounded-3xl p-6 shadow-xl">
    <h2 class="text-lg font-bold text-white mb-5 flex items-center gap-2">
        <div class="w-1 h-5 bg-blue-500 rounded-full"></div>
        Social Links
    </h2>

    <div class="space-y-4">

        <div class="space-y-1.5">
            <label class="text-sm font-medium text-green-400 flex items-center gap-2">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M12 0C5.4 0 0 5.4 0 12s5.4 12 12 12 12-5.4 12-12S18.66 0 12 0zm5.521 17.34c-.24.359-.66.48-1.021.24-2.82-1.74-6.36-2.101-10.561-1.141-.418.122-.779-.179-.899-.539-.12-.421.18-.78.54-.9 4.56-1.021 8.52-.6 11.64 1.32.42.18.479.659.301 1.02zm1.44-3.3c-.301.42-.841.6-1.262.3-3.239-1.98-8.159-2.58-11.939-1.38-.479.12-1.02-.12-1.14-.6-.12-.48.12-1.021.6-1.141C9.6 9.9 15 10.561 18.72 12.84c.361.181.54.78.241 1.2zm.12-3.36C15.24 8.4 8.82 8.16 5.16 9.301c-.6.179-1.2-.181-1.38-.721-.18-.601.18-1.2.72-1.381 4.26-1.26 11.28-1.02 15.721 1.621.539.3.719 1.02.419 1.56-.299.421-1.02.599-1.559.3z"/>
                </svg>
                Spotify
            </label>
            <input type="url" name="spotify_url"
                   value="{{ old('spotify_url', $profile->spotify_url) }}"
                   placeholder="https://open.spotify.com/artist/..."
                   class="w-full px-4 py-3 rounded-xl text-white text-sm outline-none
                          transition-all placeholder-gray-600 bg-white/5 border border-white/10
                          focus:border-green-500/50">
            @error('spotify_url')
                <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="space-y-1.5">
            <label class="text-sm font-medium text-orange-400 flex items-center gap-2">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M11.56 8.87V17h8.76c.96-.19 1.68-.96 1.68-1.96 0-1.08-.84-1.96-1.96-1.96-.2 0-.36.04-.56.08C19.32 11.6 17.64 10 15.6 10c-.36 0-.72.08-1.04.2-.48-1.56-1.92-2.72-3.64-2.72-.52 0-1 .12-1.44.36.32.28.57.6.76.96.24-.12.48-.2.76-.2 1.16 0 2.04.88 2.04 2.04V8.87zM0 15.56c0 .84.68 1.52 1.52 1.52s1.52-.68 1.52-1.52v-4.4c0-.84-.68-1.52-1.52-1.52S0 10.32 0 11.16v4.4zm4.36 1.04c0 .84.68 1.52 1.52 1.52s1.52-.68 1.52-1.52V9.4c0-.84-.68-1.52-1.52-1.52S4.36 8.56 4.36 9.4v7.2zm4.44.48c0 .84.68 1.52 1.52 1.52s1.52-.68 1.52-1.52V8.88c0-.84-.68-1.52-1.52-1.52S8.8 8.04 8.8 8.88v8.2z"/>
                </svg>
                SoundCloud
            </label>
            <input type="url" name="soundcloud_url"
                   value="{{ old('soundcloud_url', $profile->soundcloud_url) }}"
                   placeholder="https://soundcloud.com/..."
                   class="w-full px-4 py-3 rounded-xl text-white text-sm outline-none
                          transition-all placeholder-gray-600 bg-white/5 border border-white/10
                          focus:border-orange-500/50">
            @error('soundcloud_url')
                <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="space-y-1.5">
            <label class="text-sm font-medium text-red-400 flex items-center gap-2">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                </svg>
                YouTube
            </label>
            <input type="url" name="youtube_url"
                   value="{{ old('youtube_url', $profile->youtube_url) }}"
                   placeholder="https://youtube.com/@..."
                   class="w-full px-4 py-3 rounded-xl text-white text-sm outline-none
                          transition-all placeholder-gray-600 bg-white/5 border border-white/10
                          focus:border-red-500/50">
            @error('youtube_url')
                <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="space-y-1.5">
            <label class="text-sm font-medium text-pink-400 flex items-center gap-2">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 1 0 0 12.324 6.162 6.162 0 0 0 0-12.324zM12 16a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm6.406-11.845a1.44 1.44 0 1 0 0 2.881 1.44 1.44 0 0 0 0-2.881z"/>
                </svg>
                Instagram
            </label>
            <input type="url" name="instagram_url"
                   value="{{ old('instagram_url', $profile->instagram_url) }}"
                   placeholder="https://instagram.com/..."
                   class="w-full px-4 py-3 rounded-xl text-white text-sm outline-none
                          transition-all placeholder-gray-600 bg-white/5 border border-white/10
                          focus:border-pink-500/50">
            @error('instagram_url')
                <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
    </div>
</div>
