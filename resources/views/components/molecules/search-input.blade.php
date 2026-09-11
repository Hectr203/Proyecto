@props(['placeholder' => 'Buscar...'])

<div class="relative w-full">
    <span class="material-symbols-outlined absolute left-4 top-1/2 transform -translate-y-1/2 text-on-surface-variant text-[20px] pointer-events-none">search</span>
    <input {{ $attributes->merge(['class' => 'w-full pl-11 pr-4 py-2.5 bg-surface-container-lowest border border-surface-container rounded-full text-on-surface focus:border-primary focus:ring focus:ring-primary/20 shadow-sm font-body-md placeholder:text-on-surface-variant transition-all']) }} type="text" placeholder="{{ $placeholder }}">
</div>
