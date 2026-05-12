@props(['label' => 'Save Changes'])

<div class="bg-(--color-card) border border-orange-500/20 rounded-3xl p-6 shadow-xl sticky top-6">

    <div class="flex items-center gap-3 mb-5">
        <div class="w-8 h-8 rounded-xl bg-orange-500/10 border border-orange-500/20 flex items-center justify-center shrink-0">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#f97316" stroke-width="2">
                <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/>
                <polyline points="17 21 17 13 7 13 7 21"/>
                <polyline points="7 3 7 8 15 8"/>
            </svg>
        </div>
        <div>
            <p class="text-white font-semibold text-sm">{{ $label }}</p>
            <p class="text-gray-500 text-xs">All changes will be saved</p>
        </div>
    </div>

    <button type="submit"
            class="w-full py-3.5 rounded-2xl text-white font-bold text-sm mb-3
                   bg-gradient-to-r from-orange-600 to-orange-500
                   hover:from-orange-500 hover:to-orange-400
                   active:scale-[0.98] transition-all
                   shadow-lg shadow-orange-500/20
                   flex items-center justify-center gap-2">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/>
            <polyline points="17 21 17 13 7 13 7 21"/>
            <polyline points="7 3 7 8 15 8"/>
        </svg>
        {{ $label }}
    </button>

    <a href="{{ route('organiser.profile') }}"
       class="w-full py-3 rounded-2xl text-gray-400 font-medium text-sm
              border border-white/10 hover:border-white/20 hover:text-white
              transition-all flex items-center justify-center gap-2">
        <x-icon name="x" size="14" />
        Cancel
    </a>

</div>
