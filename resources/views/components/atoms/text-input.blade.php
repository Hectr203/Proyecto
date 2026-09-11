@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'bg-surface-container-low border-surface-container text-on-surface focus:border-primary focus:ring-primary rounded-xl font-body-md shadow-sm placeholder:text-on-surface-variant transition-colors']) }}>
