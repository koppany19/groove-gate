@props(['profile'])

<div class="bg-(--color-card) border border-white/5 rounded-3xl p-8 shadow-xl">
    <div class="flex items-center gap-3 mb-7">
        <div class="w-9 h-9 rounded-xl bg-blue-500/10 border border-blue-500/20 flex items-center justify-center shrink-0">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#3b82f6" stroke-width="2">
                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                <polyline points="14 2 14 8 20 8"/>
                <line x1="16" y1="13" x2="8" y2="13"/>
                <line x1="16" y1="17" x2="8" y2="17"/>
            </svg>
        </div>
        <div>
            <h2 class="text-base font-bold text-white">About</h2>
            <p class="text-xs text-gray-500 mt-0.5">Tell artists about your company</p>
        </div>
    </div>

    <div class="space-y-1.5">
        <label class="text-sm font-medium text-gray-300">Description</label>
        <textarea name="description" rows="5"
                  placeholder="Tell artists what kind of events you organise, your experience and what you're looking for..."
                  class="w-full px-4 py-3 rounded-xl text-white text-sm outline-none transition-all
                         placeholder-gray-600 bg-white/5 border border-white/10
                         focus:border-blue-500/50 focus:bg-white/[0.07] resize-none">{{ old('description', $profile->description) }}</textarea>
        @error('description')
        <p class="text-red-400 text-xs">{{ $message }}</p>
        @enderror
    </div>
</div>
