<div>
    <div class="flex flex-col w-full items-center justify-center py-space-sm md:py-space-lg">
        <div class="w-full max-w-6xl bg-surface-container-lowest rounded-xl shadow-xl overflow-hidden flex flex-col lg:flex-row relative">
            
            <!-- Lado Izquierdo: Visual Editorial & Bienvenida -->
            <div class="relative w-full lg:w-[48%] min-h-[460px] lg:min-h-[720px] flex flex-col justify-between p-space-md md:p-space-xl overflow-hidden bg-surface-container">
                <!-- Background Editorial Image -->
                <img alt="Lumen Lab Lifestyle" class="absolute inset-0 w-full h-full object-cover object-center scale-100 hover:scale-105 transition-transform duration-700 ease-out" src="{{ asset('images/auth-bg.jpg') }}"/>
                
                <!-- Warm editorial gradient scrim -->
                <div class="absolute inset-0 bg-gradient-to-t from-inverse-surface/80 via-inverse-surface/25 to-transparent"></div>
                <div class="absolute inset-0 bg-primary/10 mix-blend-soft-light"></div>
                
                <!-- Top Floating Micro Badge -->
                <div class="relative z-10 self-start flex justify-between items-start w-full">
                    <div class="inline-flex items-center gap-space-xs px-space-md py-1.5 rounded-full bg-surface-container-lowest/80 backdrop-blur-md shadow-sm">
                        <span class="w-2 h-2 rounded-full bg-primary-container animate-pulse"></span>
                        <span class="font-label-sm text-label-sm tracking-wider uppercase text-on-surface font-semibold">Ritual de Luz</span>
                    </div>
                    <div class="w-8 h-8 rounded-full bg-surface-container-lowest/70 backdrop-blur-md flex items-center justify-center text-on-surface">
                        <span class="material-symbols-outlined text-[16px] text-primary">spa</span>
                    </div>
                </div>
                
                <!-- Bottom Quote & Community Micro-card -->
                <div class="relative z-10 flex flex-col gap-space-md mt-auto pt-space-xl">
                    <!-- Glass Quote Plaque -->
                    <div class="bg-surface-container-lowest/85 backdrop-blur-xl p-space-md rounded-lg shadow-md flex flex-col gap-space-xs">
                        <div class="flex items-center gap-1 text-primary">
                            <span class="material-symbols-outlined text-[16px]" style="font-variation-settings: 'FILL' 1;">star</span>
                            <span class="material-symbols-outlined text-[16px]" style="font-variation-settings: 'FILL' 1;">star</span>
                            <span class="material-symbols-outlined text-[16px]" style="font-variation-settings: 'FILL' 1;">star</span>
                            <span class="material-symbols-outlined text-[16px]" style="font-variation-settings: 'FILL' 1;">star</span>
                            <span class="material-symbols-outlined text-[16px]" style="font-variation-settings: 'FILL' 1;">star</span>
                            <span class="font-label-sm text-label-sm text-on-surface-variant ml-1 font-semibold">5.0</span>
                        </div>
                        <p class="font-headline-sm text-headline-sm text-on-surface leading-snug font-semibold">
                            “Despierta tu vitalidad natural cada día con rituales botánicos y tecnología cinética.”
                        </p>
                        <div class="flex items-center gap-2 pt-1">
                            <div class="flex -space-x-1.5 overflow-hidden">
                                <div class="inline-block h-5 w-5 rounded-full bg-tertiary-fixed ring-2 ring-surface-container-lowest flex items-center justify-center text-[9px] font-bold text-on-tertiary-container">CL</div>
                                <div class="inline-block h-5 w-5 rounded-full bg-secondary-fixed ring-2 ring-surface-container-lowest flex items-center justify-center text-[9px] font-bold text-on-secondary-fixed">MR</div>
                                <div class="inline-block h-5 w-5 rounded-full bg-primary-fixed ring-2 ring-surface-container-lowest flex items-center justify-center text-[9px] font-bold text-on-primary-fixed">+15k</div>
                            </div>
                            <span class="font-label-sm text-label-sm text-on-surface-variant font-medium">Comunidad Lumen • +15,000 miembros</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Lado Derecho: Formulario de Login -->
            <div class="w-full lg:w-[52%] p-space-xl flex flex-col justify-center bg-surface-container-lowest">
                <div class="max-w-md w-full mx-auto flex flex-col gap-space-lg">
                    
                    <!-- Friendly Header Intro -->
                    <div class="flex flex-col gap-space-xs">
                        <div class="inline-flex items-center gap-2">
                            <span class="font-label-promotional text-label-promotional uppercase text-primary tracking-widest">Portal Exclusivo</span>
                            <span class="h-1.5 w-1.5 rounded-full bg-primary"></span>
                        </div>
                        <h1 class="font-headline-lg text-headline-lg text-on-surface tracking-tight">
                            Bienvenido de nuevo a Lumen Lab
                        </h1>
                        <p class="font-body-md text-body-md text-on-surface-variant leading-relaxed">
                            Inicia sesión para continuar tu ritual de bienestar y acceder a tus drops exclusivos.
                        </p>
                    </div>
                    
                    <x-molecules.auth-session-status class="mb-4" :status="session('status')" />

                    <!-- Login Form -->
                    <form wire:submit="login" class="flex flex-col gap-space-md" id="lumen-login-form">
                        <!-- Email Field -->
                        <div class="flex flex-col gap-2">
                            <label for="email" class="font-label-md text-label-md text-on-surface ml-1">
                                Correo electrónico
                            </label>
                            <div class="relative flex items-center">
                                <span class="material-symbols-outlined absolute left-4 text-[20px] text-outline z-10 pointer-events-none">alternate_email</span>
                                <input wire:model="form.email" id="email" type="email" required autofocus autocomplete="username" class="w-full py-4 pl-12 pr-4 bg-surface-container-low border-none focus:ring-0 text-on-surface placeholder:text-outline/70 rounded-xl text-body-md font-body-md focus:outline-none focus:bg-surface-container-lowest focus:ring-2 focus:ring-primary-container/40 transition-all duration-200" placeholder="tu@email.com" />
                            </div>
                            <x-atoms.input-error :messages="$errors->get('form.email')" class="mt-1 ml-1" />
                        </div>

                        <!-- Password Field -->
                        <div class="flex flex-col gap-2" x-data="{ show: false }">
                            <label for="password" class="font-label-md text-label-md text-on-surface ml-1">
                                Contraseña
                            </label>
                            <div class="relative flex items-center">
                                <span class="material-symbols-outlined absolute left-4 text-[20px] text-outline z-10 pointer-events-none">lock_open</span>
                                <input wire:model="form.password" id="password" :type="show ? 'text' : 'password'" required autocomplete="current-password" class="w-full py-4 pl-12 pr-12 bg-surface-container-low border-none focus:ring-0 text-on-surface placeholder:text-outline/70 rounded-xl text-body-md font-body-md focus:outline-none focus:bg-surface-container-lowest focus:ring-2 focus:ring-primary-container/40 transition-all duration-200" placeholder="••••••••" />
                                <button @click="show = !show" type="button" aria-label="Alternar visibilidad de contraseña" class="absolute right-3 z-10 text-outline hover:text-on-surface transition-colors p-2 rounded-full flex items-center justify-center focus:outline-none">
                                    <span class="material-symbols-outlined text-[20px]" x-text="show ? 'visibility_off' : 'visibility'">visibility</span>
                                </button>
                            </div>
                            <x-atoms.input-error :messages="$errors->get('form.password')" class="mt-1 ml-1" />
                        </div>

                        <!-- Options Row: Remember & Forgot -->
                        <div class="flex items-center justify-between pt-2">
                            <label class="flex items-center gap-3 cursor-pointer select-none">
                                <input wire:model="form.remember" id="remember" type="checkbox" name="remember" class="w-5 h-5 rounded text-primary-container border-outline/30 focus:ring-0 focus:ring-offset-0 bg-surface-container-low accent-primary-container cursor-pointer" />
                                <span class="font-body-sm text-body-sm text-on-surface-variant">Recordar mi sesión</span>
                            </label>
                            @if (Route::has('password.request'))
                                <a data-path="forgot-password" href="{{ route('password.request') }}" wire:navigate class="font-label-sm text-label-sm font-semibold text-primary hover:text-primary-container transition-colors">
                                    ¿Olvidaste tu contraseña?
                                </a>
                            @endif
                        </div>

                        <!-- Submit CTA -->
                        <button type="submit" class="w-full py-4 mt-4 rounded-full bg-primary-container hover:bg-primary text-on-primary font-headline-sm text-headline-sm flex items-center justify-center gap-2 shadow-md hover:shadow-lg transition-all duration-200 active:scale-[0.99] group cursor-pointer">
                            <span>Iniciar Sesión</span>
                            <span class="material-symbols-outlined text-[20px] transition-transform duration-200 group-hover:translate-x-1">east</span>
                        </button>
                    </form>

                    <!-- Footer Switch Link -->
                    <div class="pt-6 border-t border-surface-container text-center mt-4">
                        <p class="font-body-md text-body-md text-on-surface-variant">
                            ¿No tienes una cuenta aún? 
                            <a data-path="register" href="{{ route('register') }}" wire:navigate class="font-semibold text-primary hover:text-primary-container transition-colors ml-1 inline-flex items-center gap-0.5">
                                Regístrate gratis
                                <span class="material-symbols-outlined text-[16px]">arrow_outward</span>
                            </a>
                        </p>
                    </div>
                    
                    <!-- Subtle Trust Metrics -->
                    <div class="pt-6 flex items-center justify-center gap-6 text-outline font-label-sm text-label-sm">
                        <div class="flex items-center gap-1.5">
                            <span class="material-symbols-outlined text-[16px] text-tertiary">verified_user</span>
                            <span>Cifrado clínico 256-bit</span>
                        </div>
                        <div class="h-1 w-1 rounded-full bg-outline-variant"></div>
                        <div class="flex items-center gap-1.5">
                            <span class="material-symbols-outlined text-[16px] text-tertiary">eco</span>
                            <span>100% Cuidado Consciente</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
