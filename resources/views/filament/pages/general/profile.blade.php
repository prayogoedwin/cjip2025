<x-filament-panels::page>
    {{-- <x-filament::card> --}}
    <form wire:submit.prevent="submit">
        {{ $this->form }}
        <div class="py-5">
            {{-- <button class="bg-primary-500 text-white py-2  rounded-lg hover:bg-primary-600" type="submit">
                    Simpan
                </button> --}}
            <x-filament::button size="lg" type="submit" icon-position="before">
                Simpan
            </x-filament::button>
        </div>
    </form>
    {{-- </x-filament::card> --}}
</x-filament-panels::page>
    