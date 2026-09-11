<x-layouts.app>
    <x-slot name="header">
        <h2 class="font-headline-lg text-headline-lg text-on-surface tracking-tight">
            {{ __('Mi Perfil') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-surface min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-8">
            <livewire:modules.profile.components.update-profile-information-form />
            <livewire:modules.profile.components.update-password-form />
            <livewire:modules.profile.components.delete-user-form />
        </div>
    </div>
</x-layouts.app>
