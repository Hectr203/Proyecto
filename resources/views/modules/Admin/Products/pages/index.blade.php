<div class="p-6 bg-surface min-h-screen">
    <div class="flex justify-between items-center mb-6">
        <h2 class="font-headline-lg text-headline-lg text-on-surface tracking-tight">Catálogo de Productos</h2>
        <button wire:click="create()" class="h-10 px-space-lg rounded-full bg-primary text-on-primary hover:bg-primary-container hover:text-on-primary-container font-label-md text-label-md transition-all active:scale-95 flex items-center justify-center shadow-sm">
            <span class="material-symbols-outlined mr-2 text-[18px]">add</span> Nuevo Producto
        </button>
    </div>

    <!-- Buscador de productos -->
    <div class="mb-4">
        <div class="relative w-full sm:w-1/3">
            <span class="material-symbols-outlined absolute left-3 top-1/2 transform -translate-y-1/2 text-on-surface-variant text-[20px]">search</span>
            <input wire:model.live="search" type="text" placeholder="Buscar por SKU o Nombre..." class="w-full pl-10 pr-4 py-2 bg-surface-container-lowest border border-surface-container rounded-full text-on-surface focus:border-primary focus:ring-primary shadow-sm font-body-md placeholder:text-on-surface-variant transition-colors">
        </div>
    </div>

    <!-- Tabla de resultados -->
    <div class="overflow-x-auto bg-surface-container-lowest rounded-2xl shadow-sm border border-surface-container">
        <table class="min-w-full divide-y divide-surface-container">
            <thead class="bg-surface-container-low">
                <tr>
                    <th class="px-6 py-3 text-left font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider">Imagen</th>
                    <th class="px-6 py-3 text-left font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider">SKU</th>
                    <th class="px-6 py-3 text-left font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider">Nombre</th>
                    <th class="px-6 py-3 text-left font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider">Precio (USD/MXN)</th>
                    <th class="px-6 py-3 text-left font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider">Stock</th>
                    <th class="px-6 py-3 text-left font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider">Activo</th>
                    <th class="px-6 py-3 text-right font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider">Acciones</th>
                </tr>
            </thead>
            <tbody class="bg-surface-container-lowest divide-y divide-surface-container">
                @forelse($products as $product)
                <tr class="hover:bg-surface transition-colors">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <img src="{{ $product->image_url ?? '/images/stitch/img_1.jpg' }}" class="h-10 w-10 object-cover rounded-md border border-surface-container">
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap font-body-sm text-body-sm text-on-surface font-semibold">{{ $product->sku }}</td>
                    <td class="px-6 py-4 whitespace-nowrap font-body-sm text-body-sm text-on-surface-variant">{{ $product->nombre }}</td>
                    <td class="px-6 py-4 whitespace-nowrap font-body-sm text-body-sm text-on-surface-variant">${{ $product->precio_usd }} / ${{ $product->precio_mxn }}</td>
                    <td class="px-6 py-4 whitespace-nowrap font-body-sm text-body-sm text-on-surface-variant">{{ $product->stock }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2.5 py-1 inline-flex text-[11px] font-semibold rounded-full {{ $product->activo ? 'bg-tertiary-fixed text-on-tertiary-fixed-variant' : 'bg-error-container text-on-error-container' }}">
                            {{ $product->activo ? 'Sí' : 'No' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right font-label-sm text-label-sm font-medium">
                        <button wire:click="edit({{ $product->id }})" class="text-tertiary hover:text-tertiary-fixed-dim mr-3 transition-colors">Editar</button>
                        <button wire:click="delete({{ $product->id }})" class="text-error hover:text-error-container transition-colors">Eliminar</button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-8 text-center font-body-md text-on-surface-variant">No hay productos registrados en este momento.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <div class="mt-4">
        {{ $products->links() }}
    </div>

    <!-- Modal para Formulario -->
    @if($showModal)
    <div class="fixed z-50 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-on-background/60 backdrop-blur-sm transition-opacity" aria-hidden="true"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-surface-container-lowest rounded-3xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full border border-surface-container border-opacity-50">
                <div class="bg-surface-container-lowest px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <h3 class="font-headline-sm text-headline-sm text-on-surface mb-6 flex items-center gap-2" id="modal-title">
                        <span class="w-2 h-2 rounded-full bg-primary-container"></span>
                        {{ $productId ? 'Editar Producto' : 'Crear Nuevo Producto' }}
                    </h3>
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
                            <x-atoms.input-label>Imagen del Producto (Max 10MB)</x-atoms.input-label>
                            <input type="file" wire:model="imagen" accept="image/*" class="mt-1 block w-full bg-surface-container-low border-surface-container text-on-surface rounded-xl font-body-md shadow-sm file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary-container file:text-on-primary-container hover:file:bg-primary-fixed">
                            <div wire:loading wire:target="imagen" class="text-sm text-tertiary mt-1">Cargando imagen...</div>
                            @if ($imagen)
                                <div class="mt-2">
                                    <span class="block text-xs text-on-surface-variant mb-1">Vista Previa:</span>
                                    @php
                                        $previewUrl = '';
                                        if (is_string($imagen)) {
                                            if (filter_var($imagen, FILTER_VALIDATE_URL)) {
                                                $previewUrl = $imagen;
                                            } else {
                                                try {
                                                    $previewUrl = \Illuminate\Support\Facades\Storage::disk('azure')->temporaryUrl($imagen, now()->addMinutes(30));
                                                } catch (\Exception $e) {
                                                    $previewUrl = '';
                                                }
                                            }
                                        } else {
                                            try {
                                                $previewUrl = $imagen->temporaryUrl();
                                            } catch (\Exception $e) {
                                                $previewUrl = '';
                                            }
                                        }
                                    @endphp
                                    @if($previewUrl)
                                        <img src="{{ $previewUrl }}" class="h-24 object-cover rounded-xl border border-surface-container">
                                    @else
                                        <span class="text-error text-xs">Error cargando vista previa</span>
                                    @endif
                                </div>
                            @endif
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
                        
                        <div class="bg-surface-container px-4 py-4 sm:px-6 sm:flex sm:flex-row-reverse -mx-4 -mb-4 mt-6 rounded-b-3xl">
                            <button type="submit" class="w-full inline-flex justify-center rounded-full border border-transparent shadow-sm px-6 py-2.5 bg-primary font-label-md text-label-md text-on-primary hover:bg-primary-container focus:outline-none transition-colors sm:ml-3 sm:w-auto">
                                Guardar Información
                            </button>
                            <button type="button" wire:click="$set('showModal', false)" class="mt-3 w-full inline-flex justify-center rounded-full border border-surface-container shadow-sm px-6 py-2.5 bg-surface-container-lowest font-label-md text-label-md text-on-surface-variant hover:text-on-surface hover:bg-surface-container-low focus:outline-none transition-colors sm:mt-0 sm:ml-3 sm:w-auto">
                                Cancelar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
