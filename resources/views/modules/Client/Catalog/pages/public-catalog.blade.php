<div class="w-full px-margin-mobile md:px-margin py-12">
    <!-- Encabezado y Navbar Minimalista -->
    <div class="flex justify-between items-center mb-10 pb-6 border-b border-slate-200">
        <h1 class="text-4xl font-black tracking-tight text-slate-900">
            Tech<span class="text-indigo-600">Store</span>
        </h1>
        <div class="flex items-center gap-6">
            <button wire:click="$dispatch('cart-updated')" class="relative p-2 text-slate-600 hover:text-indigo-600 transition-colors">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                <!-- Indicador de carrito lleno podría ir aquí -->
            </button>
            @auth
                <a href="{{ route('dashboard') }}" class="font-medium text-slate-600 hover:text-indigo-600 transition-colors">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="font-medium text-slate-600 hover:text-indigo-600 transition-colors">Iniciar Sesión</a>
            @endauth
        </div>
    </div>

    @error('cart')
        <div class="mb-4 bg-red-50 border-l-4 border-red-500 p-4">
            <div class="flex">
                <div class="ml-3">
                    <p class="text-sm text-red-700">{{ $message }}</p>
                </div>
            </div>
        </div>
    @enderror

    <!-- Filtros Modernos -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-10 bg-white p-4 rounded-2xl shadow-sm border border-slate-100">
        <div class="relative w-full md:w-1/2">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </div>
            <input wire:model.live.debounce.300ms="search" type="text" placeholder="Buscar por nombre o código SKU..." class="block w-full pl-10 pr-3 py-3 border-none bg-slate-50 text-slate-900 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:bg-white transition-colors placeholder-slate-400">
        </div>
        
        <div class="w-full md:w-1/3">
            <select wire:model.live="category_filter" class="block w-full py-3 px-4 border-none bg-slate-50 text-slate-900 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:bg-white transition-colors cursor-pointer appearance-none">
                <option value="">Todas las Categorías</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <!-- Grid de Productos -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
        @forelse($products as $product)
            <div class="group bg-white rounded-2xl shadow-sm hover:shadow-2xl border border-slate-100 transition-all duration-300 transform hover:-translate-y-1 flex flex-col overflow-hidden">
                
                <!-- Imagen -->
                <div class="relative w-full h-56 bg-slate-100 overflow-hidden">
                    @if($product->imagen)
                        <img src="{{ $product->imagen }}" alt="{{ $product->nombre }}" class="w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-500">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-slate-300">
                            <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                    @endif
                    <!-- Badge Categoría -->
                    @if($product->category)
                        <span class="absolute top-4 left-4 bg-white/90 backdrop-blur text-indigo-800 text-xs font-bold px-3 py-1 rounded-full shadow-sm">
                            {{ $product->category->name }}
                        </span>
                    @endif
                    <!-- Stock Badge -->
                    @if($product->stock <= 0)
                        <div class="absolute inset-0 bg-white/60 backdrop-blur-sm flex items-center justify-center z-10">
                            <span class="bg-red-500 text-white font-bold px-4 py-2 rounded-lg shadow-lg rotate-12">Agotado</span>
                        </div>
                    @endif
                </div>

                <!-- Info -->
                <div class="p-6 flex flex-col flex-1">
                    <h3 class="text-lg font-bold text-slate-900 mb-1 leading-tight">{{ $product->nombre }}</h3>
                    <p class="text-sm text-slate-500 mb-4 line-clamp-2 flex-1">{{ $product->descripcion_corta }}</p>
                    
                    <div class="flex items-end justify-between mt-auto pt-4 border-t border-slate-100">
                        <div>
                            <span class="block text-2xl font-black text-indigo-600">${{ number_format($product->precio_mxn, 2) }}</span>
                            <span class="block text-xs font-medium text-slate-400 line-through">${{ number_format($product->precio_usd, 2) }} USD</span>
                        </div>
                        
                        <button wire:click="addToCart({{ $product->id }})" 
                                @if($product->stock <= 0) disabled @endif
                                class="p-3 rounded-xl bg-slate-900 text-white hover:bg-indigo-600 transition-colors focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 disabled:opacity-50 disabled:cursor-not-allowed">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                        </button>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full py-20 text-center">
                <svg class="mx-auto h-16 w-16 text-slate-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <h3 class="text-lg font-medium text-slate-900 mb-2">No se encontraron productos</h3>
                <p class="text-slate-500">Prueba con otros términos de búsqueda o cambia la categoría.</p>
            </div>
        @endforelse
    </div>

    <div class="mt-12">
        {{ $products->links() }}
    </div>
</div>
