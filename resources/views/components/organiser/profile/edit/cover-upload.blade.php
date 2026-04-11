@props(['user', 'profile'])

@php
    $coverUrl = $profile->cover_image
        ? (str_starts_with($profile->cover_image, 'http') ? $profile->cover_image : Storage::url($profile->cover_image))
        : null;
@endphp

<div class="bg-(--color-card) border border-white/5 rounded-3xl p-6 shadow-xl"
     x-data="{
         preview: @js($coverUrl),
         isDragging: false,
         handleFile(e) {
             const file = e.target.files?.[0] ?? e.dataTransfer?.files?.[0];
             if (file && file.type.startsWith('image/')) {
                 const reader = new FileReader();
                 reader.onload = ev => this.preview = ev.target.result;
                 reader.readAsDataURL(file);
             }
         }
     }">

    <div class="flex items-center gap-3 mb-5">
        <div class="w-9 h-9 rounded-xl bg-purple-500/10 border border-purple-500/20 flex items-center justify-center shrink-0">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#a855f7" stroke-width="2">
                <rect x="3" y="3" width="18" height="18" rx="2"/>
                <circle cx="8.5" cy="8.5" r="1.5"/>
                <polyline points="21 15 16 10 5 21"/>
            </svg>
        </div>
        <div>
            <h2 class="text-base font-bold text-white">Images</h2>
            <p class="text-xs text-gray-500 mt-0.5">Profile photo and cover image</p>
        </div>
    </div>

    <div class="space-y-5">

        {{-- Cover image --}}
        <div class="space-y-2">
            <label class="text-sm font-medium text-gray-300">Cover Image</label>
            <div class="relative rounded-2xl overflow-hidden border-2 border-dashed transition-all duration-200 cursor-pointer"
                 :class="isDragging ? 'border-purple-500/60 bg-purple-500/5' : 'border-white/10 bg-white/5 hover:border-white/25'"
                 @dragover.prevent="isDragging = true"
                 @dragleave.prevent="isDragging = false"
                 @drop.prevent="isDragging = false; $refs.coverInput.files = $event.dataTransfer.files; handleFile($event)">

                <template x-if="preview">
                    <div class="relative w-full h-36">
                        <img :src="preview" class="w-full h-36 object-cover">
                        <div class="absolute inset-0 bg-black/50 opacity-0 hover:opacity-100 transition-all flex items-center justify-center">
                            <span class="text-white text-xs font-semibold bg-white/10 backdrop-blur-sm border border-white/20 rounded-xl px-4 py-2">
                                Change Cover
                            </span>
                        </div>
                    </div>
                </template>

                <template x-if="!preview">
                    <div class="flex flex-col items-center justify-center py-8">
                        <div class="w-10 h-10 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center mb-2">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="text-gray-500">
                                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                                <polyline points="17 8 12 3 7 8"/>
                                <line x1="12" y1="3" x2="12" y2="15"/>
                            </svg>
                        </div>
                        <p class="text-sm text-gray-400" x-text="isDragging ? 'Drop to upload' : 'Drop image here'"></p>
                        <p class="text-xs text-gray-600 mt-0.5">or click to browse</p>
                    </div>
                </template>

                <input type="file" name="cover_image" accept="image/*"
                       x-ref="coverInput" @change="handleFile($event)"
                       class="absolute inset-0 opacity-0 cursor-pointer">
            </div>
            <p class="text-xs text-gray-600">Recommended 1920×400px · Max 10MB</p>
            @error('cover_image')
            <p class="text-red-400 text-xs">{{ $message }}</p>
            @enderror
        </div>

        {{-- Avatar --}}
        <div class="space-y-2">
            <label class="text-sm font-medium text-gray-300">Profile Photo</label>
            <div class="flex items-center gap-4">
                <div class="w-14 h-14 rounded-xl overflow-hidden border-2 border-white/10 bg-white/5 flex items-center justify-center shrink-0">
                    @if($user->avatar)
                        <img src="{{ str_starts_with($user->avatar, 'http') ? $user->avatar : Storage::url($user->avatar) }}"
                             alt="{{ $user->name }}" class="w-full h-full object-cover">
                    @else
                        <span class="text-xl font-black text-orange-400">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </span>
                    @endif
                </div>
                <div>
                    <label class="flex items-center gap-2 px-4 py-2.5 rounded-xl border border-white/10
                                  bg-white/5 hover:bg-white/10 text-sm text-gray-300 cursor-pointer transition-all w-fit">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                            <polyline points="17 8 12 3 7 8"/>
                            <line x1="12" y1="3" x2="12" y2="15"/>
                        </svg>
                        Upload new photo
                        <input type="file" name="avatar" accept="image/*" class="hidden">
                    </label>
                    <p class="text-xs text-gray-600 mt-1.5">JPG, PNG or GIF · Max 10MB</p>
                </div>
            </div>
            @error('avatar')
                <p class="text-red-400 text-xs">{{ $message }}</p>
            @enderror
        </div>

    </div>
</div>
