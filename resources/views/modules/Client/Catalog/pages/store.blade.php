<div class="w-full bg-surface min-h-screen">
    <!-- Hero Banner (Vibrant Premium Design) -->
    <section class="relative w-full max-w-[1600px] mx-auto px-4 lg:px-8 xl:px-12 pt-space-xl pb-space-lg overflow-hidden">
        <div class="flex flex-col items-center text-center max-w-4xl mx-auto mb-space-xl relative z-10">
            <!-- Eyebrow Pill -->
            <div class="inline-flex items-center gap-space-xs bg-white/10 backdrop-blur-md border border-white/20 px-space-md py-2 rounded-full shadow-[0_8px_16px_rgb(0,0,0,0.05)] mb-space-md transition-transform hover:scale-[1.02] cursor-default">
                <span class="w-2.5 h-2.5 rounded-full bg-primary shadow-[0_0_12px_rgba(172,51,35,0.8)] animate-pulse"></span>
                <span class="font-label-promotional text-label-promotional text-primary uppercase tracking-widest font-bold">NUEVA COLECCIÓN VIBRANT</span>
            </div>
            <!-- Hero Headline -->
            <h1 class="font-display-hero text-5xl md:text-7xl font-bold text-on-surface tracking-tight mb-space-md max-w-3xl leading-[1.1]">
                La Arquitectura de la <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary to-[#ff7b6b]">Vitalidad</span>.
            </h1>
            <!-- Subtitle -->
            <p class="font-body-lg text-lg md:text-xl text-on-surface-variant max-w-2xl font-medium leading-relaxed">
                Descubre nuestra selección de productos premium. Fórmulas de precisión y diseño excepcional creados para tu ritual diario.
            </p>
        </div>
        
        <!-- Editorial Media Showcase -->
        <div class="relative w-full rounded-[2.5rem] overflow-hidden shadow-[0_32px_64px_-12px_rgba(29,29,31,0.15)] bg-surface-container-low aspect-[21/9] max-h-[500px]">
            <img alt="Lumen Lab architectural still life" class="w-full h-full object-cover object-center transform hover:scale-[1.03] transition-transform duration-[2s] ease-out" src="/images/stitch/img_6.jpg"/>
            
            <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent"></div>

            <div class="absolute bottom-8 left-8 backdrop-blur-2xl bg-white/10 border border-white/20 rounded-3xl p-6 shadow-2xl hidden md:flex items-center gap-5 max-w-md transform transition-all duration-500 hover:-translate-y-1">
                <div class="w-14 h-14 rounded-full bg-white/20 flex items-center justify-center text-white shrink-0 border border-white/30 shadow-inner">
                    <span class="material-symbols-outlined text-[28px] drop-shadow-md">graphic_eq</span>
                </div>
                <div>
                    <div class="flex items-center gap-2 mb-1">
                        <span class="text-sm font-bold text-white tracking-wide">Diseño y Calidad</span>
                        <span class="text-[10px] font-bold bg-primary text-white uppercase px-2 py-0.5 rounded-full tracking-widest shadow-md">Premium</span>
                    </div>
                    <p class="text-sm text-white/90 leading-relaxed font-medium">Calibrado a la perfección para brindarte la mejor experiencia vibrante.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION 3: FEATURED COLLECTION MATRIX -->
    <section class="w-full max-w-[1600px] mx-auto px-4 lg:px-8 xl:px-12 py-space-xl" id="flagship-collection">
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

        <!-- Product Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 2xl:grid-cols-5 gap-6 xl:gap-8 relative min-h-[400px]">
            <div wire:loading class="absolute inset-0 bg-surface/50 backdrop-blur-sm z-10 flex items-center justify-center rounded-2xl">
                <div class="w-10 h-10 border-4 border-primary border-t-transparent rounded-full animate-spin"></div>
            </div>

            @forelse($products as $product)
                <x-molecules.product-card :product="$product" />
            @empty
                <div class="col-span-1 md:col-span-2 lg:col-span-4 2xl:col-span-5 py-space-xl text-center">
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
