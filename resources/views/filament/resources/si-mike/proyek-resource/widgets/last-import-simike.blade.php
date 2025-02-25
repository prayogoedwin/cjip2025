<x-filament-widgets::widget>
    <x-filament::section>
        <!-- Widget content -->
        <div class="col-[--col-span-default] fi-wi-widget fi-wi-stats-overview"
            style="--col-span-default: 1 / -1;">
            <div class="fi-wi-stats-overview-stats-ctn grid gap-6 md:grid-cols-1">
                <div
                    class="fi-wi-stats-overview-stat relative rounded-xl bg-white p-6 shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10">
                    <div class="grid gap-y-2">
                        <div class="flex items-center gap-x-2">
                            <span class="text-sm font-medium text-gray-500 dark:text-gray-400">
                                Periode Import Data Proyek Terakhir
                            </span>
                        </div>
                        <div class="text-3xl font-semibold tracking-tight text-gray-950 dark:text-white">
                            {{ \Carbon\Carbon::parse($this->periode->periode_start)->format('d M Y') }} -
                            {{ \Carbon\Carbon::parse($this->periode->periode_end)->format('d M Y') }}
                        </div>
                        <div class="flex items-center gap-x-1">
                            <span
                                class="fi-wi-stats-overview-stat-description text-sm fi-color-custom text-custom-600 dark:text-custom-400"
                                style="--c-400:var(--success-400);--c-600:var(--success-600);">
                                Data *Proyek* Tahun {{ \Carbon\Carbon::parse($this->periode->tahun)->format('Y') }},
                                pada triwulan {{ $this->periode->triwulan }} telah direkam
                                {{ \Carbon\Carbon::parse($this->periode->created_at)->locale('id')->diffForHumans() }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
