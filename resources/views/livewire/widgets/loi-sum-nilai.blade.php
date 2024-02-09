<x-filament-widgets::widget>
    <x-filament::section>
        <div
            class="fi-wi-stats-overview-stat relative rounded-xl bg-white p-6 shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10">
            <div class="grid gap-y-2">
                <div class="flex items-center gap-x-2">
                    <!--[if BLOCK]><![endif]--> <!--[if ENDBLOCK]><![endif]-->

                    <span class="text-sm font-medium text-gray-500 dark:text-gray-400">
                        Total Rencana Nilai Investasi LOI (dalam Rupiah dengan kurs dollar senilai Rp.
                        {{ number_format($this->kurs) }})
                    </span>
                </div>

                <div class="text-3xl font-semibold tracking-tight text-gray-950 dark:text-white">
                    Rp. {{ number_format($this->rp + $this->usd * $this->kurs) }}
                </div>

                <!--[if BLOCK]><![endif]-->
                <div class="flex items-center gap-x-1">
                    <!--[if BLOCK]><![endif]--> <!--[if ENDBLOCK]><![endif]-->

                    <span
                        class="fi-wi-stats-overview-stat-description text-sm fi-color-custom text-custom-600 dark:text-custom-400"
                        style="--c-400:var(--success-400);--c-600:var(--success-600);">
                        {{ number_format($this->countUsd + $this->countRp) }} Loi
                    </span>

                    <!--[if BLOCK]><![endif]--> <!--[if ENDBLOCK]><![endif]-->
                </div>
                <!--[if ENDBLOCK]><![endif]-->
            </div>

            <!--[if BLOCK]><![endif]--> <!--[if ENDBLOCK]><![endif]-->
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
