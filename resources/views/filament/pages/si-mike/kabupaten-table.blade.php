<x-filament-panels::page>
    <x-filament::section collapsible icon="heroicon-o-magnifying-glass" icon-color="primary">
        <x-slot name="heading">
            Filter Rekap Kabupaten/Kota
        </x-slot>
        <form wire:submit.prevent="submit">
            {{ $this->form }}
            <div class="mt-5">
                <x-filament::button wire:click="submit" class="mt-3" icon="heroicon-m-magnifying-glass">
                    Filter
                </x-filament::button>
            </div>
        </form>
    </x-filament::section>
</x-filament-panels::page>
