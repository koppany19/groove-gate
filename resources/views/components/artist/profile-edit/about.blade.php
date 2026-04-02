@props(['profile'])

<div class="bg-(--color-edit-background) border border-white/5 rounded-3xl p-8 shadow-xl">
    <h2 class="text-lg font-bold text-white mb-6 flex items-center gap-2">
        <div class="w-1 h-5 bg-blue-500 rounded-full"></div>
        About
    </h2>

    <div class="space-y-4">
        <div class="space-y-1.5">
            <label class="text-sm font-medium text-gray-300">Biography</label>
            <textarea name="bio" rows="4"
                      placeholder="Tell organisers about yourself..."
                      class="w-full px-4 py-3 rounded-xl text-white text-sm
                             outline-none transition-all placeholder-gray-600
                             bg-white/5 border border-white/10
                             focus:border-blue-500/50 resize-none">{{ old('bio', $profile->bio) }}</textarea>
            @error('bio')
                <p class="text-red-400 text-xs">{{ $message }}</p>
            @enderror
        </div>
    </div>
</div>
