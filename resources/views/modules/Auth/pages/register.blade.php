<div>
    <div class="flex flex-col w-full items-center justify-center py-space-sm md:py-space-lg">
        <div class="w-full max-w-6xl bg-surface-container-lowest rounded-xl shadow-xl overflow-hidden flex flex-col lg:flex-row relative">
            <!-- Lado Izquierdo: Visual Editorial & Bienvenida -->
            <div class="relative w-full lg:w-[48%] min-h-[460px] lg:min-h-[720px] flex flex-col justify-between p-space-md md:p-space-xl overflow-hidden bg-surface-container">
                <!-- Background Image -->
                <img src="{{ asset('images/auth-bg.jpg') }}" alt="Lumen Lab Lifestyle" class="absolute inset-0 w-full h-full object-cover object-center transition-transform duration-700 hover:scale-105" />
                <!-- Ambient Gradient Scrims -->
                <div class="absolute inset-0 bg-gradient-to-b from-on-surface/30 via-transparent to-on-surface/85"></div>
                
                <!-- Top Tag: Welcome Badge Glassmorphic -->
                <div class="relative z-10 self-start">
                    <div class="inline-flex items-center gap-space-xs px-3.5 py-1.5 rounded-full bg-surface-container-lowest/80 backdrop-blur-md shadow-sm">
                        <span class="w-2 h-2 rounded-full bg-primary-container animate-pulse"></span>
                        <span class="font-label-promotional text-label-promotional uppercase tracking-wider text-primary">Círculo Lumen</span>
                    </div>
                </div>
                
                <!-- Center / Bottom Floating Benefits Card & Quote -->
                <div class="relative z-10 flex flex-col gap-space-md">
                    <!-- Floating Promo Benefit Capsule -->
                    <div class="p-space-md rounded-xl bg-surface-container-lowest/85 backdrop-blur-xl shadow-lg transition-all duration-300 hover:bg-surface-container-lowest/95">
                        <div class="flex items-start gap-space-sm">
                            <div class="p-2 rounded-full bg-primary-fixed text-primary flex items-center justify-center shrink-0">
                                <span class="material-symbols-outlined text-[20px]" style="font-variation-settings: 'FILL' 1;">spa</span>
                            </div>
                            <div class="flex flex-col">
                                <span class="font-label-md text-label-md text-on-surface">Bienvenida a la comunidad</span>
                                <p class="font-body-sm text-body-sm text-on-surface-variant mt-0.5">
                                    Únete al Círculo Lumen • Obtén <strong class="text-primary font-semibold">20% OFF</strong> en tu primer drop con el código <span class="px-1.5 py-0.5 rounded bg-surface-container text-on-surface font-mono text-[11px] font-semibold">VIBRANT20</span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- Inspiring Quote -->
                    <div class="px-space-xs">
                        <p class="font-headline-sm text-headline-sm text-surface-container-lowest font-medium leading-snug drop-shadow-sm">
                            “La verdadera vitalidad despierta cuando la ciencia celular se funde con el ritmo sereno de tu día a día.”
                        </p>
                        <div class="flex items-center gap-space-xs mt-space-xs text-primary-fixed-dim">
                            <span class="material-symbols-outlined text-[16px]">verified</span>
                            <span class="font-label-sm text-label-sm tracking-wide uppercase">Dra. Elena Vega • Directora de Innovación Botánica</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Lado Derecho: Formulario de Registro -->
            <div x-data="passwordStrengthMeter()" class="w-full lg:w-[52%] p-space-lg md:p-space-xl flex flex-col justify-center bg-surface-container-lowest">
                <div class="max-w-md w-full mx-auto flex flex-col">
                    
                    <!-- Header del Formulario -->
                    <div class="mb-space-lg">
                        <div class="inline-flex items-center gap-1 text-tertiary mb-space-xs">
                            <span class="material-symbols-outlined text-[16px]">auto_awesome</span>
                            <span class="font-label-promotional text-label-promotional uppercase">Comienza tu viaje</span>
                        </div>
                        <h1 class="font-headline-lg text-headline-lg text-on-surface font-bold tracking-tight">
                            Comienza tu ritual de vitalidad
                        </h1>
                        <p class="font-body-md text-body-md text-on-surface-variant mt-space-xs">
                            Crea tu cuenta en segundos para disfrutar de fórmulas botánicas y herramientas de recuperación personalizadas.
                        </p>
                    </div>

                    <!-- Registration Form -->
                    <form wire:submit="register" class="flex flex-col gap-space-md" id="registerForm">
                        
                        <!-- Name Row -->
                        <div class="flex flex-col gap-1.5">
                            <label class="font-label-md text-label-md text-on-surface" for="name">Nombre Completo</label>
                            <input wire:model="name" id="name" type="text" required autofocus autocomplete="name" class="w-full py-4 px-4 bg-surface-container-low border-none focus:ring-0 text-on-surface placeholder:text-outline/70 rounded-xl text-body-md font-body-md focus:bg-surface-container-lowest focus:ring-2 focus:ring-primary-container/40 transition-all duration-200" placeholder="Sofia Alonso" />
                            <x-atoms.input-error :messages="$errors->get('name')" class="mt-1" />
                        </div>
                        
                        <!-- Email Field -->
                        <div class="flex flex-col gap-1.5">
                            <label class="font-label-md text-label-md text-on-surface" for="email">Correo Electrónico</label>
                            <div class="relative flex items-center">
                                <span class="material-symbols-outlined absolute left-4 text-[20px] text-outline z-10 pointer-events-none">alternate_email</span>
                                <input wire:model="email" id="email" type="email" required autocomplete="username" class="w-full py-4 pl-12 pr-4 border-none focus:ring-0 bg-surface-container-low text-on-surface placeholder:text-outline/70 rounded-xl text-body-md font-body-md focus:bg-surface-container-lowest focus:ring-2 focus:ring-primary-container/40 transition-all duration-200" placeholder="sofia@lumenlab.bio" />
                            </div>
                            <x-atoms.input-error :messages="$errors->get('email')" class="mt-1" />
                        </div>
                        
                        <!-- Password Field with AlpineJS for strength & toggle -->
                        <div class="flex flex-col gap-1.5">
                            <div class="flex items-center justify-between">
                                <label class="font-label-md text-label-md text-on-surface" for="password">Contraseña</label>
                                <span class="font-label-sm text-label-sm" :class="strengthTextClass()" x-text="getStrengthText()">Mínimo 8 caracteres</span>
                            </div>
                            <div class="relative flex items-center">
                                <span class="material-symbols-outlined absolute left-4 text-[20px] text-outline z-10 pointer-events-none">lock_open</span>
                                <input wire:model="password" id="password" :type="show ? 'text' : 'password'" x-model="pwdValue" required autocomplete="new-password" class="w-full py-4 pl-12 pr-12 border-none focus:ring-0 bg-surface-container-low text-on-surface placeholder:text-outline/70 rounded-xl text-body-md font-body-md focus:bg-surface-container-lowest focus:ring-2 focus:ring-primary-container/40 transition-all duration-200 tracking-wide" placeholder="••••••••" />
                                <button @click="show = !show" type="button" aria-label="Mostrar u ocultar contraseña" class="absolute right-3 z-10 text-outline hover:text-on-surface transition-colors p-2 rounded-full flex items-center justify-center focus:outline-none">
                                    <span class="material-symbols-outlined text-[20px]" x-text="show ? 'visibility_off' : 'visibility'">visibility</span>
                                </button>
                            </div>
                            <x-atoms.input-error :messages="$errors->get('password')" class="mt-1" />
                            
                            <!-- Strength Meter Interactive Indicator -->
                            <div class="grid grid-cols-4 gap-1.5 mt-1">
                                <div class="h-1 rounded-full transition-all duration-300" :class="bar1Class"></div>
                                <div class="h-1 rounded-full transition-all duration-300" :class="bar2Class"></div>
                                <div class="h-1 rounded-full transition-all duration-300" :class="bar3Class"></div>
                                <div class="h-1 rounded-full transition-all duration-300" :class="bar4Class"></div>
                            </div>
                        </div>

                        <!-- Confirm Password Field -->
                        <div class="flex flex-col gap-1.5">
                            <label class="font-label-md text-label-md text-on-surface" for="password_confirmation">Confirmar Contraseña</label>
                            <div class="relative flex items-center">
                                <span class="material-symbols-outlined absolute left-4 text-[20px] text-outline z-10 pointer-events-none">lock</span>
                                <input wire:model="password_confirmation" id="password_confirmation" :type="show ? 'text' : 'password'" required autocomplete="new-password" class="w-full py-4 pl-12 pr-4 border-none focus:ring-0 bg-surface-container-low text-on-surface placeholder:text-outline/70 rounded-xl text-body-md font-body-md focus:bg-surface-container-lowest focus:ring-2 focus:ring-primary-container/40 transition-all duration-200 tracking-wide" placeholder="••••••••" />
                            </div>
                            <x-atoms.input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
                        </div>
                        
                        <!-- Newsletter Checkbox -->
                        <div class="flex items-start gap-3 pt-1">
                            <input type="checkbox" id="newsletter" checked class="mt-0.5 w-4 h-4 rounded text-primary border-outline/30 focus:ring-0 bg-surface-container-low accent-primary cursor-pointer" />
                            <label for="newsletter" class="font-body-sm text-body-sm text-on-surface-variant cursor-pointer select-none leading-tight">
                                Deseo recibir insights clínicos y acceso prioritario a drops exclusivos.
                            </label>
                        </div>
                        
                        <!-- Terms & Privacy Disclaimers -->
                        <p class="font-body-sm text-body-sm text-on-surface-variant leading-tight">
                            Al registrarte aceptas los 
                            <a href="#" class="underline hover:text-primary transition-colors">Términos de Servicio</a> 
                            y la 
                            <a href="#" class="underline hover:text-primary transition-colors">Política de Privacidad</a> de Lumen Lab.
                        </p>
                        
                        <!-- Primary Submit Button -->
                        <button type="submit" class="w-full py-4 mt-4 rounded-full bg-primary-container hover:bg-primary text-on-primary font-headline-sm text-headline-sm flex items-center justify-center gap-2 shadow-md hover:shadow-lg transition-all duration-200 active:scale-[0.99] group cursor-pointer">
                            <span>Crear mi Cuenta</span>
                            <span class="material-symbols-outlined text-[20px] transition-transform duration-200 group-hover:translate-x-1">east</span>
                        </button>
                    </form>
                    
                    <!-- Form Footer: Switch to Login -->
                    <div class="mt-space-lg text-center pt-space-md border-t border-surface-container">
                        <p class="font-body-md text-body-md text-on-surface-variant">
                            ¿Ya tienes cuenta en Lumen? 
                            <a href="{{ route('login') }}" wire:navigate class="font-semibold text-primary hover:text-on-primary-fixed-variant transition-colors ml-1 inline-flex items-center gap-0.5">
                                <span>Iniciar sesión</span>
                                <span class="material-symbols-outlined text-[14px]">arrow_outward</span>
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('passwordStrengthMeter', () => ({
            pwdValue: '',
            show: false,
            get score() {
                let s = 0;
                const val = this.pwdValue;
                if (val.length >= 8) s++;
                if (/[A-Z]/.test(val) && /[a-z]/.test(val)) s++;
                if (/\d/.test(val)) s++;
                if (/[^A-Za-z0-9]/.test(val)) s++;
                return s;
            },
            getStrengthText() {
                if (this.pwdValue.length === 0) return 'Mínimo 8 caracteres';
                switch(this.score) {
                    case 1: return 'Seguridad leve';
                    case 2: return 'Seguridad moderada';
                    case 3: return 'Buena seguridad';
                    default: return this.score >= 4 ? 'Contraseña excelente' : 'Mínimo 8 caracteres';
                }
            },
            strengthTextClass() {
                const base = 'font-label-sm text-label-sm transition-colors ';
                if (this.pwdValue.length === 0) return base + 'text-outline';
                switch(this.score) {
                    case 1: return base + 'text-secondary';
                    case 2: return base + 'text-primary';
                    case 3: return base + 'text-tertiary';
                    default: return this.score >= 4 ? base + 'text-tertiary font-bold' : base + 'text-outline';
                }
            },
            get bar1Class() {
                if (this.pwdValue.length === 0) return 'bg-surface-variant';
                if (this.score === 1) return 'bg-secondary';
                if (this.score === 2) return 'bg-primary-container';
                if (this.score >= 3) return 'bg-tertiary-container';
                return 'bg-tertiary';
            },
            get bar2Class() {
                if (this.pwdValue.length === 0 || this.score < 2) return 'bg-surface-variant';
                if (this.score === 2) return 'bg-primary-container';
                if (this.score >= 3) return 'bg-tertiary-container';
                return 'bg-tertiary';
            },
            get bar3Class() {
                if (this.pwdValue.length === 0 || this.score < 3) return 'bg-surface-variant';
                return 'bg-tertiary-container';
            },
            get bar4Class() {
                if (this.pwdValue.length === 0 || this.score < 4) return 'bg-surface-variant';
                return 'bg-tertiary';
            }
        }));
    });
</script>
