@props(['profile'])

<div class="bg-(--color-edit-background) border border-white/5 rounded-3xl p-8 shadow-xl">
    <h2 class="text-lg font-bold text-white mb-6 flex items-center gap-2">
        <div class="w-1 h-5 bg-blue-500 rounded-full"></div>
        Artist Type
    </h2>

    <div class="grid grid-cols-2 gap-4">
        <label class="flex items-center gap-3 px-5 py-4 rounded-2xl cursor-pointer
                      transition-all border
                      {{ old('artist_type', $profile->artist_type?->value) === 'live'
                          ? 'border-blue-500 bg-blue-500/10'
                          : 'border-white/10 hover:border-white/20' }}">
            <input type="radio" name="artist_type" value="live"
                   class="accent-blue-500"
                {{ old('artist_type', $profile->artist_type?->value) === 'live' ? 'checked' : '' }}>
            <div>
                <p class="text-white font-semibold text-sm">Live</p>
                <p class="text-gray-500 text-xs">Band or solo live performance</p>
            </div>
        </label>

        <label class="flex items-center gap-3 px-5 py-4 rounded-2xl cursor-pointer
                      transition-all border
                      {{ old('artist_type', $profile->artist_type?->value) === 'dj'
                          ? 'border-blue-500 bg-blue-500/10'
                          : 'border-white/10 hover:border-white/20' }}">
            <input type="radio" name="artist_type" value="dj"
                   class="accent-blue-500"
                {{ old('artist_type', $profile->artist_type?->value) === 'dj' ? 'checked' : '' }}>
            <div>
                <p class="text-white font-semibold text-sm">DJ</p>
                <p class="text-gray-500 text-xs">DJ set performance</p>
            </div>
        </label>
    </div>

    @error('artist_type')
        <p class="text-red-400 text-xs mt-2">{{ $message }}</p>
    @enderror
</div>
