<div>

    @if($success)
        <div class="flex items-center gap-3 px-4 py-3 mb-3 rounded-2xl bg-(--color-success)/10 border border-(--color-success)/20">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--color-success)" stroke-width="2">
                <polyline points="20 6 9 17 4 12"/>
            </svg>
            <p class="text-(--color-success) text-sm">Booking request submitted successfully!</p>
        </div>
    @endif

    <button wire:click="$set('open', true)"
            class="w-full py-3.5 rounded-2xl text-white font-bold text-sm bg-gradient-to-r from-(--color-primary-hover) to-(--color-artist)
                   hover:from-(--color-artist) hover:to-blue-400 shadow-lg shadow-(--color-artist)/20 active:scale-[0.98] transition-all flex items-center justify-center gap-2">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none"
             stroke="currentColor" stroke-width="2">
            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 13a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.6 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 9.91a16 16 0 0 0 6.29 6.29l1.46-1.46a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/>
        </svg>
        Send Booking Request
    </button>

    @if($open)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/80 backdrop-blur-sm"
             wire:click.self="$set('open', false)">

            <div class="bg-[#0d1424] border border-white/10 rounded-3xl w-full max-w-lg mx-4 shadow-2xl overflow-hidden">
                <div class="relative px-7 pt-7 pb-6 border-b border-white/5">
                    <div class="flex items-start justify-between">
                        <div class="flex items-center gap-4">
                            <div class="w-11 h-11 rounded-2xl bg-(--color-artist)/15 border border-(--color-artist)/20 flex items-center justify-center shrink-0">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--color-artist)" stroke-width="2">
                                    <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 13a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.6 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 9.91a16 16 0 0 0 6.29 6.29l1.46-1.46a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/>
                                </svg>
                            </div>
                            <div>
                                <h2 class="text-xl font-black text-white tracking-tight">Send Booking Request</h2>
                                <p class="text-xs text-(--color-muted) mt-0.5">Fill in the details below</p>
                            </div>
                        </div>
                        <button wire:click="$set('open', false)"
                                class="p-2 rounded-xl hover:bg-white/10 text-(--color-muted-2) hover:text-white transition-all">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <line x1="18" y1="6" x2="6" y2="18"/>
                                <line x1="6" y1="6" x2="18" y2="18"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="px-7 py-6 space-y-5">

                    @if($success)
                        <div class="flex items-center gap-3 px-4 py-3 rounded-2xl bg-(--color-success)/10 border border-(--color-success)/20">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--color-success)" stroke-width="2">
                                <polyline points="20 6 9 17 4 12"/>
                            </svg>
                            <p class="text-(--color-success) text-sm">Booking request submitted successfully!</p>
                        </div>
                    @endif

                    <div class="space-y-2">
                        <label class="flex items-center gap-2 text-xs font-semibold text-gray-400 uppercase tracking-wider">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect x="3" y="4" width="18" height="18" rx="2"/>
                                <line x1="3" y1="10" x2="21" y2="10"/>
                            </svg>
                            Event
                        </label>

                        @if($events->isEmpty())
                            <div class="flex items-center gap-3 px-4 py-3.5 rounded-2xl bg-(--color-organiser)/10 border border-(--color-organiser)/20">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--color-organiser)" stroke-width="2">
                                    <circle cx="12" cy="12" r="10"/>
                                    <line x1="12" y1="8" x2="12" y2="12"/>
                                    <line x1="12" y1="16" x2="12.01" y2="16"/>
                                </svg>
                                <div>
                                    <p class="text-orange-400 text-sm font-medium">No events yet</p>
                                    <a href="{{ route('organiser.events.create') }}"
                                       class="text-xs text-orange-400/70 hover:text-orange-400 underline transition-colors">
                                        Create your first event →
                                    </a>
                                </div>
                            </div>
                        @else
                            <select wire:model.live="selectedEventId"
                                    class="w-full px-4 py-3 rounded-2xl text-white text-sm bg-white/5 border border-white/10 outline-none focus:border-(--color-artist)/50 transition-all [color-scheme:dark]">
                                <option value="">Choose an event...</option>
                                @foreach($events as $event)
                                    <option value="{{ $event->id }}">
                                        {{ $event->name }} — {{ $event->start_date->format('M d, Y') }}
                                    </option>
                                @endforeach
                            </select>
                            @error('selectedEventId')
                            <p class="text-red-400 text-xs flex items-center gap-1.5">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="12" cy="12" r="10"/>
                                    <line x1="12" y1="8" x2="12" y2="12"/>
                                    <line x1="12" y1="16" x2="12.01" y2="16"/>
                                </svg>
                                {{ $message }}
                            </p>
                            @enderror
                        @endif
                    </div>

                    @if($selectedEventId)
                        <div class="space-y-2">
                            <label class="flex items-center gap-2 text-xs font-semibold text-gray-400 uppercase tracking-wider">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="12" cy="12" r="10"/>
                                    <polyline points="12 6 12 12 16 14"/>
                                </svg>
                                Performance Date
                            </label>

                            @if(empty($availableDates))
                                <div class="flex items-center gap-3 px-4 py-3.5 rounded-2xl bg-(--color-danger)/10 border border-(--color-danger)/20">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--color-danger)" stroke-width="2">
                                        <circle cx="12" cy="12" r="10"/>
                                        <line x1="15" y1="9" x2="9" y2="15"/>
                                        <line x1="9" y1="9" x2="15" y2="15"/>
                                    </svg>
                                    <p class="text-red-400 text-sm">No available dates for this artist</p>
                                </div>
                            @else
                                <select wire:model="performanceDate"
                                        class="w-full px-4 py-3 rounded-2xl text-white text-sm bg-white/5 border border-white/10 outline-none focus:border-(--color-artist)/50 transition-all [color-scheme:dark]">
                                    <option value="">Choose a date...</option>
                                    @foreach($availableDates as $date)
                                        <option value="{{ $date }}">
                                            {{ \Carbon\Carbon::parse($date)->format('l, M d Y') }}
                                        </option>
                                    @endforeach
                                </select>
                            @endif
                            @error('performanceDate')
                            <p class="text-red-400 text-xs">{{ $message }}</p>
                            @enderror
                        </div>
                    @endif

                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-2">
                            <label class="flex items-center gap-2 text-xs font-semibold text-gray-400 uppercase tracking-wider">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <line x1="12" y1="1" x2="12" y2="23"/>
                                    <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/>
                                </svg>
                                Offered Fee
                                <span class="text-(--color-muted-2) normal-case font-normal">(optional)</span>
                            </label>
                            <div class="relative">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-(--color-muted) text-sm font-bold">€</span>
                                <input type="number"
                                       wire:model="fee"
                                       placeholder="0.00"
                                       min="0"
                                       step="0.01"
                                       class="w-full pl-8 pr-4 py-3 rounded-2xl text-white text-sm bg-white/5 border border-white/10 outline-none focus:border-(--color-artist)/50 transition-all placeholder-gray-600">
                            </div>
                            @error('fee')
                            <p class="text-red-400 text-xs">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2">
                            <label class="flex items-center gap-2 text-xs font-semibold text-gray-400 uppercase tracking-wider">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="12" cy="12" r="10"/>
                                    <polyline points="12 6 12 12 16 14"/>
                                </svg>
                                Duration
                                <span class="text-(--color-muted-2) normal-case font-normal">(min)</span>
                            </label>
                            <input type="number"
                                   wire:model="duration"
                                   placeholder="90"
                                   min="0"
                                   class="w-full px-4 py-3 rounded-2xl text-white text-sm bg-white/5 border border-white/10 outline-none focus:border-(--color-artist)/50 transition-all placeholder-gray-600">
                            @error('duration')
                            <p class="text-red-400 text-xs">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="flex items-center gap-2 text-xs font-semibold text-gray-400 uppercase tracking-wider">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
                            </svg>
                            Message
                            <span class="text-(--color-muted-2) normal-case font-normal">(optional)</span>
                        </label>
                        <textarea wire:model="message"
                                  rows="3"
                                  placeholder="Introduce your event and why you'd like to book this artist..."
                                  class="w-full px-4 py-3 rounded-2xl text-white text-sm bg-white/5 border border-white/10 outline-none focus:border-(--color-artist)/50 transition-all placeholder-gray-600 resize-none"></textarea>
                        @error('message')
                        <p class="text-red-400 text-xs">{{ $message }}</p>
                        @enderror
                    </div>

                </div>

                <div class="px-7 pb-7 flex items-center gap-3">
                    <button wire:click="submit"
                            @disabled($events->isEmpty())
                            class="flex-1 py-3.5 rounded-2xl text-white font-bold text-sm bg-gradient-to-r from-(--color-primary-hover) to-(--color-artist)
                                   hover:from-(--color-artist) hover:to-blue-400 shadow-lg shadow-(--color-artist)/20 active:scale-[0.98] transition-all disabled:opacity-40 disabled:cursor-not-allowed flex items-center justify-center gap-2">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="22" y1="2" x2="11" y2="13"/>
                            <polygon points="22 2 15 22 11 13 2 9 22 2"/>
                        </svg>
                        Send Request
                    </button>
                    <button wire:click="$set('open', false)"
                            class="flex-1 py-3.5 rounded-2xl text-gray-400 font-medium text-sm border border-white/10 hover:border-white/20 hover:text-white transition-all">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>
