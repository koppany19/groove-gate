@props(['event' => null])

<div class="bg-(--color-card) border border-white/5 rounded-3xl p-8 shadow-xl"
     x-data="{ isDynamic: {{ old('is_dynamic_price', $event?->is_dynamic_price ?? false) ? 'true' : 'false' }} }">

    <div class="flex items-center gap-3 mb-7">
        <div class="w-9 h-9 rounded-xl bg-orange-500/10 border border-orange-500/20 flex items-center justify-center shrink-0">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#f97316" stroke-width="2">
                <line x1="12" y1="1" x2="12" y2="23"/>
                <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/>
            </svg>
        </div>
        <div>
            <h2 class="text-base font-bold text-white">Event Details</h2>
            <p class="text-xs text-gray-500 mt-0.5">Capacity, pricing and sale settings</p>
        </div>
    </div>

    <div class="space-y-5">

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <x-auth.form.field
                label="Capacity"
                name="capacity"
                type="number"
                placeholder="e.g. 500"
                :value="old('capacity', $event?->capacity)"
                :error="$errors->first('capacity')"
            />

            <div class="space-y-1.5">
                <label class="text-sm font-medium text-gray-300">Seat Type</label>
                <label class="flex items-center gap-3 px-4 py-3 rounded-xl cursor-pointer transition-all
                              border border-white/10 hover:border-blue-500/30 bg-white/5 hover:bg-blue-500/5">
                    <input type="checkbox"
                           name="has_seats"
                           value="1"
                           class="accent-blue-500 w-4 h-4 shrink-0"
                        {{ old('has_seats', $event?->has_seats) ? 'checked' : '' }}>
                    <div>
                        <p class="text-white text-sm font-medium">Assigned Seats</p>
                        <p class="text-gray-500 text-xs">Enable numbered seat selection</p>
                    </div>
                </label>
                @error('has_seats')
                    <p class="text-red-400 text-xs">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <x-auth.form.field
            label="Base Price (€)"
            name="base_price"
            type="number"
            placeholder="0.00"
            :value="old('base_price', $event?->base_price)"
            :error="$errors->first('base_price')"
        />

        <div class="space-y-1.5">
            <label class="text-sm font-medium text-gray-300">Pricing Type</label>
            <div @click="isDynamic = !isDynamic"
                 class="flex items-center justify-between px-4 py-3.5 rounded-xl cursor-pointer
                        transition-all border hover:border-orange-500/40 bg-white/5"
                 :class="isDynamic ? 'border-orange-500/40 bg-orange-500/5' : 'border-white/10'">

                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg flex items-center justify-center transition-colors shrink-0"
                         :class="isDynamic ? 'bg-orange-500/15' : 'bg-white/5'">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2"
                             :class="isDynamic ? 'text-orange-400' : 'text-gray-500'">
                            <polyline points="22 7 13.5 15.5 8.5 10.5 2 17"/>
                            <polyline points="16 7 22 7 22 13"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-white text-sm font-medium">Dynamic Pricing</p>
                        <p class="text-gray-500 text-xs">Price adjusts based on demand</p>
                    </div>
                </div>

                <div class="relative shrink-0 pointer-events-none">
                    <div class="w-11 h-6 rounded-full transition-colors duration-200"
                         :class="isDynamic ? 'bg-orange-500' : 'bg-gray-700'">
                        <div class="w-4 h-4 bg-white rounded-full absolute top-1 transition-transform duration-200 shadow-sm"
                             :class="isDynamic ? 'translate-x-6' : 'translate-x-1'">
                        </div>
                    </div>
                </div>

            </div>

            <input type="hidden" name="is_dynamic_price" :value="isDynamic ? '1' : '0'">

            <div x-show="isDynamic"
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 -translate-y-2"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 class="px-4 py-3.5 rounded-xl bg-orange-500/5 border border-orange-500/20 space-y-1.5">
                <p class="text-xs text-orange-400 font-semibold flex items-center gap-1.5">
                    <x-icon name="info" size="11" />
                    Dynamic Price Formula
                </p>
                <p class="text-xs text-gray-400 font-mono leading-relaxed">
                    Price = BasePrice × (1 − 0.5 × 1/(DaysUntil+1)) × (1 + 0.5 × Occupancy)
                </p>
            </div>

            @error('is_dynamic_price')
                <p class="text-red-400 text-xs">{{ $message }}</p>
            @enderror
        </div>

        <div class="space-y-1.5">
            <label class="text-sm font-medium text-gray-300 flex items-center gap-2">
                Sale End Date
                <span class="text-gray-600 font-normal text-xs bg-white/5 px-2 py-0.5 rounded-full border border-white/5">
                    optional
                </span>
            </label>
            <input type="datetime-local"
                   name="sale_end_at"
                   value="{{ old('sale_end_at', $event?->sale_end_at?->format('Y-m-d\TH:i')) }}"
                   class="w-full px-4 py-3 rounded-xl text-white text-sm outline-none transition-all
                          bg-white/5 border border-white/10 focus:border-blue-500/50 focus:bg-white/[0.07]
                          [color-scheme:dark]">
            @error('sale_end_at')
                <p class="text-red-400 text-xs">{{ $message }}</p>
            @enderror
        </div>
    </div>
</div>
