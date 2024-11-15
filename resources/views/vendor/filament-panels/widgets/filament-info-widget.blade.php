<x-filament-widgets::widget class="fi-filament-info-widget">
    <x-filament::section>
        <div x-data="{ darkMode: document.documentElement.classList.contains('dark') }" class="flex items-center gap-x-3 py-3">
            <div class="flex-1">
                <a href="" rel="noopener noreferrer" target="_blank">
                    <template x-if="darkMode">
                        <!-- Gambar untuk mode gelap -->
                        <img src="{{ asset('images/cjip-white.png') }}" class="h-10" alt="Logo Mode Gelap">
                    </template>
                    <template x-if="!darkMode">
                        <!-- Gambar untuk mode terang -->
                        <img src="{{ asset('images/cjip-black.png') }}" class="h-10" alt="Logo Mode Terang">
                    </template>
                </a>
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
