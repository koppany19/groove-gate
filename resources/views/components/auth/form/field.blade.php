@props(['name', 'type' => 'text', 'label' => null, 'placeholder' => '', 'error' => false, 'value' => ''])

<div class="space-y-2 group">
    @if($label)
        <label for="{{ $name }}" class="text-xs font-bold text-gray-400 uppercase tracking-widest group-focus-within:text-white transition-colors duration-200">
            {{ $label }}
        </label>
    @endif

    <div class="relative">
        <input
            id="{{ $name }}"
            type="{{ $type }}"
            name="{{ $name }}"
            value="{{ $type !== 'password' ? old($name, $value) : '' }}"
            placeholder="{{ $placeholder }}"
            class="w-full px-5 py-3.5 rounded-xl text-white text-sm outline-none transition-all duration-300 ease-out placeholder-gray-600
                   shadow-inner shadow-black/10 focus:-translate-y-0.5
                   {{ $error ? 'ring-2 ring-red-500/50' : 'focus:ring-2 focus:ring-blue-500/50' }}"
            style="background: rgba(0,0,0,0.2);
                   border: 1px solid {{ $error ? 'rgba(239,68,68,0.3)' : 'var(--color-border)' }};
                   backdrop-filter: blur(4px);">

        <div class="absolute inset-0 rounded-xl pointer-events-none transition-opacity duration-300 opacity-0 group-focus-within:opacity-100"
             style="background: radial-gradient(100px circle at top left, rgba(59,130,246,0.1), transparent 70%);"></div>
    </div>

    @if($error)
        <p class="text-red-400 text-xs flex items-center gap-1.5 mt-2 font-medium">
            <x-icon name="info" size="14" />
            {{ $error }}
        </p>
    @endif
</div>
