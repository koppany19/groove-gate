@props(['profile'])

<div class="bg-[#121A27] border border-white/5 rounded-3xl p-6 shadow-2xl">

    <div class="flex items-center justify-between mb-6">
        <h2 class="text-lg font-bold text-white">Availability</h2>
        <span class="text-xs text-gray-500">Click to mark unavailable</span>
    </div>

    <div class="bg-[#0B101A] rounded-2xl p-4 border border-white/5">
        <livewire:artist-availability-calendar />
    </div>

    <div class="flex items-center gap-4 mt-4">
        <div class="flex items-center gap-2 text-xs text-gray-500">
            <div class="w-3 h-3 rounded-full bg-red-500/30"></div>
            Unavailable
        </div>
        <div class="flex items-center gap-2 text-xs text-gray-500">
            <div class="w-3 h-3 rounded-full border border-blue-500/50"></div>
            Today
        </div>
    </div>

</div>
