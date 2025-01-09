<x-filament-widgets::widget>
    <x-filament::section collapsible icon="heroicon-o-squares-2x2" icon-color="primary" class="mt-3 gap-x-2">
        <x-slot name="heading">
            Dashboard Kepeminatan
        </x-slot>
        <div class="fi-wi-stats-overview grid gap-6 md:grid-cols-2 xl:grid-cols-2 gap-x-6 gap-y-6">
            <div
                class="fi-wi-stats-overview-stat relative rounded-xl bg-white p-6 shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10 cursor-pointer">
                <div class="grid gap-y-2">
                    <div class="flex justify-center items-center gap-x-2">
                        <span class="text-md  font-medium text-custom-500 dark:text-custom-600">
                            Total Investasi (USD)
                        </span>
                    </div>

                    <div class="lg:text-4xl md:text-lg sm:text-md text-md flex justify-center font-semibold tracking-tight text-custom-600 dark:text-custom-600"
                        style="font-size: 2rem;">
                        USD {{ number_format($this->totalInvestasiDollar) }}
                    </div>
                </div>
            </div>

            <div
                class="fi-wi-stats-overview-stat relative rounded-xl bg-white p-6 shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10 cursor-pointer">
                <div class="grid gap-y-2">
                    <div class="flex justify-center gap-x-2">
                        <span class="text-md font-medium text-custom-600 dark:text-custom-600">
                            Total Investasi (IDR)
                        </span>
                    </div>

                    <div class="lg:text-4xl md:text-lg sm:text-md text-md flex justify-center font-semibold tracking-tight text-custom-600 dark:text-custom-600"
                        style="font-size: 2rem;">
                        Rp. {{ number_format($this->totalInvestasiRupiah) }}
                    </div>
                </div>
            </div>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
