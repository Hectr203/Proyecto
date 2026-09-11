@props(['show' => false, 'title' => '', 'onClose' => null])

@if($show)
<div class="fixed z-50 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-on-background/60 backdrop-blur-sm transition-opacity" aria-hidden="true"></div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-flex flex-col align-bottom bg-surface-container-lowest rounded-3xl text-left shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full border border-surface-container border-opacity-50 max-h-[90vh]">
            <div class="bg-surface-container-lowest px-4 pt-5 pb-4 sm:p-6 sm:pb-4 overflow-y-auto flex-1 rounded-3xl">
                @if($title)
                <div class="flex items-center justify-between mb-6">
                    <h3 class="font-headline-sm text-headline-sm text-on-surface flex items-center gap-2" id="modal-title">
                        <span class="w-2 h-2 rounded-full bg-primary-container"></span>
                        {{ $title }}
                    </h3>
                    @if($onClose)
                    <button type="button" wire:click="{{ $onClose }}" class="text-on-surface-variant hover:text-on-surface transition-colors focus:outline-none p-1.5 rounded-full hover:bg-surface-container-high active:scale-95">
                        <span class="material-symbols-outlined text-[20px] leading-none">close</span>
                    </button>
                    @endif
                </div>
                @endif
                {{ $slot }}
            </div>
        </div>
    </div>
</div>
@endif
