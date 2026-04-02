@props(['profile'])

<div class="bg-(--color-edit-background) border border-white/5 rounded-3xl p-6 shadow-xl">
    <h2 class="text-lg font-bold text-white mb-5 flex items-center gap-2">
        <div class="w-1 h-5 bg-blue-500 rounded-full"></div>
        Pricing
    </h2>

    <div class="space-y-4">
        <x-auth.form.field
            label="Min Price (€)"
            name="price_min"
            type="number"
            placeholder="0"
            :value="old('price_min', $profile->price_min)"
            :error="$errors->first('price_min')"
        />
        <x-auth.form.field
            label="Max Price (€)"
            name="price_max"
            type="number"
            placeholder="0"
            :value="old('price_max', $profile->price_max)"
            :error="$errors->first('price_max')"
        />
        <x-auth.form.field
            label="Set Duration (min)"
            name="duration"
            type="number"
            placeholder="90"
            :value="old('duration', $profile->duration)"
            :error="$errors->first('duration')"
        />
    </div>
</div>
