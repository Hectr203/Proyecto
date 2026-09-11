<div class="w-full bg-surface min-h-screen">
    <!-- Hero Banner (Stitch Design) -->
    <section class="relative w-full max-w-7xl mx-auto px-margin py-space-xl overflow-hidden">
        <div class="flex flex-col items-center text-center max-w-4xl mx-auto mb-space-xl">
            <!-- Eyebrow Pill -->
            <div class="inline-flex items-center gap-space-xs bg-surface-container px-space-md py-1.5 rounded-full shadow-[inset_0_1px_0_0_rgba(255,255,255,0.9)] mb-space-md transition-transform hover:scale-[1.02] cursor-default">
                <span class="w-2 h-2 rounded-full bg-primary-container animate-pulse"></span>
                <span class="font-label-promotional text-label-promotional text-primary uppercase tracking-widest">NUEVA COLECCIÓN VIBRANT</span>
            </div>
            <!-- Hero Headline -->
            <h1 class="font-display-hero text-display-hero text-on-surface tracking-tight mb-space-md max-w-3xl">
                La Arquitectura de la Vitalidad.
            </h1>
            <!-- Subtitle -->
            <p class="font-body-lg text-body-lg text-on-surface-variant max-w-2xl mb-space-lg font-normal leading-relaxed">
                Descubre nuestra selección de productos premium. Fórmulas de precisión y diseño excepcional creados para tu ritual diario.
            </p>
        </div>
        
        <!-- Editorial Media Showcase -->
        <div class="relative w-full rounded-3xl overflow-hidden shadow-[0_16px_36px_-6px_rgba(29,29,31,0.08)] bg-surface-container-low aspect-[16/9] max-h-[440px]">
            <img alt="Lumen Lab architectural still life" class="w-full h-full object-cover object-center transform hover:scale-[1.01] transition-transform duration-700 ease-out" src="/images/stitch/img_6.jpg"/>
            <div class="absolute bottom-6 left-6 backdrop-blur-xl bg-surface/80 rounded-2xl p-space-md shadow-lg hidden md:flex items-center gap-space-md max-w-sm">
                <div class="w-10 h-10 rounded-full bg-primary-fixed flex items-center justify-center text-primary shrink-0">
                    <span class="material-symbols-outlined text-[20px]">graphic_eq</span>
                </div>
                <div>
                    <div class="flex items-center gap-space-xs">
                        <span class="font-label-md text-label-md text-on-surface">Diseño y Calidad</span>
                        <span class="font-label-promotional text-label-promotional text-primary uppercase">Premium</span>
                    </div>
                    <p class="font-body-sm text-body-sm text-on-surface-variant">Calibrado a la perfección para brindarte la mejor experiencia.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION 3: FEATURED COLLECTION MATRIX -->
    <section class="w-full max-w-7xl mx-auto px-margin py-space-xl" id="flagship-collection">
        <!-- Header with Filter Tabs -->
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-space-lg gap-space-md">
            <div>
                <div class="flex items-center gap-space-xs text-primary font-label-promotional text-label-promotional tracking-widest uppercase mb-1">
                    <span class="material-symbols-outlined text-[14px]">tune</span>
                    Catálogo Completo
                </div>
                <h2 class="font-headline-lg text-headline-lg text-on-surface tracking-tight">Nuestros Productos</h2>
            </div>
            <!-- Filter Controls -->
            <div class="flex items-center gap-space-sm flex-wrap">
                <div class="flex items-center gap-1 bg-surface-container p-1 rounded-full text-body-sm">
                    <button wire:click="$set('category_id', '')" class="px-space-md py-1.5 rounded-full {{ $category_id === '' ? 'bg-inverse-surface text-inverse-on-surface' : 'text-on-surface-variant hover:text-on-surface' }} font-label-sm text-label-sm transition-colors" type="button">Todas</button>
                    @foreach($categories->take(3) as $cat)
                        <button wire:click="$set('category_id', '{{ $cat->id }}')" class="px-space-md py-1.5 rounded-full {{ $category_id == $cat->id ? 'bg-inverse-surface text-inverse-on-surface' : 'text-on-surface-variant hover:text-on-surface' }} font-label-sm text-label-sm transition-colors" type="button">{{ $cat->name }}</button>
                    @endforeach
                </div>
            </div>
        </div>
        
        <!-- Search Bar -->
        <div class="mb-space-lg flex items-center bg-surface-container-low px-space-md py-3 rounded-full shadow-[inset_0_1px_0_0_rgba(255,255,255,0.9)] border border-surface-container">
            <span class="material-symbols-outlined text-on-surface-variant text-[20px] mr-2">search</span>
            <input wire:model.live.debounce.300ms="search" class="bg-transparent text-on-surface placeholder:text-on-surface-variant font-body-lg text-body-lg focus:outline-none w-full border-none p-0 focus:ring-0" placeholder="Busca productos por nombre o descripción..." type="text"/>
        </div>

        <!-- Product 3-Column Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-space-lg relative min-h-[400px]">
            <div wire:loading class="absolute inset-0 bg-surface/50 backdrop-blur-sm z-10 flex items-center justify-center rounded-2xl">
                <div class="w-10 h-10 border-4 border-primary border-t-transparent rounded-full animate-spin"></div>
            </div>

            @forelse($products as $product)
                <x-molecules.product-card :product="$product" />
            @empty
                <div class="col-span-1 md:col-span-2 lg:col-span-3 py-space-xl text-center">
                    <span class="material-symbols-outlined text-[48px] text-on-surface-variant mb-space-sm opacity-50">inventory_2</span>
                    <h3 class="font-headline-sm text-headline-sm text-on-surface">No se encontraron productos</h3>
                    <p class="font-body-md text-body-md text-on-surface-variant mt-2">Intenta ajustar tus filtros de búsqueda.</p>
                </div>
            @endforelse
        </div>
        
        <div class="mt-space-xl">
            {{ $products->links() }}
        </div>
    </section>
</div>
