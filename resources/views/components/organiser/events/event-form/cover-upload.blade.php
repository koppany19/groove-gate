@props(['event' => null])

@php
    $coverUrl = $event?->cover_image
        ? (str_starts_with($event->cover_image, 'http')
            ? $event->cover_image
            : Storage::url($event->cover_image))
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
            <h2 class="text-base font-bold text-white">Cover Image</h2>
            <p class="text-xs text-gray-500 mt-0.5">Recommended 1920×400px</p>
        </div>
    </div>

    <div class="space-y-3">

        <div class="relative rounded-2xl overflow-hidden border-2 border-dashed transition-all duration-200 cursor-pointer"
             :class="isDragging
                 ? 'border-purple-500/60 bg-purple-500/5 scale-[1.01]'
                 : 'border-white/10 bg-white/5 hover:border-white/25 hover:bg-white/[0.07]'"
             @dragover.prevent="isDragging = true"
             @dragleave.prevent="isDragging = false"
             @drop.prevent="isDragging = false; $refs.fileInput.files = $event.dataTransfer.files; handleFile($event)">

            <template x-if="preview">
                <div class="relative w-full h-44">
                    <img :src="preview" alt="Cover preview"
                         class="w-full h-44 object-cover">
                    <div class="absolute inset-0 bg-black/50 opacity-0 hover:opacity-100 transition-all
                                flex items-center justify-center">
                        <div class="bg-white/10 backdrop-blur-sm border border-white/20 rounded-xl
                                    px-4 py-2 text-sm font-semibold text-white flex items-center gap-2">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                                <polyline points="17 8 12 3 7 8"/>
                                <line x1="12" y1="3" x2="12" y2="15"/>
                            </svg>
                            Change Image
                        </div>
                    </div>
                </div>
            </template>

            <template x-if="!preview">
                <div class="flex flex-col items-center justify-center py-10 px-4">
                    <div class="w-12 h-12 rounded-2xl bg-white/5 border border-white/10
                                flex items-center justify-center mb-3 transition-transform"
                         :class="isDragging ? 'scale-110' : ''">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="1.5" class="text-gray-500">
                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                            <polyline points="17 8 12 3 7 8"/>
                            <line x1="12" y1="3" x2="12" y2="15"/>
                        </svg>
                    </div>
                    <p class="text-sm font-medium text-gray-400" x-text="isDragging ? 'Drop to upload' : 'Drop image here'"></p>
                    <p class="text-xs text-gray-600 mt-1">or click to browse</p>
                </div>
            </template>

            <input type="file"
                   name="cover_image"
                   accept="image/*"
                   x-ref="fileInput"
                   @change="handleFile($event)"
                   class="absolute inset-0 opacity-0 cursor-pointer">
        </div>

        <p class="text-xs text-gray-600">JPG, PNG or WebP &middot; Max 10MB &middot; 16:9 ratio recommended</p>

        @error('cover_image')
            <p class="text-red-400 text-xs">{{ $message }}</p>
        @enderror
    </div>
</div>
