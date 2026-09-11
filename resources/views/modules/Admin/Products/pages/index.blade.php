<div class="p-6 bg-surface min-h-screen">
    <div class="flex justify-between items-center mb-6">
        <h2 class="font-headline-lg text-headline-lg text-on-surface tracking-tight">Catálogo de Productos</h2>
        <button wire:click="create()" class="h-10 px-space-lg rounded-full bg-primary text-on-primary hover:bg-primary-container hover:text-on-primary-container font-label-md text-label-md transition-all active:scale-95 flex items-center justify-center shadow-sm">
            <span class="material-symbols-outlined mr-2 text-[18px]">add</span> Nuevo Producto
        </button>
    </div>

    <!-- Contenedor de Filtros -->
    <div class="bg-surface-container-lowest border border-surface-container rounded-2xl p-5 mb-6 shadow-sm flex flex-col lg:flex-row gap-6 lg:items-center justify-between">
        <div class="flex flex-col sm:flex-row gap-4 w-full lg:w-2/3 items-center">
            <div class="hidden lg:flex items-center gap-2 text-on-surface-variant font-label-md mr-2 whitespace-nowrap">
                <span class="material-symbols-outlined text-[20px]">filter_list</span> Filtros:
            </div>
            
            <div class="w-full sm:w-2/3">
                <x-molecules.search-input wire:model.live="search" placeholder="Buscar por SKU o Nombre..." />
            </div>
            
            <div class="w-full sm:w-1/3 min-w-[180px]">
                <select wire:model.live="filterActivo" class="w-full pl-5 pr-10 py-2.5 bg-surface-container-lowest border border-surface-container rounded-full text-on-surface focus:border-primary focus:ring focus:ring-primary/20 shadow-sm font-body-md transition-all cursor-pointer">
                    <option value="">Estado: Todos</option>
                    <option value="1">Estado: Activos</option>
                    <option value="0">Estado: Inactivos</option>
                </select>
            </div>
        </div>
        
        <div class="w-full lg:w-auto overflow-x-auto flex justify-end">
            {{ $products->links() }}
        </div>
    </div>

    <!-- Barra de Herramientas de la Vista (Toggle) -->
    <div class="flex justify-end mb-4">
        <div class="flex bg-surface-container-low rounded-full p-1 border border-surface-container shadow-sm inline-flex">
            <button wire:click="$set('viewMode', 'table')" class="w-10 h-10 rounded-full flex items-center justify-center transition-all {{ $viewMode === 'table' ? 'bg-primary text-on-primary shadow-md' : 'text-on-surface-variant hover:text-on-surface hover:bg-surface-container-highest' }}" title="Vista de Tabla">
                <span class="material-symbols-outlined text-[20px]">table_rows</span>
            </button>
            <button wire:click="$set('viewMode', 'grid')" class="w-10 h-10 rounded-full flex items-center justify-center transition-all {{ $viewMode === 'grid' ? 'bg-primary text-on-primary shadow-md' : 'text-on-surface-variant hover:text-on-surface hover:bg-surface-container-highest' }}" title="Vista de Tarjetas">
                <span class="material-symbols-outlined text-[20px]">grid_view</span>
            </button>
        </div>
    </div>

    @if($viewMode === 'table')
    <!-- Tabla de resultados -->
    <x-organisms.table>
        <x-slot name="head">
            <th class="px-6 py-5 bg-surface-container-lowest border-b border-surface-container text-left font-label-md text-label-md text-on-surface-variant uppercase tracking-wider">Imagen</th>
            <th class="px-6 py-5 bg-surface-container-lowest border-b border-surface-container text-left font-label-md text-label-md text-on-surface-variant uppercase tracking-wider">SKU</th>
            <th class="px-6 py-5 bg-surface-container-lowest border-b border-surface-container text-left font-label-md text-label-md text-on-surface-variant uppercase tracking-wider">Nombre</th>
            <th class="px-6 py-5 bg-surface-container-lowest border-b border-surface-container text-left font-label-md text-label-md text-on-surface-variant uppercase tracking-wider">Precio (USD/MXN)</th>
            <th class="px-6 py-5 bg-surface-container-lowest border-b border-surface-container text-left font-label-md text-label-md text-on-surface-variant uppercase tracking-wider">Stock</th>
            <th class="px-6 py-5 bg-surface-container-lowest border-b border-surface-container text-left font-label-md text-label-md text-on-surface-variant uppercase tracking-wider">Activo</th>
            <th class="px-6 py-5 bg-surface-container-lowest border-b border-surface-container text-right font-label-md text-label-md text-on-surface-variant uppercase tracking-wider">Acciones</th>
        </x-slot>

        @forelse($products as $product)
        <tr class="hover:bg-surface-container-lowest transition-colors border-b border-surface-container/50 last:border-0">
            <td class="px-6 py-4 whitespace-nowrap">
                <img src="{{ $product->image_url ?? '/images/stitch/img_1.jpg' }}" class="h-14 w-14 object-cover rounded-xl border border-surface-container shadow-sm">
            </td>
            <td class="px-6 py-4 whitespace-nowrap font-body-md text-body-md text-on-surface font-bold">{{ $product->sku }}</td>
            <td class="px-6 py-4 whitespace-nowrap font-body-md text-body-md text-on-surface-variant max-w-xs truncate">{{ $product->nombre }}</td>
            <td class="px-6 py-4 whitespace-nowrap font-body-md text-body-md text-on-surface-variant">
                <span class="font-semibold text-primary">${{ number_format($product->precio_mxn, 2) }}</span> <span class="text-sm opacity-70">MXN</span> <br>
                <span class="text-sm opacity-80">${{ number_format($product->precio_usd, 2) }} USD</span>
            </td>
            <td class="px-6 py-4 whitespace-nowrap font-body-md text-body-md text-on-surface-variant">
                <span class="bg-surface-container px-2 py-1 rounded-lg font-medium">{{ $product->stock }}</span>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
                <span class="px-3 py-1 inline-flex text-[12px] font-bold rounded-full border {{ $product->activo ? 'bg-tertiary-container text-on-tertiary-container border-tertiary/20' : 'bg-error-container text-on-error-container border-error/20' }}">
                    {{ $product->activo ? 'Sí' : 'No' }}
                </span>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-right font-label-md text-label-md font-medium">
                <button wire:click="edit({{ $product->id }})" class="text-tertiary hover:bg-tertiary hover:text-on-tertiary transition-colors p-2 rounded-xl hover:shadow-sm border border-transparent hover:border-tertiary/20" title="Editar">
                    <span class="material-symbols-outlined text-[20px]">edit</span>
                </button>
                <button wire:click="delete({{ $product->id }})" class="text-error hover:bg-error hover:text-on-error transition-colors p-2 rounded-xl hover:shadow-sm border border-transparent hover:border-error/20 ml-2" title="Eliminar">
                    <span class="material-symbols-outlined text-[20px]">delete</span>
                </button>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="7" class="px-6 py-8 text-center font-body-md text-on-surface-variant">No hay productos registrados en este momento.</td>
        </tr>
        @endforelse
    </x-organisms.table>
    @else
    <!-- Vista de Tarjetas -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
        @forelse($products as $product)
            <x-organisms.product-card :product="$product" />
        @empty
        <div class="col-span-full py-16 text-center bg-surface-container-lowest border border-surface-container rounded-2xl shadow-sm">
            <span class="material-symbols-outlined text-[48px] text-on-surface-variant mb-4 block">inventory_2</span>
            <span class="font-body-lg text-on-surface-variant">No hay productos registrados en este momento.</span>
        </div>
        @endforelse
    </div>
    @endif

    <!-- Modal para Formulario -->
    <x-organisms.modal :show="$showModal" :title="$productId ? 'Editar Producto' : 'Crear Nuevo Producto'" onClose="$set('showModal', false)">
        <form wire:submit.prevent="save">
            <div class="mb-4">
                <x-atoms.input-label>SKU</x-atoms.input-label>
                <x-atoms.text-input type="text" wire:model="sku" class="mt-1 block w-full" />
                @error('sku') <span class="text-error text-xs">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4">
                <x-atoms.input-label>Nombre</x-atoms.input-label>
                <x-atoms.text-input type="text" wire:model="nombre" class="mt-1 block w-full" />
                @error('nombre') <span class="text-error text-xs">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4">
                <x-atoms.input-label>Categoría</x-atoms.input-label>
                <div wire:ignore>
                    <select x-data="{
                            value: @entangle('category_id'),
                            init() {
                                let tom = new TomSelect(this.$refs.select, {
                                    create: false,
                                    sortField: { field: 'text', direction: 'asc' },
                                    placeholder: 'Busca una categoría...'
                                });
                                tom.on('change', (val) => {
                                    this.value = val;
                                });
                                this.$watch('value', (val) => {
                                    if (val !== tom.getValue()) {
                                        tom.setValue(val);
                                    }
                                });
                            }
                        }" 
                        x-ref="select"
                        class="mt-1 block w-full bg-surface-container-low border-surface-container text-on-surface rounded-xl font-body-md shadow-sm">
                        <option value="">Seleccione una categoría</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
                @error('category_id') <span class="text-error text-xs">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4">
                <x-atoms.input-label>Descripción Corta</x-atoms.input-label>
                <x-atoms.text-input type="text" wire:model="descripcion_corta" class="mt-1 block w-full" />
                @error('descripcion_corta') <span class="text-error text-xs">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4">
                <x-atoms.input-label>Imagen del Producto</x-atoms.input-label>
                <div class="mt-1">
                    <x-molecules.image-upload-paste model="imagen" :existing-image="is_string($imagen) ? $imagen : null" />
                </div>
                @error('imagen') <span class="text-error text-xs">{{ $message }}</span> @enderror
            </div>
            <div x-data="{ mxn: @entangle('precio_mxn').live, usd: @entangle('precio_usd'), rate: {{ $exchangeRate ?? 17.00 }} }" x-init="$watch('mxn', value => usd = (value / rate).toFixed(2))">
                <!-- Aviso de tipo de cambio -->
                <div class="mt-space-md bg-surface-container-low p-3 rounded-lg flex items-center justify-between mb-4">
                    <span class="font-body-sm text-on-surface-variant flex items-center"><span class="material-symbols-outlined text-[18px] mr-1">currency_exchange</span> Precio actual del dólar:</span>
                    <span class="font-label-md font-bold text-primary">${{ number_format($exchangeRate ?? 17.00, 2) }} MXN</span>
                </div>

                <div class="flex space-x-4 mb-4">
                    <div class="w-1/2">
                        <x-atoms.input-label>Precio MXN</x-atoms.input-label>
                        <x-atoms.text-input type="number" step="0.01" x-model="mxn" class="mt-1 block w-full" />
                        @error('precio_mxn') <span class="text-error text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div class="w-1/2 opacity-75">
                        <x-atoms.input-label>Precio USD (Auto-calculado)</x-atoms.input-label>
                        <x-atoms.text-input type="number" step="0.01" x-model="usd" readonly class="mt-1 block w-full bg-surface-container-lowest cursor-not-allowed" />
                        @error('precio_usd') <span class="text-error text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
            <div class="mb-4">
                <x-atoms.input-label>Stock disponible</x-atoms.input-label>
                <x-atoms.text-input type="number" wire:model="stock" class="mt-1 block w-full" />
                @error('stock') <span class="text-error text-xs">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4 pt-2">
                <label class="inline-flex items-center">
                    <input type="checkbox" wire:model="activo" class="rounded border-surface-container text-primary shadow-sm focus:ring-primary">
                    <span class="ml-2 font-body-sm text-body-sm text-on-surface-variant">¿Está activo?</span>
                </label>
            </div>
            
            <div class="bg-surface-container-low px-4 py-4 sm:px-6 sm:flex sm:flex-row-reverse -mx-4 -mb-4 mt-6 rounded-b-3xl border-t border-surface-container">
                <button type="submit" class="w-full inline-flex justify-center items-center rounded-full border border-transparent shadow-sm px-6 py-2.5 bg-primary font-label-md text-label-md text-on-primary hover:bg-primary-container hover:text-on-primary-container focus:outline-none transition-colors sm:ml-3 sm:w-auto" wire:loading.attr="disabled" wire:target="save">
                    <span wire:loading.remove wire:target="save">Guardar Información</span>
                    <span wire:loading wire:target="save" class="flex items-center">
                        <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-current" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Guardando...
                    </span>
                </button>
                <button type="button" wire:click="$set('showModal', false)" class="mt-3 w-full inline-flex justify-center rounded-full border border-surface-container shadow-sm px-6 py-2.5 bg-surface-container-lowest font-label-md text-label-md text-on-surface-variant hover:text-on-surface hover:bg-surface-container-low focus:outline-none transition-colors sm:mt-0 sm:ml-3 sm:w-auto">
                    Cancelar
                </button>
            </div>
        </form>
    </x-organisms.modal>
</div>
