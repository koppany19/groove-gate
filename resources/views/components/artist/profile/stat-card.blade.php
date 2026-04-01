@props([
    'label' => '',
    'value' => '0',
    'color' => 'blue',
])

@php
    $colors = [
        'blue'   => 'bg-blue-500/5',
        'purple' => 'bg-purple-500/5',
        'yellow' => 'bg-yellow-500/5',
    ];
@endphp

<div class="bg-[#121A27] border border-white/5 rounded-2xl p-6 shadow-xl
            relative overflow-hidden group">

    <div class="absolute top-0 right-0 w-24 h-24 rounded-bl-full
                transition-transform group-hover:scale-110
                {{ $colors[$color] ?? $colors['blue'] }}">
    </div>

    <p class="text-sm text-gray-400 font-medium mb-1">{{ $label }}</p>

    <div class="flex items-center gap-2">
        <p class="text-3xl font-black text-white">{{ $value }}</p>
        {{ $slot }}
    </div>

</div>
