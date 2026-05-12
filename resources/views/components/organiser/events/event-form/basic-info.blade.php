@props(['event' => null])

<div class="bg-(--color-card) border border-white/5 rounded-3xl p-8 shadow-xl">

    <div class="flex items-center gap-3 mb-7">
        <div class="w-9 h-9 rounded-xl bg-blue-500/10 border border-blue-500/20 flex items-center justify-center shrink-0">
            <x-icon name="edit" size="16" stroke="#3b82f6" />
        </div>
        <div>
            <h2 class="text-base font-bold text-white">Basic Information</h2>
            <p class="text-xs text-gray-500 mt-0.5">Name, location and schedule</p>
        </div>
    </div>

    <div class="space-y-5">

        <x-auth.form.field
            label="Event Name"
            name="name"
            placeholder="e.g. Summer Beats Festival 2026"
            :value="old('name', $event?->name)"
            :error="$errors->first('name')"
        />

        <x-auth.form.field
            label="Location"
            name="location"
            placeholder="e.g. Budapest, Hungary"
            :value="old('location', $event?->location)"
            :error="$errors->first('location')"
        />

        <div class="space-y-1.5">
            <label class="text-sm font-medium text-gray-300">Description</label>
            <textarea name="description" rows="4"
                      placeholder="Tell attendees what makes this event special..."
                      class="w-full px-4 py-3 rounded-xl text-white text-sm outline-none transition-all
                             placeholder-gray-600 bg-white/5 border border-white/10
                             focus:border-blue-500/50 focus:bg-white/[0.07] resize-none">{{ old('description', $event?->description) }}</textarea>
            @error('description')
                <p class="text-red-400 text-xs">{{ $message }}</p>
            @enderror
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div class="space-y-1.5">
                <label class="text-sm font-medium text-gray-300 flex items-center gap-1.5">
                    <x-icon name="clock" size="12" class="text-blue-400" />
                    Start Date & Time
                </label>
                <input type="datetime-local"
                       name="start_date"
                       value="{{ old('start_date', $event?->start_date?->format('Y-m-d\TH:i')) }}"
                       class="w-full px-4 py-3 rounded-xl text-white text-sm outline-none transition-all
                              bg-white/5 border border-white/10 focus:border-blue-500/50 focus:bg-white/[0.07]
                              [color-scheme:dark]">
                @error('start_date')
                    <p class="text-red-400 text-xs">{{ $message }}</p>
                @enderror
            </div>

            <div class="space-y-1.5">
                <label class="text-sm font-medium text-gray-300 flex items-center gap-1.5">
                    <x-icon name="clock" size="12" class="text-gray-500" />
                    End Date & Time
                    <span class="text-gray-600 font-normal text-xs ml-0.5">(optional)</span>
                </label>
                <input type="datetime-local"
                       name="end_date"
                       value="{{ old('end_date', $event?->end_date?->format('Y-m-d\TH:i')) }}"
                       class="w-full px-4 py-3 rounded-xl text-white text-sm outline-none transition-all
                              bg-white/5 border border-white/10 focus:border-blue-500/50 focus:bg-white/[0.07]
                              [color-scheme:dark]">
                @error('end_date')
                    <p class="text-red-400 text-xs">{{ $message }}</p>
                @enderror
            </div>
        </div>
    </div>
</div>
