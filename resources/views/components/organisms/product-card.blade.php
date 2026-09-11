@props(['product'])

<div class="bg-surface-container-lowest border border-surface-container rounded-2xl overflow-hidden hover:shadow-lg transition-all duration-300 flex flex-col group h-full">
    <div class="h-64 w-full bg-surface-container-low flex items-center justify-center overflow-hidden relative">
        <img src="{{ $product->image_url ?? '/images/stitch/img_1.jpg' }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
        <div class="absolute top-4 right-4">
            <span class="px-3 py-1 inline-flex text-xs font-bold rounded-full shadow-sm backdrop-blur-md {{ $product->activo ? 'bg-tertiary-container/90 text-on-tertiary-container border border-tertiary/20' : 'bg-error-container/90 text-on-error-container border border-error/20' }}">
                {{ $product->activo ? 'Activo' : 'Inactivo' }}
            </span>
        </div>
    </div>
    
    <div class="p-6 flex-1 flex flex-col">
        <div class="flex justify-between items-start mb-2">
            <span class="font-label-md text-on-surface-variant tracking-wider uppercase">{{ $product->sku }}</span>
        </div>
        
        <h3 class="font-headline-sm text-on-surface mb-4 line-clamp-2 leading-tight group-hover:text-primary transition-colors">{{ $product->nombre }}</h3>
        
        <div class="mt-auto pt-4 border-t border-surface-container flex justify-between items-end">
            <div>
                <div class="font-headline-sm text-primary font-bold">${{ number_format($product->precio_mxn, 2) }} <span class="text-sm font-normal">MXN</span></div>
                <div class="font-body-sm text-on-surface-variant mt-0.5">${{ number_format($product->precio_usd, 2) }} USD</div>
            </div>
            <div class="font-label-md {{ $product->stock > 10 ? 'text-tertiary' : 'text-error' }} bg-surface-container px-3 py-1 rounded-lg">
                Stock: {{ $product->stock }}
            </div>
        </div>
        
        <div class="mt-6 flex justify-end gap-3">
            <button wire:click="edit({{ $product->id }})" class="flex items-center justify-center bg-surface-container-low text-on-surface hover:bg-tertiary hover:text-on-tertiary hover:border-tertiary transition-colors p-2.5 rounded-xl border border-surface-container shadow-sm active:scale-95" title="Editar">
                <span class="material-symbols-outlined text-[20px]">edit</span>
            </button>
            <button wire:click="delete({{ $product->id }})" class="flex items-center justify-center bg-surface-container-low text-on-surface hover:bg-error hover:text-on-error hover:border-error transition-colors p-2.5 rounded-xl border border-surface-container shadow-sm active:scale-95" title="Eliminar">
                <span class="material-symbols-outlined text-[20px]">delete</span>
            </button>
        </div>
    </div>
</div>
