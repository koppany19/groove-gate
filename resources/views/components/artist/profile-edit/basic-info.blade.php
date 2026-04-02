@props(['profile'])

<div class="bg-(--color-edit-background) border border-white/5 rounded-3xl p-8 shadow-xl">
    <h2 class="text-lg font-bold text-white mb-6 flex items-center gap-2">
        <div class="w-1 h-5 bg-blue-500 rounded-full"></div>
        Basic Information
    </h2>

    <div class="grid grid-cols-2 gap-4">
        <x-auth.form.field
            label="Stage Name"
            name="stage_name"
            placeholder="Your stage name"
            :value="$profile->stage_name"
            :error="$errors->first('stage_name')"
        />
        <x-auth.form.field
            label="Location"
            name="location"
            placeholder="City, Country"
            :value="$profile->location"
            :error="$errors->first('location')"
        />
    </div>
</div>
