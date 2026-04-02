@props(['profile'])

<div class="bg-(--color-edit-background) border border-blue-500/30 rounded-3xl p-6 shadow-xl sticky top-6">

    <div class="flex items-center gap-3 mb-5">
        <div class="w-8 h-8 rounded-full bg-blue-500/10 flex items-center justify-center">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none"
                 stroke="#3b82f6" stroke-width="2">
                <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/>
                <polyline points="17 21 17 13 7 13 7 21"/>
                <polyline points="7 3 7 8 15 8"/>
            </svg>
        </div>
        <div>
            <p class="text-white font-semibold text-sm">Save Changes</p>
            <p class="text-gray-500 text-xs">All changes will be saved</p>
        </div>
    </div>

    <button type="submit"
            class="w-full py-3.5 rounded-2xl text-white font-bold text-sm
                   bg-blue-500 hover:opacity-90 transition-all
                   flex items-center justify-center gap-2 mb-3">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none"
             stroke="currentColor" stroke-width="2">
            <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/>
            <polyline points="17 21 17 13 7 13 7 21"/>
            <polyline points="7 3 7 8 15 8"/>
        </svg>
        Save Changes
    </button>

    <a href="{{ route('artist.profile.show') }}"
       class="w-full py-3 rounded-2xl text-gray-400 font-medium text-sm
              border border-white/10 hover:border-white/20 hover:text-white
              transition-all flex items-center justify-center">
        Cancel
    </a>

</div>
