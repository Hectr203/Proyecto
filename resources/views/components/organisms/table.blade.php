<div class="overflow-x-auto bg-surface-container-lowest rounded-2xl shadow-sm border border-surface-container">
    <table class="w-full text-left border-collapse">
        <thead>
            <tr class="border-b border-surface-container bg-surface-container-low/50">
                {{ $head }}
            </tr>
        </thead>
        <tbody class="divide-y divide-surface-container">
            {{ $slot }}
        </tbody>
    </table>
</div>
