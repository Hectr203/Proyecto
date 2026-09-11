<div class="p-6 bg-surface min-h-screen">
    <div class="flex justify-between items-center mb-6">
        <h2 class="font-headline-lg text-headline-lg text-on-surface tracking-tight">Gestión de Categorías</h2>
    </div>

    @if (session()->has('message'))
        <div class="p-4 mb-4 text-sm font-label-md text-on-tertiary-fixed-variant bg-tertiary-fixed rounded-xl border border-tertiary-fixed-dim">
            {{ session('message') }}
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Formulario -->
        <div class="md:col-span-1">
            <div class="bg-surface-container-lowest p-6 rounded-3xl shadow-sm border border-surface-container">
                <h3 class="font-headline-sm text-headline-sm text-on-surface mb-6 flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-primary-container"></span>
                    Nueva Categoría
                </h3>
                <form wire:submit.prevent="save">
                    <div class="mb-6">
                        <x-atoms.input-label>Nombre de Categoría</x-atoms.input-label>
                        <x-atoms.text-input type="text" wire:model="name" class="mt-1 block w-full" />
                        @error('name') <span class="text-error text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>
                    <button type="submit" class="w-full h-11 rounded-full bg-primary text-on-primary hover:bg-primary-container hover:text-on-primary-container font-label-md text-label-md transition-all active:scale-95 flex items-center justify-center shadow-sm">
                        Guardar Categoría
                    </button>
                </form>
            </div>
        </div>

        <!-- Lista -->
        <div class="md:col-span-2">
            <div class="bg-surface-container-lowest rounded-2xl shadow-sm border border-surface-container overflow-hidden">
                <table class="min-w-full divide-y divide-surface-container">
                    <thead class="bg-surface-container-low">
                        <tr>
                            <th class="px-6 py-3 text-left font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider">ID</th>
                            <th class="px-6 py-3 text-left font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider">Nombre</th>
                            <th class="px-6 py-3 text-right font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-surface-container-lowest divide-y divide-surface-container">
                        @forelse($categories as $category)
                        <tr class="hover:bg-surface transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap font-body-sm text-body-sm text-on-surface-variant">{{ $category->id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap font-body-sm text-body-sm text-on-surface font-semibold">{{ $category->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-right font-label-sm text-label-sm font-medium">
                                <button wire:click="delete({{ $category->id }})" wire:confirm="¿Estás seguro de eliminar esta categoría?" class="text-error hover:text-error-container transition-colors">Eliminar</button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="px-6 py-8 text-center font-body-md text-on-surface-variant">No hay categorías registradas.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
