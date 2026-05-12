@props([
    'profile' => null,
])

<div class="bg-[#121A27] border border-blue-500/30 rounded-3xl p-8 shadow-lg sticky top-8 z-10">

    <div class="text-center mb-8">
        <p class="text-sm font-bold text-blue-400 uppercase tracking-widest mb-2">
            Booking Fee
        </p>
        <h3 class="text-4xl font-black text-white">
            @if($profile->price_min && $profile->price_max)
                €{{ number_format($profile->price_min) }}
                <span class="text-xl text-gray-400 font-medium">
                    – €{{ number_format($profile->price_max) }}
                </span>
            @else
                <span class="text-2xl text-gray-500">Not set</span>
            @endif
        </h3>
        @if($profile->duration)
            <p class="text-sm text-gray-400 mt-2 flex items-center justify-center gap-2">
                <x-icon name="clock" size="14" />
                {{ $profile->duration }} min set
            </p>
        @endif
    </div>

</div>
