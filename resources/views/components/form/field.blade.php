@props(['label', 'name', 'type' => 'text'])

<div class="space-y-1.5">
    <label for="{{ $name }}"
           class="block text-sm font-medium text-gray-300">
        {{ $label }}
    </label>

    <div class="relative">
        <input
            type="{{ $type }}"
            id="{{ $name }}"
            name="{{ $name }}"
            value="{{ old($name) }}"
            class="w-full bg-white/5 border rounded-lg px-4 py-2.5 text-sm text-white
                   placeholder-gray-600 outline-none transition-all duration-150
                   focus:ring-2 focus:ring-white/20 focus:border-white/40
                   @error($name) border-red-500/60 focus:ring-red-500/20 @else border-gray-700/60 @enderror"
            {{ $attributes }}
        >
    </div>

    @error($name)
    <p class="flex items-center gap-1.5 text-red-400 text-xs mt-1">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 shrink-0" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
        </svg>
        {{ $message }}
    </p>
    @enderror
</div>
