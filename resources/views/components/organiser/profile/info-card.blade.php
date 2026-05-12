@props(['user', 'profile'])

<div class="bg-[#1A1D24] border border-white/5 rounded-3xl overflow-hidden shadow-xl
            hover:border-white/10 transition-all">
    <div class="px-6 pt-6 pb-4 border-b border-white/5">
        <div class="flex items-center gap-3">
            <div class="w-8 h-8 rounded-xl bg-white/5 border border-white/10
                        flex items-center justify-center">
                <x-icon name="user" size="14" class="text-gray-400" />
            </div>
            <div>
                <p class="text-white font-bold text-sm">Organiser Info</p>
                <p class="text-gray-500 text-xs">Contact and company details</p>
            </div>
        </div>
    </div>

    <div class="px-6 py-5 space-y-4">

        @if($profile->company_name)
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2.5 text-gray-400">
                    <div class="w-7 h-7 rounded-lg bg-white/5 border border-white/10
                                flex items-center justify-center">
                        <x-icon name="ticket" size="12" class="text-gray-400" />
                    </div>
                    <span class="text-sm">Company</span>
                </div>
                <span class="text-sm font-semibold text-white">{{ $profile->company_name }}</span>
            </div>
        @endif

        @if($profile->phone)
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2.5 text-gray-400">
                    <div class="w-7 h-7 rounded-lg bg-white/5 border border-white/10
                                flex items-center justify-center">
                        <x-icon name="phone" size="12" class="text-gray-400" />
                    </div>
                    <span class="text-sm">Phone</span>
                </div>
                <span class="text-sm font-semibold text-white">{{ $profile->phone }}</span>
            </div>
        @endif

        @if($profile->location)
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2.5 text-gray-400">
                    <div class="w-7 h-7 rounded-lg bg-white/5 border border-white/10
                                flex items-center justify-center">
                        <x-icon name="location" size="12" class="text-gray-400" />
                    </div>
                    <span class="text-sm">Location</span>
                </div>
                <span class="text-sm font-semibold text-white">{{ $profile->location }}</span>
            </div>
        @endif
    </div>
</div>
