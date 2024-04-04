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
            Filter Dashboard Simike
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

                        <span class="text-md  font-medium text-green-500 dark:text-custom-600"
                            style="color: rgb(22 163 74);">
                            Rencana Nilai Investasi
                        </span>
                    </div>

                    <div class="lg:text-4xl md:text-lg sm:text-md text-md flex justify-center font-semibold tracking-tight text-green-00 dark:text-custom-600"
                        style="font-size: 2rem; color: rgb(22 163 74);">
                        Rp. {{ number_format($simike->investasi) }}
                    </div>
                    <div class="flex justify-center gap-x-1">
                        <span
                            class="italic fi-wi-stats-overview-stat-description text-sm fi-color-custom text-custom-600 dark:text-custom-400"
                            style="color: rgb(22 163 74);">
                            (Perhitungan Dengan Rumus Baru)
                        </span>
                    </div>
                </div>
            </div>


            {{-- <div
                class="fi-wi-stats-overview-stat relative rounded-xl bg-white p-6 shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10 cursor-pointer">
                <div class="grid gap-y-2">
                    <div class="flex justify-center items-center gap-x-2">

                        <span class="text-md  font-medium text-green-500 dark:text-custom-600"
                            style="color: rgb(22 163 74);">
                            Rencana Nilai Investasi
                        </span>
                    </div>

                    <div class="lg:text-4xl md:text-lg sm:text-md text-md flex justify-center font-semibold tracking-tight text-green-00 dark:text-custom-600"
                        style="font-size: 2rem; color: rgb(22 163 74);">
                        Rp. {{ number_format($simike->total_investasi) }}
                    </div>
                    <div class="flex justify-center gap-x-1">
                        <span
                            class="italic fi-wi-stats-overview-stat-description text-sm fi-color-custom text-custom-600 dark:text-custom-400"
                            style="color: rgb(22 163 74);">
                            (Dikurangi Tanah dan Bangunan)
                        </span>
                    </div>
                </div>
            </div> --}}

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
                            (Perhitungan Tanpa Menggunakan Rumus)
                        </span>
                    </div>
                </div>
            </div>
        </div>

        {{-- anomaly --}}
        <div class="fi-wi-stats-overview grid gap-6 md:grid-cols-2 xl:grid-cols-2 gap-x-6 gap-y-6 mt-6">
            <div
                class="fi-wi-stats-overview-stat relative rounded-xl bg-white p-6 shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10 cursor-pointer">
                <div class="grid gap-y-2">
                    <div class="flex justify-center gap-x-2">
                        <span class="text-md font-medium text-danger-600 dark:text-danger-600"
                            style="--c-400:var(--danger-400);--c-600:var(--danger-600);">
                            Rencana Nilai Investasi (Anomaly)
                        </span>
                    </div>

                    <div class="lg:text-4xl mt-2 md:text-2xl text-xl flex justify-center
                            font-semibold tracking-tight text-danger-600 dark:text-danger-600"
                        style="--c-400:var(--danger-400);--c-600:var(--danger-600); font-size: 2.25rem;">
                        Rp. {{ number_format($simike->total_investasi_anomaly) }}
                    </div>
                    <div class="flex justify-center gap-x-1 mt-2">
                        <span
                            class="italic fi-wi-stats-overview-stat-description text-sm fi-color-custom text-custom-600 dark:text-custom-600"
                            style="--c-400:var(--danger-600);--c-600:var(--danger-600);">
                            {{-- (Dikurangi Tanah dan Bangunan) --}}
                        </span>
                    </div>
                </div>
            </div>

            <div
                class="fi-wi-stats-overview-stat relative rounded-xl bg-white p-6 shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10 cursor-pointer">
                <div class="grid gap-y-2">
                    <div class="flex justify-center gap-x-2">

                        <span class="text-md font-medium text-danger-600 dark:text-danger-600">
                            Jumlah Proyek (Anomaly)
                        </span>
                    </div>

                    <div class="lg:text-4xl mt-2 md:text-2xl text-xl flex justify-center font-semibold tracking-tight text-danger-600 dark:text-danger-600"
                        style="font-size: 2.25rem;">
                        {{ number_format($simike->jumlah_proyek_anomaly) }}
                    </div>
                    <div class="flex justify-center gap-x-1">
                        {{-- <span
                            class="fi-wi-stats-overview-stat-description text-sm fi-color-custom text-gray-300 dark:text-gray-300">
                            Jumlah Proyek Anomaly
                        </span> --}}
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

    {{-- <div wire:loading wire:target="submit">
        <div class="top-0 z-50 w-screen h-screen bg-gray-800 opacity-70 absolute items-center justify-center duration-300 transition-opacity"
            style="z-index: 100">
            <div class="flex-col">
                <div class="animate-pulse w-24 h-24">
                    <svg id="Layer_2" xmlns="http://www.w3.org/2000/svg" class="w-24 h-24"
                        xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 9.08 12.89">
                        <defs>
                            <style>
                                .cls-1 {
                                    fill: url(#linear-gradient-2);
                                }

                                .cls-2 {
                                    fill: url(#linear-gradient-6);
                                }

                                .cls-3 {
                                    fill: url(#linear-gradient-5);
                                }

                                .cls-4 {
                                    fill: url(#linear-gradient-7);
                                }

                                .cls-5 {
                                    fill: url(#linear-gradient-3);
                                }

                                .cls-6 {
                                    fill: url(#linear-gradient);
                                }

                                .cls-7 {
                                    fill: url(#linear-gradient-4);
                                }
                            </style>
                            <linearGradient id="linear-gradient" x1="2.17" y1="11.51" x2="9.62"
                                y2="10.37" gradientUnits="userSpaceOnUse">
                                <stop offset="0" stop-color="#b57e10" />
                                <stop offset=".15" stop-color="#b57e10" />
                                <stop offset=".41" stop-color="#e5c25b" />
                                <stop offset=".54" stop-color="#f9df7b" />
                                <stop offset=".67" stop-color="#fff3a6" />
                                <stop offset=".81" stop-color="#f9df7b" />
                                <stop offset=".97" stop-color="#b57e10" />
                            </linearGradient>
                            <linearGradient id="linear-gradient-2" x1="5.13" y1="3.32" x2="9.59"
                                y2="3.32" gradientUnits="userSpaceOnUse">
                                <stop offset="0" stop-color="#fff3a6" />
                                <stop offset=".08" stop-color="#f9df7b" />
                                <stop offset=".16" stop-color="#e0bc54" />
                                <stop offset=".25" stop-color="#cda136" />
                                <stop offset=".33" stop-color="#bf8d21" />
                                <stop offset=".41" stop-color="#b78114" />
                                <stop offset=".49" stop-color="#b57e10" />
                                <stop offset=".56" stop-color="#b78114" />
                                <stop offset=".63" stop-color="#bf8d20" />
                                <stop offset=".71" stop-color="#cca035" />
                                <stop offset=".78" stop-color="#dfba52" />
                                <stop offset=".86" stop-color="#f7dc77" />
                                <stop offset=".86" stop-color="#f9df7b" />
                                <stop offset="1" stop-color="#fff3a6" />
                            </linearGradient>
                            <linearGradient id="linear-gradient-3" x1="-.98" y1="6.92" x2="13.05"
                                y2="1.86" xlink:href="#linear-gradient" />
                            <linearGradient id="linear-gradient-4" x1="2.88" y1="11.96" x2="8.08"
                                y2="9.69" xlink:href="#linear-gradient" />
                            <linearGradient id="linear-gradient-5" x1="-.19" y1="9.09" x2="5.41"
                                y2="8.34" gradientUnits="userSpaceOnUse">
                                <stop offset="0" stop-color="#b57e10" />
                                <stop offset=".15" stop-color="#b57e10" />
                                <stop offset=".46" stop-color="#e5c25b" />
                                <stop offset=".61" stop-color="#f9df7b" />
                                <stop offset=".72" stop-color="#fff3a6" />
                                <stop offset=".84" stop-color="#f9df7b" />
                                <stop offset="1" stop-color="#b57e10" />
                            </linearGradient>
                            <linearGradient id="linear-gradient-6" x1="9.51" y1="8.65" x2="7.02"
                                y2="6.78" gradientUnits="userSpaceOnUse">
                                <stop offset=".26" stop-color="#1a1a1a" />
                                <stop offset=".33" stop-color="#1f1f1f" />
                                <stop offset=".41" stop-color="#2d2d2d" />
                                <stop offset=".49" stop-color="#454545" />
                                <stop offset=".51" stop-color="#4d4d4d" />
                                <stop offset=".57" stop-color="#383838" />
                                <stop offset=".64" stop-color="#272727" />
                                <stop offset=".72" stop-color="#1d1d1d" />
                                <stop offset=".81" stop-color="#1a1a1a" />
                            </linearGradient>
                            <linearGradient id="linear-gradient-7" x1="10" y1="12.62" x2="6.2"
                                y2="9.7" xlink:href="#linear-gradient-6" />
                        </defs>
                        <g id="Layer_2-2">
                            <g>
                                <path class="cls-6"
                                    d="M4.25,12.88s0,0,0,0c0,0,0,0,0,0,0,0,0,0,0,0,0,0-.01,0-.02,0-.79-.47-1.32-1.34-1.32-2.33,0-.21,.02-.41,.07-.61,.03-.14,.04-.11,.12-.27,.23,.13,.49,.26,.75,.34,.46,.15,.95,.24,1.46,.24,.05,0,.1,0,.15,0-.66,.7-1.1,1.61-1.21,2.63Z" />
                                <path class="cls-1"
                                    d="M7.16,3.56c0,.34-.04,.68-.11,1-.17,.79-.55,1.51-1.07,2.09,.35-.65,.55-1.39,.55-2.18,0-.07,0-.14,0-.21-.05-1.2-.57-2.29-1.37-3.08,0,0-.02-.02-.02-.02,.03-.07,.05-.13,.08-.2,.03-.08,.06-.16,.08-.24,.08-.23,.14-.47,.19-.71,.25,.21,.47,.44,.67,.69,.07,.09,.14,.18,.2,.27,.09,.13,.17,.26,.24,.4,.36,.66,.56,1.41,.56,2.2Z" />
                                <path class="cls-5"
                                    d="M6.53,4.47c0,.79-.2,1.53-.55,2.18-.08,.09-.17,.18-.26,.26-.41,.47-.78,.83-1.07,1.1-.07,.06-.13,.12-.18,.17,0,0,0,0,0,0-.24,.21-.4,.32-.5,.41-.05,.04-.1,.1-.14,.14-.01-.01-.03-.03-.04-.04-.02-.02-.05-.05-.07-.07-.16-.15-.31-.32-.45-.49-.63-.79-1-1.79-1-2.87,0-.31,.03-.61,.09-.9,0,0,0,0,0,0,1.23-.73,2.21-1.85,2.76-3.18,.01,0,.02,0,.03,0,.8,.79,1.31,1.88,1.37,3.08,0,.07,0,.14,0,.21Z" />
                                <path class="cls-7"
                                    d="M5.31,10.25c.05,0,.1,0,.15,0-.66,.7-1.1,1.61-1.21,2.63,0,0,0,0,0,0,0,0,0,0,0,0-.3-.61-.47-1.29-.47-2.02,0-.29,.03-.57,.08-.84,.46,.15,.95,.24,1.46,.24Z" />
                                <path class="cls-3"
                                    d="M4.25,12.88s0,0,0,0c0,0,0,0-.01,0-.6-.04-1.17-.2-1.69-.45h0C1.14,11.74,.14,10.34,.01,8.7c0-.12-.01-.23-.01-.35,0-.29,.03-.57,.08-.85,.07-.36,.18-.7,.32-1.02,.1-.23,.23-.45,.37-.66,.4-.6,.95-1.1,1.59-1.45-.06,.29-.09,.59-.09,.9,0,1.09,.37,2.08,1,2.87,.14,.17,.29,.34,.45,.49,.02,.02,.05,.05,.07,.07,.01,.01,.03,.03,.04,.04-.23,.23-.71,.78-.85,1.21,0,.06-.5,1.8,1.26,2.94Z" />
                                <path class="cls-2"
                                    d="M7.23,6.92c-.2,.16-.32,.33-.42,.57-.04,.1-.07,.2-.09,.31-.04,.26-.02,.51,.06,.74,.02,.05,.04,.09,.06,.14,.02,.03,.03,.07,.05,.1,.02,.04,.04,.07,.07,.11,.09-.06,.19-.12,.28-.19,0,0,.54-.46,.54-.46,0,0,.19-.2,.28-.31,.15-.18,.28-.36,.4-.56,.09-.15,.26-.46,.26-.46,0,0,0-.06,.01-.08,.01-.11,.01-.22,0-.33-.03-.26-.12-.49-.26-.69-.03-.04-.06-.08-.09-.12-.02-.03-.05-.05-.07-.08-.07-.07-.16-.14-.24-.2,0,.08-.02,.16-.03,.24,0,.03-.01,.05-.02,.08,0,.02-.01,.05-.02,.07,0,0,0,0,0,0,0,0,0,0-.01,0-.1,.37-.3,.7-.57,.96-.05,.05-.11,.1-.17,.15" />
                                <path class="cls-4"
                                    d="M9.08,8.35c0,.17,0,.33-.03,.49-.02,.2-.05,.39-.1,.58-.13,.52-.34,1-.63,1.44-.31,.47-.71,.88-1.17,1.2-.11,.07-.21,.14-.33,.21-.67,.4-1.46,.62-2.3,.62-.1,0-.19,0-.29,0,.09-.85,.42-1.63,.91-2.28,.09-.12,.19-.24,.3-.35h0c.15-.16,.32-.32,.5-.45,.21-.16,.43-.31,.66-.43,0,0,0,0,0,0,.1-.04,.19-.09,.29-.14,0,0,0,0,0,0,.05-.03,.11-.06,.16-.09,.03-.02,.06-.04,.09-.05,.09-.05,.18-.1,.27-.17,0,0,0-.01,0-.02,.07-.05,.14-.11,.21-.16,.06-.05,.13-.11,.19-.16,.24-.23,.41-.43,.41-.43,.2-.22,.66-1.03,.66-1.03,.06,.2,.1,.41,.13,.62,.02,.17,.04,.34,.04,.52,0,.03,0,.07,0,.1Z" />
                            </g>
                        </g>
                    </svg>
                </div>
            </div>
        </div>
    </div> --}}
</x-filament::widget>
