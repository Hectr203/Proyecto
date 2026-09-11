@props(['product'])

<div class="group flex flex-col bg-surface-container-lowest rounded-2xl p-space-md shadow-sm hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
    <!-- Media Container -->
    <a href="{{ route('product.show', $product->sku) }}" class="relative w-full aspect-square bg-surface-container-low rounded-xl overflow-hidden mb-space-md block cursor-pointer">
        <img alt="{{ $product->nombre }}" class="w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-500 ease-out" src="{{ $product->image_url ?? '/images/stitch/img_1.jpg' }}"/>
        
        <!-- Glass Tag -->
        <div class="absolute top-3 left-3 backdrop-blur-md bg-surface/85 px-2.5 py-1 rounded-full shadow-xs">
            <span class="font-label-promotional text-label-promotional text-tertiary uppercase tracking-wider">{{ $product->category->name ?? 'Premium' }}</span>
        </div>
        
        <!-- Wishlist Micro-action -->
        <button aria-label="Add to Wishlist" class="absolute top-3 right-3 w-8 h-8 rounded-full backdrop-blur-md bg-surface/80 text-on-surface-variant hover:text-primary flex items-center justify-center transition-colors shadow-xs z-10" type="button" onclick="event.preventDefault();">
            <span class="material-symbols-outlined text-[18px]">favorite</span>
        </button>
    </a>

    <!-- Meta -->
    <div class="flex items-center justify-between text-on-surface-variant mb-1">
        <span class="font-label-promotional text-label-promotional uppercase text-primary tracking-wider">SKU: {{ $product->sku }}</span>
    </div>

    <!-- Product Name & Short Copy -->
    <a href="{{ route('product.show', $product->sku) }}" class="block">
        <h3 class="font-headline-sm text-headline-sm text-on-surface mb-1.5 group-hover:text-primary transition-colors">{{ $product->nombre }}</h3>
    </a>
    <p class="font-body-sm text-body-sm text-on-surface-variant mb-space-md line-clamp-2">{{ $product->descripcion_corta }}</p>

    <!-- Value-Add Metric Bar -->
    @if($product->metrics && count($product->metrics) > 0)
    <div class="mt-auto pt-space-sm border-t border-surface-container-low bg-surface-container-lowest -mx-space-md px-space-md py-3 flex flex-col gap-2.5 text-on-surface-variant mb-space-md">
        @foreach($product->metrics as $metric)
            <div class="flex items-center justify-between gap-3">
                <span class="font-label-sm text-label-sm min-w-[80px]">{{ $metric['label'] }}</span>
                @if($metric['type'] === 'percentage')
                    <div class="flex-1 h-1.5 bg-surface-container-highest rounded-full overflow-hidden">
                        <div class="h-full bg-tertiary rounded-full" style="width: {{ $metric['value'] }}%"></div>
                    </div>
                    <span class="font-label-sm text-label-sm font-semibold text-on-surface w-9 text-right">{{ $metric['value'] }}%</span>
                @else
                    <span class="font-label-sm text-label-sm font-semibold text-on-surface bg-surface-container px-2 py-0.5 rounded-md text-right">{{ $metric['value'] }}</span>
                @endif
            </div>
        @endforeach
    </div>
    @else
    <div class="mt-auto pt-space-sm border-t-0 bg-surface-container-low/40 -mx-space-md px-space-md py-2 flex items-center justify-between text-on-surface-variant mb-space-md">
        <div class="flex items-center gap-1.5">
            <span class="w-1.5 h-1.5 rounded-full {{ $product->stock > 0 ? 'bg-tertiary' : 'bg-error' }}"></span>
            <span class="font-label-sm text-label-sm">{{ $product->stock > 0 ? 'Disponible' : 'Agotado' }}</span>
        </div>
        @if($product->stock > 0 && $product->stock < 10)
            <span class="font-label-sm text-label-sm font-semibold text-primary">¡Solo quedan {{ $product->stock }}!</span>
        @endif
    </div>
    @endif

    <!-- Price and CTA -->
    <div class="flex items-center justify-between gap-space-sm pt-space-xs">
        <div class="flex flex-col gap-0.5">
            <span class="font-headline-sm text-headline-sm text-on-surface font-semibold">${{ number_format($product->precio_mxn, 2) }} MXN</span>
            @if($product->precio_usd)
            <span class="font-body-sm text-body-sm text-on-surface-variant font-medium">${{ number_format($product->precio_usd, 2) }} USD</span>
            @endif
        </div>
        <button wire:click="addToCart({{ $product->id }})" class="h-10 px-space-md rounded-full {{ $product->stock > 0 ? 'bg-inverse-surface text-inverse-on-surface hover:bg-on-surface-variant' : 'bg-surface-container text-on-surface-variant cursor-not-allowed' }} font-label-md text-label-md transition-colors flex items-center gap-1 active:scale-95 shadow-sm" type="button" @if(!$product->stock) disabled @endif>
            <span class="material-symbols-outlined text-[18px]">add_shopping_cart</span>
            <span>{{ $product->stock > 0 ? 'Agregar' : 'Sin stock' }}</span>
        </button>
    </div>
</div>
