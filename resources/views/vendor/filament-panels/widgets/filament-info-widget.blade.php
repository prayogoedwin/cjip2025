<x-filament-widgets::widget class="fi-filament-info-widget">
    <x-filament::section>
        <div class="flex items-center gap-x-3 py-3">
            <div class="flex-1">
                <a href="/" rel="noopener noreferrer" target="_blank">
                    <h5 class="font-semibold" style="color: orange">Central Java Investment Platform</h5>
                </a>
                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                    v3.0
                </p>
            </div>

            <div class="flex flex-col items-end gap-y-1">
                <x-filament::link color="gray" href="#" icon="heroicon-m-book-open"
                    icon-alias="panels::widgets.filament-info.open-documentation-button" rel="noopener noreferrer"
                    target="_blank">
                    {{ __('filament-panels::widgets/filament-info-widget.actions.open_documentation.label') }}
                </x-filament::link>
            </div>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
