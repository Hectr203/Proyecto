@props(['product'])

<div class="group flex flex-col bg-surface-container-lowest rounded-3xl overflow-hidden shadow-[0_8px_30px_rgb(0,0,0,0.04)] hover:shadow-[0_20px_40px_rgb(0,0,0,0.08)] transition-all duration-500 hover:-translate-y-2 border border-surface-container/50 h-full">
    <!-- Media Container (Edge to edge) -->
    <div class="relative w-full aspect-square bg-surface-container-low overflow-hidden cursor-pointer">
        <!-- Image acts as link -->
        <a href="{{ route('product.show', $product->sku) }}" class="absolute inset-0 z-0 block">
            <img alt="{{ $product->nombre }}" class="w-full h-full object-cover object-center group-hover:scale-110 transition-transform duration-700 ease-in-out" src="{{ $product->image_url ?? '/images/stitch/img_1.jpg' }}"/>
            <!-- Gradient Overlay for better contrast -->
            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/0 to-black/20 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
        </a>

        <!-- Glass Tag -->
        <div class="absolute top-4 left-4 z-10 pointer-events-none backdrop-blur-xl bg-white/20 border border-white/30 px-3 py-1.5 rounded-full shadow-lg">
            <span class="font-label-promotional text-[10px] text-white uppercase tracking-[0.2em] font-bold drop-shadow-md">{{ $product->category->name ?? 'Premium' }}</span>
        </div>

        <!-- Quick Add (Shows on hover) -->
        <div class="absolute bottom-4 left-0 right-0 flex justify-center px-4 translate-y-12 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-500 ease-out z-20">
            <button wire:click.prevent="addToCart({{ $product->id }})" class="w-full py-3 rounded-2xl backdrop-blur-xl bg-white/95 text-primary font-bold text-sm flex items-center justify-center gap-2 shadow-[0_8px_30px_rgb(0,0,0,0.12)] hover:bg-white hover:scale-[1.02] transition-all" @if(!$product->stock) disabled @endif>
                <span class="material-symbols-outlined text-[18px]">add_shopping_cart</span>
                <span>{{ $product->stock > 0 ? 'Agregar al Carrito' : 'Agotado' }}</span>
            </button>
        </div>
    </div>

    <!-- Meta & Content -->
    <div class="p-4 flex flex-col flex-1">
        <div class="flex items-center justify-between mb-2">
            <span class="text-[9px] uppercase text-primary font-bold tracking-[0.15em]">SKU: {{ $product->sku }}</span>
            <div class="flex items-center gap-1.5">
                <span class="w-1.5 h-1.5 rounded-full {{ $product->stock > 0 ? 'bg-green-500 shadow-[0_0_8px_rgba(34,197,94,0.5)]' : 'bg-red-500 shadow-[0_0_8px_rgba(239,68,68,0.5)]' }} {{ $product->stock > 0 ? 'animate-pulse' : '' }}"></span>
                <span class="text-[10px] font-medium text-on-surface-variant uppercase tracking-wider">{{ $product->stock > 0 ? 'En Stock' : 'Agotado' }}</span>
            </div>
        </div>

        <a href="{{ route('product.show', $product->sku) }}" class="block mb-1.5">
            <h3 class="font-headline-sm text-base font-semibold text-on-surface group-hover:text-primary transition-colors leading-tight line-clamp-2">{{ $product->nombre }}</h3>
        </a>
        <p class="text-xs text-on-surface-variant/80 mb-4 line-clamp-2 leading-relaxed">{{ $product->descripcion_corta }}</p>

        <!-- Value-Add Metric Bar (If available) -->
        @if($product->metrics && count($product->metrics) > 0)
        <div class="mb-4 flex flex-col gap-1.5">
            @foreach(array_slice($product->metrics, 0, 2) as $metric)
                <div class="flex items-center justify-between gap-2">
                    <span class="text-[10px] font-medium text-on-surface-variant uppercase tracking-wider">{{ $metric['label'] }}</span>
                    @if($metric['type'] === 'percentage')
                        <div class="flex-1 h-1 bg-surface-container-highest rounded-full overflow-hidden">
                            <div class="h-full bg-primary rounded-full" style="width: {{ $metric['value'] }}%"></div>
                        </div>
                        <span class="text-[10px] font-bold text-on-surface w-7 text-right">{{ $metric['value'] }}%</span>
                    @else
                        <span class="text-[10px] font-bold text-on-surface bg-surface-container-high px-1.5 py-0.5 rounded text-right">{{ $metric['value'] }}</span>
                    @endif
                </div>
            @endforeach
        </div>
        @endif

        <!-- Price -->
        <div class="mt-auto flex items-end justify-between pt-3 border-t border-surface-container-low/50">
            <div class="flex flex-col">
                <span class="text-[9px] text-on-surface-variant uppercase tracking-widest font-bold mb-0.5">Precio</span>
                <div class="flex items-baseline gap-1">
                    <span class="text-xl font-bold text-on-surface leading-none">${{ number_format($product->precio_mxn, 2) }}</span>
                    <span class="text-[10px] font-bold text-primary">MXN</span>
                </div>
            </div>
            @if($product->precio_usd)
            <div class="flex items-center justify-center bg-surface-container-low px-2 py-0.5 rounded-md">
                <span class="text-[11px] font-semibold text-on-surface-variant">${{ number_format($product->precio_usd, 2) }} USD</span>
            </div>
            @endif
        </div>
    </div>
</div>
