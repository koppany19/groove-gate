@props(['route' => '', 'icon' => 'dashboard', 'label' => ''])

@php
    $active = request()->routeIs($route);
@endphp

<a href="{{ route($route) }}"
   class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium
          transition-all duration-150
          {{ $active ? '' : 'text-gray-400 hover:text-white hover:bg-white/5' }}"
   style="{{ $active
       ? 'background: rgba(59,130,246,0.12); color: #3b82f6;'
       : '' }}">

    <span class="flex-shrink-0">
        <x-icon :name="$icon" size="16" />
    </span>


    {{ $label }}

    {{ $slot }}

</a>
