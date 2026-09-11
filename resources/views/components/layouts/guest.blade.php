<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet"/>
        <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet"/>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            @layer base { 
                html, body { margin: 0; padding: 0; } 
                body { overscroll-behavior: none; } 
                main > :first-child { margin-top: 0 !important; }
                main > :last-child { margin-bottom: 0 !important; }
            } 
        </style>
    </head>
    <body class="bg-surface font-body-md text-on-surface flex flex-col min-h-screen antialiased selection:bg-secondary-container selection:text-on-secondary-container">
        
        <header class="w-full">
            <div class="h-20 max-w-[1280px] mx-auto px-margin-mobile md:px-margin flex items-center justify-between">
                <a href="/" wire:navigate class="flex items-center gap-space-sm group">
                    <div class="flex items-center justify-center w-8 h-8 bg-on-surface rounded-lg shadow-sm group-hover:scale-105 transition-transform">
                        <div class="w-3.5 h-3.5 bg-white rounded-full flex items-center justify-center">
                            <div class="w-1.5 h-1.5 bg-primary rounded-full"></div>
                        </div>
                    </div>
                    <span class="font-headline-sm text-headline-sm tracking-tight text-on-surface uppercase">Lumen<span class="font-normal text-on-surface">Lab</span></span>
                </a>
                <a href="/" wire:navigate class="inline-flex items-center gap-space-xs font-label-md text-label-md text-on-surface hover:text-on-surface-variant transition-colors">
                    <span class="material-symbols-outlined text-[18px]">arrow_back</span>
                    <span>Volver a la tienda</span>
                </a>
            </div>
        </header>

        <main class="flex-1 flex flex-col items-center justify-center w-full px-margin-mobile md:px-margin py-space-xl">
            {{ $slot }}
        </main>

        <footer class="w-full mt-auto mb-8">
            <div class="max-w-[1280px] mx-auto px-margin-mobile md:px-margin flex flex-col md:flex-row items-center justify-between gap-space-md text-center md:text-left">
                <p class="font-body-sm text-body-sm text-on-surface-variant">© {{ date('Y') }} Lumen Lab. Cuidado y precisión biotecnológica. Todos los derechos reservados.</p>
                <div class="flex items-center flex-wrap justify-center gap-space-lg font-body-sm text-body-sm text-on-surface-variant">
                    <a href="#" class="hover:text-on-surface transition-colors">Privacidad</a>
                    <a href="#" class="hover:text-on-surface transition-colors">Términos y condiciones</a>
                    <a href="#" class="hover:text-on-surface transition-colors">Atención al cliente</a>
                </div>
            </div>
        </footer>
    </body>
</html>
