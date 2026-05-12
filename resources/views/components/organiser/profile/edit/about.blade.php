@props(['profile'])

<div class="bg-(--color-card) border border-white/5 rounded-3xl p-8 shadow-xl">
    <div class="flex items-center gap-3 mb-7">
        <div class="w-9 h-9 rounded-xl bg-blue-500/10 border border-blue-500/20 flex items-center justify-center shrink-0">
            <x-icon name="file" size="16" stroke="#3b82f6" />
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
