<x-filament::widget>
    <div class="relative py-5 mb-5">
        <div class="absolute inset-0 flex items-center" aria-hidden="true">
            <div class="w-full border-t border-gray-300"></div>
        </div>
        <div class="relative flex justify-center">
            <span class="px-4 bg-primary-500 rounded-lg text-md font-bold text-white uppercase">Dashboard Si-Mike</span>
        </div>
    </div>
    <x-filament::section collapsible collapsed icon="heroicon-o-magnifying-glass" icon-color="primary">
        <x-slot name="heading">
            Filter Dashboard Si-Mike
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

    <x-filament::section collapsible icon="heroicon-o-squares-2x2" icon-color="primary" class="mt-3 gap-x-2">
        <x-slot name="heading">
            Dashboard Si-Mike
        </x-slot>
        {{-- jumlah rencana investasi --}}
        <div class="fi-wi-stats-overview grid gap-6 md:grid-cols-2 xl:grid-cols-2 gap-x-6 gap-y-6">
            <div
                class="fi-wi-stats-overview-stat relative rounded-xl bg-white p-6 shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10 cursor-pointer">
                <div class="grid gap-y-2">
                    <div class="flex justify-center items-center gap-x-2">
                        <span class="text-md  font-medium text-custom-500 dark:text-custom-600">
                            Rencana Nilai Investasi
                        </span>
                    </div>

                    <div class="lg:text-4xl md:text-lg sm:text-md text-md flex justify-center font-semibold tracking-tight text-custom-600 dark:text-custom-600"
                        style="font-size: 2rem;">
                        Rp. {{ number_format($simike->total_investasi) }}
                    </div>
                    <div class="flex justify-center gap-x-1">
                        <span
                            class="italic fi-wi-stats-overview-stat-description text-sm fi-color-custom text-custom-600 dark:text-custom-400">
                            (Sesuai Dengan Parameter BKPM)
                        </span>
                    </div>
                </div>
            </div>

            <div
                class="fi-wi-stats-overview-stat relative rounded-xl bg-white p-6 shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10 cursor-pointer">
                <div class="grid gap-y-2">
                    <div class="flex justify-center gap-x-2">
                        <span class="text-md font-medium text-custom-600 dark:text-custom-600">
                            Total Rencana Nilai Investasi
                        </span>
                    </div>

                    <div class="lg:text-4xl md:text-lg sm:text-md text-md flex justify-center font-semibold tracking-tight text-custom-600 dark:text-custom-600"
                        style="font-size: 2rem;">
                        Rp. {{ number_format($simike->jumlah_investasi) }}
                    </div>
                    <div class="flex justify-center gap-x-1">
                        <span
                            class="italic fi-wi-stats-overview-stat-description text-sm fi-color-custom text-custom-600 dark:text-custom-400"
                            style="">
                            (Tidak Dengan Parameter BKPM)
                        </span>
                    </div>
                </div>
            </div>
        </div>

        {{-- jumlah proyek --}}
        <div class="fi-wi-stats-overview grid gap-6 md:grid-cols-3 xl:grid-cols-3 gap-x-6 gap-y-6 mt-6">
            <div
                class="fi-wi-stats-overview-stat relative rounded-xl bg-white p-6 shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10 cursor-pointer">
                <div class="grid gap-y-2">
                    <div class="flex justify-center gap-x-2">
                        <span class="text-md font-medium text-custom-600 dark:text-custom-600">
                            Jumlah Proyek
                        </span>
                    </div>

                    <div class="lg:text-4xl mt-2 md:text-2xl text-xl flex justify-center font-semibold tracking-tight text-custom-600 dark:text-custom-600"
                        style="font-size: 2.25rem;">
                        {{ number_format($simike->jumlah_proyek) }}
                    </div>

                </div>
            </div>

            <div
                class="fi-wi-stats-overview-stat relative rounded-xl bg-white p-6 shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10 cursor-pointer">
                <div class="grid gap-y-2">
                    <div class="flex justify-center gap-x-2">

                        <span class="text-md font-medium text-custom-600 dark:text-custom-600">
                            Jumlah NIB
                        </span>
                    </div>

                    <div class="lg:text-4xl mt-2 md:text-2xl text-xl flex justify-center font-semibold tracking-tight text-custom-600 dark:text-custom-600"
                        style="font-size: 2.25rem;">
                        {{ number_format($nib) }}
                    </div>
                </div>
            </div>

            <div
                class="fi-wi-stats-overview-stat relative rounded-xl bg-white p-6 shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10 cursor-pointer">
                <div class="grid gap-y-2">
                    <div class="flex justify-center gap-x-2">

                        <span class="text-md font-medium text-custom-600 dark:text-custom-600">
                            Jumlah Naker
                        </span>
                    </div>

                    <div class="lg:text-4xl mt-2 md:text-2xl text-xl flex justify-center font-semibold tracking-tight text-custom-600 dark:text-custom-600"
                        style="font-size: 2.25rem;">
                        {{ number_format($simike->count_tki + $simike->count_tka) }}
                    </div>
                </div>
            </div>
        </div>
    </x-filament::section>
</x-filament::widget>
