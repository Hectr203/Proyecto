@props(['model', 'existingImage' => null])

<div x-data="{
        isDragging: false,
        isUploading: false,
        previewUrl: null,
        handleFileDrop(e) {
            this.isDragging = false;
            if (e.dataTransfer.files.length > 0) {
                this.uploadFile(e.dataTransfer.files[0]);
            }
        },
        handlePaste(e) {
            const items = (e.clipboardData || e.originalEvent.clipboardData).items;
            for (let index in items) {
                const item = items[index];
                if (item.kind === 'file' && item.type.startsWith('image/')) {
                    const blob = item.getAsFile();
                    this.uploadFile(blob);
                    break;
                }
            }
        },
        uploadFile(file) {
            this.isUploading = true;
            // Preview
            const reader = new FileReader();
            reader.onload = (e) => {
                this.previewUrl = e.target.result;
            };
            reader.readAsDataURL(file);
            
            // Upload to Livewire
            @this.upload('{{ $model }}', file, (uploadedFilename) => {
                this.isUploading = false;
            }, () => {
                this.isUploading = false;
                this.previewUrl = null;
            }, (event) => {
                // progress
            });
        }
    }" 
    @paste.window="handlePaste"
    @dragover.prevent="isDragging = true"
    @dragleave.prevent="isDragging = false"
    @drop.prevent="handleFileDrop"
    class="relative w-full rounded-xl border-2 border-dashed transition-colors duration-200 ease-in-out p-6 flex flex-col items-center justify-center text-center cursor-pointer overflow-hidden"
    :class="isDragging ? 'border-primary bg-primary-container/10' : 'border-outline/50 hover:border-primary hover:bg-surface-container-low'"
    @click="$refs.fileInput.click()">
    
    <input x-ref="fileInput" type="file" class="hidden" accept="image/*" wire:model="{{ $model }}" @change="uploadFile($event.target.files[0])" />

    <!-- Preview -->
    <template x-if="previewUrl || '{{ $existingImage }}'">
        <div class="relative w-full h-48 rounded-lg overflow-hidden group">
            <img :src="previewUrl ? previewUrl : '{{ $existingImage ? Storage::disk('azure')->url($existingImage) : '' }}'" class="w-full h-full object-contain" />
            
            <div x-show="isUploading" class="absolute inset-0 bg-surface/50 flex items-center justify-center">
                <span class="material-symbols-outlined animate-spin text-primary text-[32px]">progress_activity</span>
            </div>

            <div x-show="!isUploading" class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                <span class="text-white font-label-md bg-black/60 px-3 py-1.5 rounded-full">Cambiar imagen</span>
            </div>
        </div>
    </template>
    
    <!-- Empty State -->
    <template x-if="!previewUrl && !'{{ $existingImage }}'">
        <div class="flex flex-col items-center gap-2 text-on-surface-variant">
            <span class="material-symbols-outlined text-[32px] text-outline" :class="isUploading ? 'animate-spin' : ''" x-text="isUploading ? 'progress_activity' : 'image'"></span>
            <p class="font-body-md text-body-md">
                Arrastra una imagen, <strong>pega (Ctrl+V)</strong>, o haz clic
            </p>
            <p class="font-body-sm text-body-sm text-outline">PNG, JPG, GIF (Max. 10MB)</p>
        </div>
    </template>
</div>
