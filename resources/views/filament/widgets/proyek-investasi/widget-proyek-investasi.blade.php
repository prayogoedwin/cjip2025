<x-filament-widgets::widget>
    <x-filament::section collapsible icon="heroicon-o-squares-2x2" icon-color="primary">
        <x-slot name="heading">
            Proyek Investasi
        </x-slot>
        <div>
            @livewire(\App\Filament\Widgets\ProyekInvestasi\StatsProyekInvestasi::class)
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
