<div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8 bg-surface min-h-screen">
    <div class="mb-8">
        <a href="{{ route('store') }}" class="inline-flex items-center text-primary hover:text-primary-container font-label-lg transition-colors">
            <span class="material-symbols-outlined mr-2">arrow_back</span>
            Volver al catálogo
        </a>
    </div>

    <div class="bg-surface-container-lowest rounded-3xl overflow-hidden shadow-sm border border-surface-container flex flex-col md:flex-row">
        <!-- Imagen -->
        <div class="w-full md:w-1/2 bg-surface-container-low aspect-square relative flex items-center justify-center p-8">
            @if($product->image_url)
                <img src="{{ $product->image_url }}" alt="{{ $product->nombre }}" class="w-full h-full object-contain drop-shadow-xl transform hover:scale-105 transition-transform duration-500">
            @else
                <span class="material-symbols-outlined text-[120px] text-surface-container-highest">image</span>
            @endif
        </div>

        <!-- Info -->
        <div class="w-full md:w-1/2 p-8 md:p-12 flex flex-col justify-center">
            <div class="uppercase tracking-widest text-primary font-label-promotional mb-2">
                {{ $product->category->name ?? 'Catálogo Premium' }}
            </div>
            
            <h1 class="text-4xl md:text-5xl font-display-hero text-on-surface mb-4 leading-tight">
                {{ $product->nombre }}
            </h1>
            
            <div class="flex items-center gap-4 mb-6">
                <span class="text-3xl font-headline-lg text-on-surface font-bold">
                    ${{ number_format($product->precio_mxn, 2) }} <span class="text-lg font-normal text-on-surface-variant">MXN</span>
                </span>
                @if($product->precio_usd)
                <span class="text-xl font-body-lg text-on-surface-variant bg-surface-container px-3 py-1 rounded-full">
                    ${{ number_format($product->precio_usd, 2) }} USD
                </span>
                @endif
            </div>

            <p class="text-lg text-on-surface-variant mb-8 leading-relaxed font-body-lg">
                {{ $product->descripcion_larga ?: $product->descripcion_corta }}
            </p>

            <div class="border-t border-surface-container pt-8 flex flex-col gap-4">
                <div class="flex items-center justify-between mb-4">
                    <span class="font-label-lg text-on-surface-variant">Disponibilidad:</span>
                    @if($product->stock > 0)
                        <span class="inline-flex items-center px-3 py-1 rounded-full bg-primary-container text-on-primary-container font-label-md">
                            <span class="w-2 h-2 rounded-full bg-primary mr-2"></span>
                            En Stock ({{ $product->stock }} disponibles)
                        </span>
                    @else
                        <span class="inline-flex items-center px-3 py-1 rounded-full bg-error-container text-on-error-container font-label-md">
                            Agotado
                        </span>
                    @endif
                </div>

                <button wire:click="addToCart" 
                        class="w-full h-14 rounded-full flex items-center justify-center gap-2 font-label-lg transition-all {{ $product->stock > 0 ? 'bg-primary text-on-primary hover:bg-primary-container hover:text-on-primary-container hover:shadow-md' : 'bg-surface-container text-on-surface-variant cursor-not-allowed' }}" 
                        @if(!$product->stock) disabled @endif>
                    <span class="material-symbols-outlined">{{ $product->stock > 0 ? 'add_shopping_cart' : 'remove_shopping_cart' }}</span>
                    {{ $product->stock > 0 ? 'Agregar al Carrito' : 'Sin existencias' }}
                </button>
            </div>
            
            <!-- Detalles adicionales -->
            <div class="mt-8 grid grid-cols-2 gap-4 text-sm">
                <div class="bg-surface-container-low p-4 rounded-2xl">
                    <span class="block text-on-surface-variant mb-1">SKU</span>
                    <span class="font-bold text-on-surface">{{ $product->sku }}</span>
                </div>
                <div class="bg-surface-container-low p-4 rounded-2xl">
                    <span class="block text-on-surface-variant mb-1">Envío Seguro</span>
                    <span class="font-bold text-on-surface">Disponible</span>
                </div>
            </div>
        </div>
    </div>
</div>
