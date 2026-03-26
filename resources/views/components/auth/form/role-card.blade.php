@props(['value','label', 'active' => false])

<label
    @click="role = '{{ $value }}'"
    :class="role === '{{ $value }}' ? 'border-blue-500 bg-blue-500/10 text-white' : 'border-(--color-border) text-gray-400 hover:border-gray-500'"
    class="flex flex-col items-center justify-center gap-2 p-4 rounded-xl border cursor-pointer transition-all duration-200 relative"
    >

    <input type="radio" name="role" value="{{ $value }}" class="hidden">

    <div class="w-8 h-8 flex items-center justify-center">
        {{ $slot }}
    </div>

    <span class="text-sm font-medium">{{ $label }}</span>

    <div :class="role === '{{ $value }}' ? 'border-blue-500 bg-blue-500' : 'border-gray-600'"
         class="absolute top-2 right-2 w-4 h-4 rounded-full border-2 flex items-center justify-center transition-all"
    >
        <div x-show="role === '{{ $value }}'" class="w-1.5 h-1.5 rounded-full bg-white">
        </div>
    </div>
</label>
