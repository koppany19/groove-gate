@props(['status'])

@php
    $styles = match($status) {
        \App\EventStatus::PUBLISHED => 'bg-emerald-500/10 text-emerald-400 border-emerald-500/20',
        \App\EventStatus::CANCELLED => 'bg-red-500/10 text-red-400 border-red-500/20',
        \App\EventStatus::DRAFT     => 'bg-gray-500/10 text-gray-400 border-gray-500/20',
    };
@endphp

<span class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider border {{ $styles }}">
    {{ $status->label() }}
</span>
