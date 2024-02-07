<x-filament-widgets::widget>
    <x-filament::section>
        {{-- Widget content --}}
        {{-- @livewire(\App\Livewire\Widgets\Sirusa\LastImportNib::class) --}}
        <div wire:id="w4czwb5w2Szz1AZG0kTK" style="--col-span-default: 1 / -1;"
            class="col-[--col-span-default] fi-wi-widget fi-wi-stats-overview">
            <div class="fi-wi-stats-overview-stats-ctn grid gap-6 md:grid-cols-1">
                <!--[if BLOCK]><![endif]-->
                <div
                    class="fi-wi-stats-overview-stat relative rounded-xl bg-white p-6 shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10">
                    <div class="grid gap-y-2">
                        <div class="flex items-center gap-x-2">
                            <!--[if BLOCK]><![endif]--> <!--[if ENDBLOCK]><![endif]-->

                            <span class="text-sm font-medium text-gray-500 dark:text-gray-400">
                                Periode Import Data Perusahaan Terakhir
                            </span>
                        </div>
                        <div class="text-3xl font-semibold tracking-tight text-gray-950 dark:text-white">
                            {{-- {{$this->periode->tanggal_awal->format('d/m/Y')}} --}}
                            {{ \Carbon\Carbon::parse($this->periode->tanggal_awal)->format('d M Y') }} -
                            {{ \Carbon\Carbon::parse($this->periode->tanggal_akhir)->format('d M Y') }}
                        </div>

                        <!--[if BLOCK]><![endif]-->
                        <div class="flex items-center gap-x-1">
                            <!--[if BLOCK]><![endif]--> <!--[if ENDBLOCK]><![endif]-->

                            <span
                                class="fi-wi-stats-overview-stat-description text-sm fi-color-custom text-custom-600 dark:text-custom-400"
                                style="--c-400:var(--success-400);--c-600:var(--success-600);">
                                Data *Perusahaan* Tahun
                                {{ \Carbon\Carbon::parse($this->periode->tanggal_awal)->format('Y') }}, telah direkam
                                {{ \Carbon\Carbon::parse($this->periode->created_at)->diffForHumans() }} yang lalu
                            </span>

                            <!--[if BLOCK]><![endif]--> <!--[if ENDBLOCK]><![endif]-->
                        </div>
                        <!--[if ENDBLOCK]><![endif]-->
                    </div>

                    <!--[if BLOCK]><![endif]--> <!--[if ENDBLOCK]><![endif]-->
                </div>

                <!--[if ENDBLOCK]><![endif]-->
            </div>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>