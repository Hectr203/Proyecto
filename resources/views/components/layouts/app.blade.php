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
        <style>
            @layer base { 
                html, body { margin: 0; padding: 0; } 
                body { overscroll-behavior: none; } 
            } 
            ::-webkit-scrollbar { display: none; }
        </style>
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <!-- TomSelect para Buscadores -->
        <link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>
        
        <!-- Chart.js para Gráficas -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    </head>
    <body class="bg-surface font-body-md text-on-surface antialiased selection:bg-secondary-container selection:text-on-secondary-container">
        <div class="min-h-screen flex flex-col">
            <livewire:organisms.navbar />
            
            <!-- Espaciador para compensar el navbar flotante -->
            <div class="h-32 shrink-0"></div>

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
        <x-organisms.footer />
        <livewire:modules.client.cart.cart />
        
        <script>
            document.addEventListener('livewire:init', () => {
                Livewire.on('toast', (event) => {
                    console.log('Toast Event Triggered!', event);
                    const data = Array.isArray(event) ? event[0] : event;
                    
                    if (!window.toast) {
                        console.error('Vanilla Sonner toast is not loaded on window.');
                        alert(data.message);
                        return;
                    }

                    if(data.type === 'success') {
                        window.toast.success(data.message);
                    } else if(data.type === 'error') {
                        window.toast.error(data.message);
                    } else {
                        window.toast.info(data.message);
                    }
                });
            });
        </script>
    </body>
</html>
