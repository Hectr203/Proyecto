@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-label-md text-label-md text-on-surface-variant mb-1']) }}>
    {{ $value ?? $slot }}
</label>
