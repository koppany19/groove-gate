@props(['user', 'profile'])

<div class="bg-(--color-card) border border-white/5 rounded-3xl overflow-hidden shadow-xl">
    <div class="px-6 pt-6 pb-4 border-b border-white/5">
        <div class="flex items-center gap-3">
            <div class="w-9 h-9 rounded-xl bg-orange-500/10 border border-orange-500/20 flex items-center justify-center">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#f97316" stroke-width="2">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                    <circle cx="12" cy="7" r="4"/>
                </svg>
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
                    <div class="w-7 h-7 rounded-lg bg-orange-500/10 flex items-center justify-center">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#f97316" stroke-width="2">
                            <path d="M20 7H4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z"/>
                            <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/>
                        </svg>
                    </div>
                    <span class="text-sm">Company</span>
                </div>
                <span class="text-sm font-semibold text-white">{{ $profile->company_name }}</span>
            </div>
        @endif

        @if($profile->phone)
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2.5 text-gray-400">
                    <div class="w-7 h-7 rounded-lg bg-emerald-500/10 flex items-center justify-center">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#10b981" stroke-width="2">
                            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 13a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.6 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 9.91a16 16 0 0 0 6.29 6.29l1.46-1.46a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/>
                        </svg>
                    </div>
                    <span class="text-sm">Phone</span>
                </div>
                <span class="text-sm font-semibold text-white">{{ $profile->phone }}</span>
            </div>
        @endif

        @if($profile->location)
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2.5 text-gray-400">
                    <div class="w-7 h-7 rounded-lg bg-purple-500/10 flex items-center justify-center">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#a855f7" stroke-width="2">
                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                            <circle cx="12" cy="10" r="3"/>
                        </svg>
                    </div>
                    <span class="text-sm">Location</span>
                </div>
                <span class="text-sm font-semibold text-white">{{ $profile->location }}</span>
            </div>
        @endif
    </div>
</div>
