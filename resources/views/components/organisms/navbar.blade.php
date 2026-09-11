<?php

use App\Core\Auth\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component
{
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}; ?>

<div class="fixed top-space-md left-0 right-0 z-50 px-margin-mobile md:px-margin pointer-events-none">
    <nav x-data="{ open: false }" class="pointer-events-auto relative w-full bg-surface/80 backdrop-blur-xl shadow-[0_8px_30px_rgb(0,0,0,0.08),inset_0_1px_0_0_rgba(255,255,255,0.9)] border border-white/60 rounded-full transition-all duration-300">
        <!-- Primary Navigation Menu -->
        <div class="px-space-md md:px-space-lg flex items-center justify-between gap-space-lg h-16 md:h-20">
        <div class="flex items-center gap-space-md">
            <a href="{{ route('dashboard') }}" wire:navigate class="flex items-center gap-space-md group">
                <!-- Isotipo Lumen -->
                <div class="flex items-center justify-center w-8 h-8 bg-on-surface rounded-lg shadow-sm group-hover:scale-105 transition-transform">
                    <div class="w-3.5 h-3.5 bg-white rounded-full flex items-center justify-center">
                        <div class="w-1.5 h-1.5 bg-primary rounded-full"></div>
                    </div>
                </div>
                <!-- Logotipo -->
                <span class="font-headline-sm text-headline-sm tracking-tight text-on-surface uppercase">Lumen<span class="text-primary font-normal">Lab</span></span>
            </a>
        </div>

        <!-- Navigation Links (Desktop) -->
        <nav class="hidden xl:flex items-center gap-space-xs p-1 rounded-full bg-surface-container-low/60 backdrop-blur-md">
            <a href="{{ route('dashboard') }}" wire:navigate class="px-space-md py-space-xs transition-all rounded-full font-label-md text-label-md {{ request()->routeIs('dashboard') ? 'bg-surface-container-lowest shadow-sm text-on-surface font-semibold' : 'text-on-surface-variant hover:text-on-surface' }}">
                Dashboard
            </a>
            @if(auth()->check() && auth()->user()->role === 'super_admin')
                <a href="{{ route('admin.products') }}" wire:navigate class="px-space-md py-space-xs transition-all rounded-full font-label-md text-label-md {{ request()->routeIs('admin.products') ? 'bg-surface-container-lowest shadow-sm text-on-surface font-semibold' : 'text-on-surface-variant hover:text-on-surface' }}">
                    Productos
                </a>
                <a href="{{ route('admin.categories') }}" wire:navigate class="px-space-md py-space-xs transition-all rounded-full font-label-md text-label-md {{ request()->routeIs('admin.categories') ? 'bg-surface-container-lowest shadow-sm text-on-surface font-semibold' : 'text-on-surface-variant hover:text-on-surface' }}">
                    Categorías
                </a>
                <a href="{{ route('admin.reports') }}" wire:navigate class="px-space-md py-space-xs transition-all rounded-full font-label-md text-label-md {{ request()->routeIs('admin.reports') ? 'bg-surface-container-lowest shadow-sm text-on-surface font-semibold' : 'text-on-surface-variant hover:text-on-surface' }}">
                    Reportes
                </a>
            @endif
        </nav>

        <!-- Right Side Icons & Auth -->
        <div class="flex items-center gap-space-md">
            <!-- Search Bar -->
            <form action="{{ route('dashboard') }}" method="GET" class="hidden md:flex items-center gap-space-sm bg-surface-container-low px-space-md py-space-xs rounded-full shadow-[inset_0_1px_0_0_rgba(255,255,255,0.9)]">
                <span class="material-symbols-outlined text-on-surface-variant text-[18px]">search</span>
                <input name="search" class="bg-transparent text-on-surface placeholder:text-on-surface-variant font-body-sm text-body-sm focus:outline-none w-44 lg:w-56 border-0 focus:ring-0" placeholder="Buscar productos..." type="text" value="{{ request('search') }}">
                <button type="submit" class="hidden"></button>
            </form>

            <div class="w-px h-6 bg-surface-container mx-1 hidden md:block"></div>

            <!-- Icons -->
            <div class="flex items-center gap-space-sm">
                
                <livewire:modules.client.cart.cart-widget />

                @auth
                    <!-- Settings Dropdown Desktop -->
                    <div class="hidden sm:flex pl-space-xs">
                        <x-molecules.dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button class="flex items-center gap-2 p-1 rounded-full hover:bg-surface-container-low transition-colors focus:outline-none relative">
                                    <div class="w-8 h-8 rounded-full bg-secondary-container flex items-center justify-center text-on-secondary-container font-label-sm font-bold uppercase overflow-hidden ring-1 ring-surface-container-high">
                                        <!-- Simulando avatar de imagen -->
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=fdbdb3&color=794943" alt="Avatar" class="w-full h-full object-cover">
                                    </div>
                                    <!-- Online Status Dot -->
                                    <div class="absolute bottom-1 right-1 w-2.5 h-2.5 bg-tertiary rounded-full ring-2 ring-white"></div>
                                </button>
                            </x-slot>
                            <x-slot name="content">
                                <div class="px-4 py-2 border-b border-surface-container">
                                    <div class="font-medium text-sm text-on-surface" x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name" x-on:profile-updated.window="name = $event.detail.name"></div>
                                    <div class="font-medium text-xs text-on-surface-variant">{{ auth()->user()->email }}</div>
                                </div>
                                <x-atoms.dropdown-link :href="route('profile')" wire:navigate>
                                    Perfil
                                </x-atoms.dropdown-link>
                                <button wire:click="logout" class="block w-full px-4 py-2 text-start font-label-md text-label-md text-on-surface hover:bg-surface-container-low focus:outline-none focus:bg-surface-container-low transition duration-150 ease-in-out cursor-pointer">
                                    Cerrar sesión
                                </button>
                            </x-slot>
                        </x-molecules.dropdown>
                    </div>
                @else
                    <div class="hidden sm:flex sm:items-center gap-space-sm pl-space-xs">
                        <a href="{{ route('login') }}" wire:navigate class="relative group p-1.5 rounded-full hover:bg-surface-container-low text-on-surface-variant hover:text-on-surface transition-colors focus:outline-none flex items-center justify-center" aria-label="Login">
                            <span class="material-symbols-outlined text-[24px]">account_circle</span>
                        </a>
                    </div>
                @endauth
                
                <!-- Hamburger -->
                <div class="flex items-center sm:hidden pl-space-xs">
                    <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-on-surface-variant hover:text-on-surface hover:bg-surface-container-high focus:outline-none transition-colors">
                        <span class="material-symbols-outlined text-[24px]" x-show="!open">menu</span>
                        <span class="material-symbols-outlined text-[24px]" x-show="open" style="display: none;">close</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-surface/90 backdrop-blur-xl border border-white/60 absolute top-[4.5rem] md:top-[5.5rem] left-0 right-0 shadow-lg rounded-2xl overflow-hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-atoms.responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" wire:navigate>
                {{ __('Dashboard') }}
            </x-atoms.responsive-nav-link>

            @if(auth()->check() && auth()->user()->role === 'super_admin')
                <x-atoms.responsive-nav-link :href="route('admin.products')" :active="request()->routeIs('admin.products')" wire:navigate>
                    Productos
                </x-atoms.responsive-nav-link>
                <x-atoms.responsive-nav-link :href="route('admin.categories')" :active="request()->routeIs('admin.categories')" wire:navigate>
                    Categorías
                </x-atoms.responsive-nav-link>
                <x-atoms.responsive-nav-link :href="route('admin.reports')" :active="request()->routeIs('admin.reports')" wire:navigate>
                    Reportes
                </x-atoms.responsive-nav-link>
            @endif
        </div>

        @auth
        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-surface-container">
            <div class="px-4">
                <div class="font-medium text-base text-on-surface" x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name" x-on:profile-updated.window="name = $event.detail.name"></div>
                <div class="font-medium text-sm text-on-surface-variant">{{ auth()->user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-atoms.responsive-nav-link :href="route('profile')" wire:navigate>
                    Perfil
                </x-atoms.responsive-nav-link>

                <!-- Authentication -->
                <button wire:click="logout" class="block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-on-surface-variant hover:text-on-surface hover:bg-surface-container hover:border-surface-variant focus:outline-none focus:text-on-surface focus:bg-surface-container focus:border-surface-variant transition duration-150 ease-in-out cursor-pointer">
                    Cerrar sesión
                </button>
            </div>
        </div>
        @else
        <div class="pt-4 pb-1 border-t border-surface-container">
            <div class="mt-3 space-y-1 px-4 flex flex-col gap-2 mb-4">
                <a href="{{ route('login') }}" class="block px-4 py-2 text-center rounded-md font-label-md text-label-md bg-surface-container-high text-on-surface hover:bg-surface-container-highest transition-colors">Log in</a>
                <a href="{{ route('register') }}" class="block px-4 py-2 text-center rounded-md font-label-md text-label-md bg-primary hover:bg-primary-container text-on-primary hover:text-on-primary-container transition-colors shadow-sm">Register</a>
            </div>
        </div>
        @endauth
    </div>
    </nav>
</div>
