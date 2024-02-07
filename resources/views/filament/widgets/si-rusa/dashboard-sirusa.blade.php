<x-filament::widget>
    {{-- <div class="relative py-5 mb-5">
        <div class="absolute inset-0 flex items-center" aria-hidden="true">
            <div class="w-full border-t border-gray-300"></div>
        </div>
        <div class="relative flex justify-center">
            <span class="px-4 bg-primary-500 rounded-lg text-md font-bold text-white uppercase">Dashboard Si-Rusa</span>
        </div>
    </div> --}}
    <x-filament::section collapsible icon="heroicon-o-magnifying-glass" icon-color="primary">
        <x-slot name="heading">
            Filter Si-Rusa
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
            Dashboard Si-Rusa
        </x-slot>
        <!-- component -->
        <ul role="list" class="grid grid-cols-2 gap-3 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-2">
            <li
                class="col-span-1 flex flex-col ring-1 ring-gray-950/5 dark:ring-white/10 dark:bg-gray-300 rounded-lg text-center shadow-lg py-4">
                <div class="flex flex-1 flex-col p-8 ">
                    <div class="flex items-center justify-center space-x-3">
                        <h3 class="text-center text-lg font-semibold text-gray-500 dark:text-gray-300">NIB JATENG + NIB
                            NON
                            JATENG PROYEK JATENG
                        </h3>
                    </div>
                    <p class="mt-1 text-9xl text-center font-extrabold justify-center text-gray-900 dark:text-gray-100"
                        style="font-size: 4.5rem;">
                        {{ number_format(array_sum($this->nib_jateng) + array_sum($this->nib_non_jateng)) }}
                    </p>
                    <div wire:click="downloadAll('jatengnonjateng', '{{ $day_of_tanggal_terbit_oss }}' , '{{ $status_pm }}', '{{ $kabkota }}', '{{ $sektor }}')"
                        class="cursor-pointer flex items-center justify-center space-x-3 rounded-full bg-primary p-2 text-gray-900 hover:text-primary-500 dark:text-gray-300">
                        Export
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 8.25H7.5a2.25 2.25 0 00-2.25 2.25v9a2.25 2.25 0 002.25 2.25h9a2.25 2.25 0 002.25-2.25v-9a2.25 2.25 0 00-2.25-2.25H15M9 12l3 3m0 0l3-3m-3 3V2.25" />
                        </svg>
                    </div>
                </div>
            </li>
            <li
                class="col-span-1 flex flex-col ring-1 ring-gray-950/5 dark:ring-white/10 dark:bg-gray-300 rounded-lg text-center shadow-lg py-4">
                <div class="flex flex-1 flex-col p-8">
                    <div class="flex items-center justify-center space-x-3">
                        <h3 class="text-center text-lg font-semibold text-gray-500 dark:text-gray-300">SEMUA NIB</h3>
                    </div>
                    <p class="mt-1 text-9xl text-center font-extrabold justify-center text-gray-900 dark:text-gray-100"
                        style="font-size: 4.5rem;">
                        {{ number_format(array_sum($this->nib_jateng) + array_sum($this->nib_non_jateng) + ($this->nib_jateng_proyek_non_jateng ?? 0)) }}
                    </p>
                </div>
                {{-- <div>
                    <div class="-mt-px flex divide-x divide-gray-200">
                        <div class="flex w-0 flex-1">
                            <a href="mailto:najibgafar@gmail.com"
                                class="relative -mr-px inline-flex w-0 flex-1 items-center justify-center gap-x-3 rounded-bl-lg border border-transparent py-4 text-sm font-semibold text-gray-900">
                                <svg class="h-5 w-5 text-yellow-500 hover:text-gray-50" viewBox="0 0 20 20"
                                    fill="currentColor" aria-hidden="true">
                                    <path
                                        d="M3 4a2 2 0 00-2 2v1.161l8.441 4.221a1.25 1.25 0 001.118 0L19 7.162V6a2 2 0 00-2-2H3z" />
                                    <path
                                        d="M19 8.839l-7.77 3.885a2.75 2.75 0 01-2.46 0L1 8.839V14a2 2 0 002 2h14a2 2 0 002-2V8.839z" />
                                </svg>
                                Email
                            </a>
                        </div>
                        <div class="-ml-px flex w-0 flex-1">
                            <a href="tel:+4407393145546"
                                class="relative inline-flex w-0 flex-1 items-center justify-center gap-x-3 rounded-br-lg border border-transparent py-4 text-sm font-semibold text-gray-900">
                                <svg class="h-5 w-5 text-yellow-500 hover:text-gray-50" viewBox="0 0 20 20"
                                    fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M2 3.5A1.5 1.5 0 013.5 2h1.148a1.5 1.5 0 011.465 1.175l.716 3.223a1.5 1.5 0 01-1.052 1.767l-.933.267c-.41.117-.643.555-.48.95a11.542 11.542 0 006.254 6.254c.395.163.833-.07.95-.48l.267-.933a1.5 1.5 0 011.767-1.052l3.223.716A1.5 1.5 0 0118 15.352V16.5a1.5 1.5 0 01-1.5 1.5H15c-1.149 0-2.263-.15-3.326-.43A13.022 13.022 0 012.43 8.326 13.019 13.019 0 012 5V3.5z"
                                        clip-rule="evenodd" />
                                </svg>
                                Call
                            </a>
                        </div>
                    </div>
                </div> --}}
            </li>
        </ul>
        <ul role="list" class="grid grid-cols-1 gap-3 mt-3 sm:grid-cols-3 md:grid-cols-3 lg:grid-cols-3">
            <li
                class="col-span-1 flex flex-col ring-1 ring-gray-950/5 dark:ring-white/10 dark:bg-gray-300 rounded-lg text-center shadow-lg py-4">
                <div class="flex flex-1 flex-col p-8">
                    <div class="flex items-center justify-center space-x-3">
                        <h3 class="text-center text-lg font-semibold text-gray-500 dark:text-gray-300">NIB JATENG PROYEK
                            JATENG
                        </h3>
                    </div>
                    <p class="mt-1 text-9xl text-center font-extrabold justify-center text-gray-900 dark:text-gray-100"
                        style="font-size: 4.5rem;">
                        {{ number_format(array_sum($this->nib_jateng)) }}
                    </p>
                    <p class="mt-0 text-3xl text-center font-extrabold justify-center text-gray-900 dark:text-gray-100">
                        {{ number_format($this->proyek_jateng) }}
                    </p>
                    <div wire:click="downloadAll('jatengnonjateng', '{{ $day_of_tanggal_terbit_oss }}' , '{{ $status_pm }}', '{{ $kabkota }}', '{{ $sektor }}')"
                        class="cursor-pointer flex items-center justify-center space-x-3 rounded-full bg-primary p-2 text-gray-900 hover:text-primary-500 dark:text-gray-300">
                        Export
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 8.25H7.5a2.25 2.25 0 00-2.25 2.25v9a2.25 2.25 0 002.25 2.25h9a2.25 2.25 0 002.25-2.25v-9a2.25 2.25 0 00-2.25-2.25H15M9 12l3 3m0 0l3-3m-3 3V2.25" />
                        </svg>
                    </div>
                </div>
                <div>
                    <nav class="isolate flex divide-x divide-gray-200 rounded-lg shadow " aria-label="Tabs">
                        @foreach ($nib_jateng as $skala => $value)
                            <div x-data="{ showTooltip: false }" class="w-full" wire:key="{{ $loop->index . '-' . $value }}">
                                <button x-on:mouseover="showTooltip = true" x-on:mouseout="showTooltip = false"
                                    x-on:click="showTooltip = false"
                                    wire:click="findResikoJateng('{{ $skala }}')"
                                    wire:key="button-{{ $loop->index . '-' . $value }}" wire:loading.class="opacity-50"
                                    wire:loading.attr="disabled"
                                    class="text-gray-900 w-full rounded-l-lg group relative min-w-0 flex-1 overflow-hidden bg-white dark:bg-gray-800 py-4 px-4 text-center text-sm font-medium hover:bg-gray-50 focus:z-10"
                                    aria-current="page">
                                    <span aria-hidden="true"
                                        class="bg-{{ $colors[$skala] }}-500 absolute inset-x-0 bottom-0 h-0.5"></span>
                                    <span class="dark:text-gray-100">{{ number_format($value) }}</span>
                                    <svg wire:loading wire:target="findResikoJateng('{{ $skala }}')"
                                        wire:key="loading-{{ $loop->index . '-' . $value }}"
                                        class="animate-spin h-5 w-5 absolute top-1/2 left-1/2 -mt-2 -ml-3 text-{{ $colors[$skala] }}-500"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10"
                                            stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor"
                                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647zM12 20.732V24a12.002 12.002 0 0012-12h-4a8 8 0 01-8 8z">
                                        </path>
                                    </svg>
                                </button>

                                <div class="relative" x-cloak x-show.transition.origin.top="showTooltip">
                                    <div class="absolute z-10 text-white p-2 bg-{{ $colors[$skala] }}-500 rounded-lg shadow-lg"
                                        style="top: 100%; left: 50%; transform: translateX(-50%);">
                                        {{ $skala }}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </nav>
                </div>

            </li>
            <li
                class="col-span-1 flex flex-col ring-1 ring-gray-950/5 dark:ring-white/10 dark:bg-gray-300 rounded-lg text-center shadow-lg py-4">
                <div class="flex flex-1 flex-col p-8">
                    <div class="flex items-center justify-center space-x-3">
                        <h3 class="text-center text-lg font-semibold text-gray-500 dark:text-gray-300">NIB NON JATENG
                            PROYEK
                            JATENG</h3>
                    </div>
                    <p class="mt-1 text-9xl text-center font-extrabold justify-center text-gray-900 dark:text-gray-100"
                        style="font-size: 4.5rem;">
                        {{ number_format(array_sum($this->nib_non_jateng)) }}
                    </p>
                    <p
                        class="mt-1 truncate text-3xl text-center font-extrabold justify-center text-gray-900 dark:text-gray-100">
                        {{ number_format($this->proyek_non_jateng) }}
                    </p>
                    <div wire:click="downloadAll('non_jateng', '{{ $day_of_tanggal_terbit_oss }}', '{{ $status_pm }}', '{{ $kabkota }}', '{{ $sektor }}')"
                        class="cursor-pointer flex items-center justify-center space-x-3 rounded-full bg-primary p-2 text-gray-900 hover:text-primary-500 dark:text-gray-300">
                        Export
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 8.25H7.5a2.25 2.25 0 00-2.25 2.25v9a2.25 2.25 0 002.25 2.25h9a2.25 2.25 0 002.25-2.25v-9a2.25 2.25 0 00-2.25-2.25H15M9 12l3 3m0 0l3-3m-3 3V2.25" />
                        </svg>
                    </div>
                </div>
                <div>
                    <nav class="isolate flex divide-x divide-gray-200 rounded-lg shadow" aria-label="Tabs">
                        @foreach ($nib_non_jateng as $skala => $value)
                            <div x-data="{ showTooltipNon: false }" class="w-full"
                                wire:key="{{ $loop->index . '-' . $value }}">
                                <button x-on:mouseover="showTooltipNon = true" x-on:mouseout="showTooltipNon = false"
                                    x-on:click="showTooltipNon = false"
                                    wire:click="findResikoNonJateng('{{ $skala }}')"
                                    wire:key="button-{{ $loop->index . '-' . $value }}"
                                    wire:loading.class="opacity-50" wire:loading.attr="disabled"
                                    class="text-gray-900 w-full rounded-l-lg group relative min-w-0 flex-1 overflow-hidden bg-gray-500 dark:bg-gray-800 py-4 px-4 text-center text-sm font-medium hover:bg-{{ $colors[$skala] }}-50 focus:z-10"
                                    aria-current="page">
                                    <span aria-hidden="true"
                                        class="bg-{{ $colors[$skala] }}-500 absolute inset-x-0 bottom-0 h-0.5"></span>
                                    <span class="dark:text-gray-100">{{ number_format($value) }}</span>
                                    <svg wire:loading wire:target="findResikoNonJateng('{{ $skala }}')"
                                        wire:key="loading-{{ $loop->index . '-' . $value }}"
                                        class="animate-spin h-5 w-5 absolute top-1/2 left-1/2 -mt-2 -ml-3 text-{{ $colors[$skala] }}-500"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10"
                                            stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor"
                                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647zM12 20.732V24a12.002 12.002 0 0012-12h-4a8 8 0 01-8 8z">
                                        </path>
                                    </svg>
                                </button>

                                <div class="relative" x-cloak x-show.transition.origin.top="showTooltipNon">
                                    <div class="absolute z-10 text-white p-2 bg-{{ $colors[$skala] }}-500 rounded-lg shadow-lg"
                                        style="top: 100%; left: 50%; transform: translateX(-50%);">
                                        {{ $skala }}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </nav>
                </div>
            </li>
            <li
                class="col-span-1 flex flex-col ring-1 ring-gray-950/5 dark:ring-white/10 dark:bg-gray-300 rounded-lg text-center shadow-lg py-4">
                <div class="flex flex-1 flex-col p-8">
                    <div class="flex items-center justify-center space-x-3">
                        <h3 class="text-center text-lg font-semibold text-gray-500 dark:text-gray-300">NIB JATENG
                            PROYEK
                            NON
                            JATENG</h3>
                    </div>
                    <p class="mt-1 text-9xl text-center font-extrabold justify-center text-gray-900 dark:text-gray-100"
                        style="font-size: 4.5rem;">
                        {{ number_format($this->nib_jateng_proyek_non_jateng) ?? 'N/A' }}
                    </p>

                    <div wire:click="downloadAll('other', '{{ $day_of_tanggal_terbit_oss }}', '{{ $status_pm }}', '{{ $kabkota }}', '{{ $sektor }}')"
                        class="cursor-pointer flex items-center justify-center space-x-3 rounded-full bg-primary  p-2 text-gray-900 dark:text-gray-300 hover:text-primary-500">
                        Export
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 8.25H7.5a2.25 2.25 0 00-2.25 2.25v9a2.25 2.25 0 002.25 2.25h9a2.25 2.25 0 002.25-2.25v-9a2.25 2.25 0 00-2.25-2.25H15M9 12l3 3m0 0l3-3m-3 3V2.25" />
                        </svg>
                    </div>
                </div>
            </li>
        </ul>
        <ul role="list" class="grid grid-cols-1 mt-3 gap-3 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-2">
            <li
                class="col-span-1 flex flex-col ring-1 ring-gray-950/5 dark:ring-white/10 dark:bg-gray-300 rounded-lg text-center shadow-lg py-4">
                <div class="flex flex-1 flex-col p-8">
                    <div class="flex items-center justify-center space-x-3">
                        <h3 class="text-center text-lg font-semibold text-gray-500 dark:text-gray-300">NIB JATENG
                            PROYEK
                            JATENG + NIB JATENG
                            PROYEK NON JATENG
                        </h3>
                    </div>
                    <p class="mt-1 text-9xl text-center font-extrabold justify-center text-gray-900 dark:text-gray-100"
                        style="font-size: 4.5rem;">
                        {{ number_format(array_sum($this->nib_jateng) + $this->nib_jateng_proyek_non_jateng) }}
                    </p>

                    <div wire:click="downloadAll('jatengnonjateng', '{{ $day_of_tanggal_terbit_oss }}' , '{{ $status_pm }}', '{{ $kabkota }}', '{{ $sektor }}')"
                        class="cursor-pointer flex items-center justify-center space-x-3 rounded-full bg-primary p-2 text-gray-900 hover:text-primary-500 dark:text-gray-300">
                        Export
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 8.25H7.5a2.25 2.25 0 00-2.25 2.25v9a2.25 2.25 0 002.25 2.25h9a2.25 2.25 0 002.25-2.25v-9a2.25 2.25 0 00-2.25-2.25H15M9 12l3 3m0 0l3-3m-3 3V2.25" />
                        </svg>
                    </div>
                </div>
                <div>
                    <nav class="isolate flex divide-x divide-gray-200 rounded-lg shadow " aria-label="Tabs">
                        @foreach ($nib_jateng as $skala => $value)
                            <div x-data="{ showTooltip: false }" class="w-full"
                                wire:key="{{ $loop->index . '-' . $value }}">
                                <button x-on:mouseover="showTooltip = true" x-on:mouseout="showTooltip = false"
                                    x-on:click="showTooltip = false"
                                    wire:click="findResikoJateng('{{ $skala }}')"
                                    wire:key="button-{{ $loop->index . '-' . $value }}"
                                    wire:loading.class="opacity-50" wire:loading.attr="disabled"
                                    class="text-gray-900 w-full rounded-l-lg group relative min-w-0 flex-1 overflow-hidden bg-gray-500 dark:bg-gray-800 py-4 px-4 text-center text-sm font-medium hover:bg-gray-50 focus:z-10"
                                    aria-current="page">
                                    <span aria-hidden="true"
                                        class="bg-{{ $colors[$skala] }}-500 absolute inset-x-0 bottom-0 h-0.5"></span>
                                    <span class="dark:text-gray-100">{{ number_format($value) }}</span>
                                    <svg wire:loading wire:target="findResikoJateng('{{ $skala }}')"
                                        wire:key="loading-{{ $loop->index . '-' . $value }}"
                                        class="animate-spin h-5 w-5 absolute top-1/2 left-1/2 -mt-2 -ml-3 text-{{ $colors[$skala] }}-500"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10"
                                            stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor"
                                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647zM12 20.732V24a12.002 12.002 0 0012-12h-4a8 8 0 01-8 8z">
                                        </path>
                                    </svg>
                                </button>

                                <div class="relative" x-cloak x-show.transition.origin.top="showTooltip">
                                    <div class="absolute z-10 text-white p-2 bg-{{ $colors[$skala] }}-500 rounded-lg shadow-lg"
                                        style="top: 100%; left: 50%; transform: translateX(-50%);">
                                        {{ $skala }}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </nav>
                </div>

            </li>
            <li
                class="col-span-1 flex flex-col ring-1 ring-gray-950/5 dark:ring-white/10 dark:bg-gray-300 rounded-lg text-center shadow-lg py-4">
                <div class="flex flex-1 flex-col p-8">
                    <div class="flex items-center justify-center space-x-3">
                        <h3 class="text-center text-lg font-semibold text-gray-500 dark:text-gray-300">PROYEK JATENG
                            NIB
                            JATENG + PROYEK JATENG
                            NIB JATENG NON JATENG</h3>
                    </div>
                    <p class="mt-1 text-9xl text-center font-extrabold justify-center text-gray-900 dark:text-gray-100"
                        style="font-size: 4.5rem;">
                        {{ number_format($this->proyek_jateng + $this->proyek_non_jateng) }}
                    </p>

                    <div wire:click="downloadAll('other', '{{ $day_of_tanggal_terbit_oss }}', '{{ $status_pm }}', '{{ $kabkota }}', '{{ $sektor }}')"
                        class="cursor-pointer flex items-center justify-center space-x-3 rounded-full bg-primary p-2 text-gray-900 dark:text-gray-300 hover:text-primary-500">
                        Export
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 8.25H7.5a2.25 2.25 0 00-2.25 2.25v9a2.25 2.25 0 002.25 2.25h9a2.25 2.25 0 002.25-2.25v-9a2.25 2.25 0 00-2.25-2.25H15M9 12l3 3m0 0l3-3m-3 3V2.25" />
                        </svg>
                    </div>
                </div>
            </li>
        </ul>

        @if ($resiko_nib_jateng)
            <div class="mt-4">
                <h2 class="text-sm font-medium text-gray-500">Uraian NIB JATENG dengan skala : <span
                        class="font-extrabold">{{ $skalaNib }}</span></h2>
                <button
                    wire:click="downloadSkala('jateng', '{{ $skalaNib }}', '{{ $day_of_tanggal_terbit_oss }}')"
                    type="button"
                    class="rounded-md bg-success-600 p-2 text-white shadow-sm hover:bg-success-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-success-600">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 8.25H7.5a2.25 2.25 0 00-2.25 2.25v9a2.25 2.25 0 002.25 2.25h9a2.25 2.25 0 002.25-2.25v-9a2.25 2.25 0 00-2.25-2.25H15M9 12l3 3m0 0l3-3m-3 3V2.25" />
                    </svg>
                </button>
                <ul role="list" class="mt-3 grid grid-cols-1 gap-5 sm:grid-cols-2 sm:gap-6 lg:grid-cols-4">
                    <li class="col-span-1 flex rounded-md shadow-sm">
                        <div
                            class="flex w-16 flex-shrink-0 items-center justify-center bg-pink-600 rounded-l-md text-sm font-medium text-white">
                            T</div>
                        <div
                            class="flex flex-1 items-center justify-between truncate rounded-r-md border-b border-r border-t border-gray-200 bg-white">
                            <div class="flex-1 truncate px-4 py-2 text-sm">
                                <a href="#" class="font-medium text-gray-900 hover:text-gray-600">Resiko
                                    Tinggi</a>
                                <p class="text-gray-500">{{ number_format($resikoJateng['Tinggi']) }}</p>
                            </div>
                            <div class="flex-shrink-0 pr-2">
                                <button
                                    wire:click="downloadResiko('jateng', '{{ $skalaNib }}', 'Tinggi', '{{ $day_of_tanggal_terbit_oss }}')"
                                    type="button"
                                    class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-transparent bg-white text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-pink-500 focus:ring-offset-2">
                                    <span class="sr-only">Open</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                        class="w-6 h-6">
                                        <path fill-rule="evenodd"
                                            d="M19.5 21a3 3 0 003-3V9a3 3 0 00-3-3h-5.379a.75.75 0 01-.53-.22L11.47 3.66A2.25 2.25 0 009.879 3H4.5a3 3 0 00-3 3v12a3 3 0 003 3h15zm-6.75-10.5a.75.75 0 00-1.5 0v4.19l-1.72-1.72a.75.75 0 00-1.06 1.06l3 3a.75.75 0 001.06 0l3-3a.75.75 0 10-1.06-1.06l-1.72 1.72V10.5z"
                                            clip-rule="evenodd" />
                                    </svg>

                                </button>
                            </div>
                        </div>
                    </li>

                    <li class="col-span-1 flex rounded-md shadow-sm">
                        <div
                            class="flex w-16 flex-shrink-0 items-center justify-center bg-purple-600 rounded-l-md text-sm font-medium text-white">
                            MT</div>
                        <div
                            class="flex flex-1 items-center justify-between truncate rounded-r-md border-b border-r border-t border-gray-200 bg-white">
                            <div class="flex-1 truncate px-4 py-2 text-sm">
                                <a href="#" class="font-medium text-gray-900 hover:text-gray-600">Resiko
                                    Menengah
                                    Tinggi</a>
                                <p class="text-gray-500">{{ number_format($resikoJateng['Menengah Tinggi']) }}</p>
                            </div>
                            <div class="flex-shrink-0 pr-2">
                                <button
                                    wire:click="downloadResiko('jateng', '{{ $skalaNib }}', 'Menengah Tinggi', '{{ $day_of_tanggal_terbit_oss }}', '{{ $status_pm }}', '{{ $kabkota }}', '{{ $sektor }}')"
                                    type="button"
                                    class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-transparent bg-white text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                    <span class="sr-only">Open</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                        class="w-6 h-6">
                                        <path fill-rule="evenodd"
                                            d="M19.5 21a3 3 0 003-3V9a3 3 0 00-3-3h-5.379a.75.75 0 01-.53-.22L11.47 3.66A2.25 2.25 0 009.879 3H4.5a3 3 0 00-3 3v12a3 3 0 003 3h15zm-6.75-10.5a.75.75 0 00-1.5 0v4.19l-1.72-1.72a.75.75 0 00-1.06 1.06l3 3a.75.75 0 001.06 0l3-3a.75.75 0 10-1.06-1.06l-1.72 1.72V10.5z"
                                            clip-rule="evenodd" />
                                    </svg>

                                </button>
                            </div>
                        </div>
                    </li>

                    <li class="col-span-1 flex rounded-md shadow-sm">
                        <div
                            class="flex w-16 flex-shrink-0 items-center justify-center bg-yellow-500 rounded-l-md text-sm font-medium text-white">
                            MR</div>
                        <div
                            class="flex flex-1 items-center justify-between truncate rounded-r-md border-b border-r border-t border-gray-200 bg-white">
                            <div class="flex-1 truncate px-4 py-2 text-sm">
                                <a href="#" class="font-medium text-gray-900 hover:text-gray-600">Resiko Menegah
                                    Rendah</a>
                                <p class="text-gray-500">{{ number_format($resikoJateng['Menengah Rendah']) }}</p>
                            </div>
                            <div class="flex-shrink-0 pr-2">
                                <button
                                    wire:click="downloadResiko('jateng', '{{ $skalaNib }}', 'Menengah Rendah', '{{ $day_of_tanggal_terbit_oss }}', '{{ $status_pm }}', '{{ $kabkota }}', '{{ $sektor }}')"
                                    type="button"
                                    class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-transparent bg-white text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2">
                                    <span class="sr-only">Open</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                        class="w-6 h-6">
                                        <path fill-rule="evenodd"
                                            d="M19.5 21a3 3 0 003-3V9a3 3 0 00-3-3h-5.379a.75.75 0 01-.53-.22L11.47 3.66A2.25 2.25 0 009.879 3H4.5a3 3 0 00-3 3v12a3 3 0 003 3h15zm-6.75-10.5a.75.75 0 00-1.5 0v4.19l-1.72-1.72a.75.75 0 00-1.06 1.06l3 3a.75.75 0 001.06 0l3-3a.75.75 0 10-1.06-1.06l-1.72 1.72V10.5z"
                                            clip-rule="evenodd" />
                                    </svg>

                                </button>
                            </div>
                        </div>
                    </li>

                    <li class="col-span-1 flex rounded-md shadow-sm">
                        <div
                            class="flex w-16 flex-shrink-0 items-center justify-center bg-green-500 rounded-l-md text-sm font-medium text-white">
                            R</div>
                        <div
                            class="flex flex-1 items-center justify-between truncate rounded-r-md border-b border-r border-t border-gray-200 bg-white">
                            <div class="flex-1 truncate px-4 py-2 text-sm">
                                <a href="#" class="font-medium text-gray-900 hover:text-gray-600">Resiko
                                    Rendah</a>
                                <p class="text-gray-500">{{ number_format($resikoJateng['Rendah']) }}</p>
                            </div>
                            <div class="flex-shrink-0 pr-2">
                                <button
                                    wire:click="downloadResiko('jateng', '{{ $skalaNib }}', 'Rendah', '{{ $day_of_tanggal_terbit_oss }}', '{{ $status_pm }}', '{{ $kabkota }}', '{{ $sektor }}')"
                                    type="button"
                                    class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-transparent bg-white text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                                    <span class="sr-only">Open</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                        class="w-6 h-6">
                                        <path fill-rule="evenodd"
                                            d="M19.5 21a3 3 0 003-3V9a3 3 0 00-3-3h-5.379a.75.75 0 01-.53-.22L11.47 3.66A2.25 2.25 0 009.879 3H4.5a3 3 0 00-3 3v12a3 3 0 003 3h15zm-6.75-10.5a.75.75 0 00-1.5 0v4.19l-1.72-1.72a.75.75 0 00-1.06 1.06l3 3a.75.75 0 001.06 0l3-3a.75.75 0 10-1.06-1.06l-1.72 1.72V10.5z"
                                            clip-rule="evenodd" />
                                    </svg>

                                </button>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        @endif

        @if ($resiko_nib_non_jateng)
            <div class="mt-4">
                <div class="relative mb-4">
                    <div class="absolute inset-0 flex items-center" aria-hidden="true">
                        <div class="w-full border-t border-gray-300"></div>
                    </div>
                </div>
                <h2 class="mt-4 text-sm font-medium text-gray-500">Uraian NIB NON JATENG dengan skala : <span
                        class="font-extrabold">{{ $skalaNibNJ }}</span></h2>
                <button
                    wire:click="downloadSkala('non_jateng', '{{ $skalaNibNJ }}', '{{ $day_of_tanggal_terbit_oss }}', '{{ $status_pm }}', '{{ $kabkota }}', '{{ $sektor }}')"
                    type="button"
                    class="rounded-md bg-success-600 p-2 text-white shadow-sm hover:bg-success-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-success-600">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 8.25H7.5a2.25 2.25 0 00-2.25 2.25v9a2.25 2.25 0 002.25 2.25h9a2.25 2.25 0 002.25-2.25v-9a2.25 2.25 0 00-2.25-2.25H15M9 12l3 3m0 0l3-3m-3 3V2.25" />
                    </svg>
                </button>
                <ul role="list" class="mt-3 grid grid-cols-1 gap-5 sm:grid-cols-2 sm:gap-6 lg:grid-cols-4">
                    <li class="col-span-1 flex rounded-md shadow-sm">
                        <div
                            class="flex w-16 flex-shrink-0 items-center justify-center bg-pink-600 rounded-l-md text-sm font-medium text-white">
                            T</div>
                        <div
                            class="flex flex-1 items-center justify-between truncate rounded-r-md border-b border-r border-t border-gray-200 bg-white">
                            <div class="flex-1 truncate px-4 py-2 text-sm">
                                <a href="#" class="font-medium text-gray-900 hover:text-gray-600">Resiko
                                    Tinggi</a>
                                <p class="text-gray-500">{{ number_format($resikoNonJateng['Tinggi']) }}</p>
                            </div>
                            <div class="flex-shrink-0 pr-2">
                                <button
                                    wire:click="downloadResiko('non_jateng', '{{ $skalaNibNJ }}', 'Tinggi', '{{ $day_of_tanggal_terbit_oss }}', '{{ $status_pm }}', '{{ $kabkota }}', '{{ $sektor }}')"
                                    type="button"
                                    class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-transparent bg-white text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-pink-500 focus:ring-offset-2">
                                    <span class="sr-only">Open</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                        class="w-6 h-6">
                                        <path fill-rule="evenodd"
                                            d="M19.5 21a3 3 0 003-3V9a3 3 0 00-3-3h-5.379a.75.75 0 01-.53-.22L11.47 3.66A2.25 2.25 0 009.879 3H4.5a3 3 0 00-3 3v12a3 3 0 003 3h15zm-6.75-10.5a.75.75 0 00-1.5 0v4.19l-1.72-1.72a.75.75 0 00-1.06 1.06l3 3a.75.75 0 001.06 0l3-3a.75.75 0 10-1.06-1.06l-1.72 1.72V10.5z"
                                            clip-rule="evenodd" />
                                    </svg>

                                </button>
                            </div>
                        </div>
                    </li>

                    <li class="col-span-1 flex rounded-md shadow-sm">
                        <div
                            class="flex w-16 flex-shrink-0 items-center justify-center bg-purple-600 rounded-l-md text-sm font-medium text-white">
                            MT</div>
                        <div
                            class="flex flex-1 items-center justify-between truncate rounded-r-md border-b border-r border-t border-gray-200 bg-white">
                            <div class="flex-1 truncate px-4 py-2 text-sm">
                                <a href="#" class="font-medium text-gray-900 hover:text-gray-600">Resiko
                                    Menengah
                                    Tinggi</a>
                                <p class="text-gray-500">{{ number_format($resikoNonJateng['Menengah Tinggi']) }}</p>
                            </div>
                            <div class="flex-shrink-0 pr-2">
                                <button
                                    wire:click="downloadResiko('non_jateng', '{{ $skalaNibNJ }}', 'Menengah Tinggi', '{{ $day_of_tanggal_terbit_oss }}', '{{ $status_pm }}', '{{ $kabkota }}', '{{ $sektor }}')"
                                    type="button"
                                    class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-transparent bg-white text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                    <span class="sr-only">Open</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                        class="w-6 h-6">
                                        <path fill-rule="evenodd"
                                            d="M19.5 21a3 3 0 003-3V9a3 3 0 00-3-3h-5.379a.75.75 0 01-.53-.22L11.47 3.66A2.25 2.25 0 009.879 3H4.5a3 3 0 00-3 3v12a3 3 0 003 3h15zm-6.75-10.5a.75.75 0 00-1.5 0v4.19l-1.72-1.72a.75.75 0 00-1.06 1.06l3 3a.75.75 0 001.06 0l3-3a.75.75 0 10-1.06-1.06l-1.72 1.72V10.5z"
                                            clip-rule="evenodd" />
                                    </svg>

                                </button>
                            </div>
                        </div>
                    </li>

                    <li class="col-span-1 flex rounded-md shadow-sm">
                        <div
                            class="flex w-16 flex-shrink-0 items-center justify-center bg-yellow-500 rounded-l-md text-sm font-medium text-white">
                            MR</div>
                        <div
                            class="flex flex-1 items-center justify-between truncate rounded-r-md border-b border-r border-t border-gray-200 bg-white">
                            <div class="flex-1 truncate px-4 py-2 text-sm">
                                <a href="#" class="font-medium text-gray-900 hover:text-gray-600">Resiko Menegah
                                    Rendah</a>
                                <p class="text-gray-500">{{ number_format($resikoNonJateng['Menengah Rendah']) }}</p>
                            </div>
                            <div class="flex-shrink-0 pr-2">
                                <button
                                    wire:click="downloadResiko('non_jateng', '{{ $skalaNibNJ }}', 'Menengah Rendah', '{{ $day_of_tanggal_terbit_oss }}', '{{ $status_pm }}', '{{ $kabkota }}', '{{ $sektor }}')"
                                    type="button"
                                    class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-transparent bg-white text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2">
                                    <span class="sr-only">Open</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                        class="w-6 h-6">
                                        <path fill-rule="evenodd"
                                            d="M19.5 21a3 3 0 003-3V9a3 3 0 00-3-3h-5.379a.75.75 0 01-.53-.22L11.47 3.66A2.25 2.25 0 009.879 3H4.5a3 3 0 00-3 3v12a3 3 0 003 3h15zm-6.75-10.5a.75.75 0 00-1.5 0v4.19l-1.72-1.72a.75.75 0 00-1.06 1.06l3 3a.75.75 0 001.06 0l3-3a.75.75 0 10-1.06-1.06l-1.72 1.72V10.5z"
                                            clip-rule="evenodd" />
                                    </svg>

                                </button>
                            </div>
                        </div>
                    </li>

                    <li class="col-span-1 flex rounded-md shadow-sm">
                        <div
                            class="flex w-16 flex-shrink-0 items-center justify-center bg-green-500 rounded-l-md text-sm font-medium text-white">
                            R</div>
                        <div
                            class="flex flex-1 items-center justify-between truncate rounded-r-md border-b border-r border-t border-gray-200 bg-white">
                            <div class="flex-1 truncate px-4 py-2 text-sm">
                                <a href="#" class="font-medium text-gray-900 hover:text-gray-600">Resiko
                                    Rendah</a>
                                <p class="text-gray-500">{{ number_format($resikoNonJateng['Rendah']) }}</p>
                            </div>
                            <div class="flex-shrink-0 pr-2">
                                <button
                                    wire:click="downloadResiko('non_jateng', '{{ $skalaNibNJ }}', 'Rendah', '{{ $day_of_tanggal_terbit_oss }}', '{{ $status_pm }}', '{{ $kabkota }}', '{{ $sektor }}')"
                                    type="button"
                                    class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-transparent bg-white text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                                    <span class="sr-only">Open</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                        class="w-6 h-6">
                                        <path fill-rule="evenodd"
                                            d="M19.5 21a3 3 0 003-3V9a3 3 0 00-3-3h-5.379a.75.75 0 01-.53-.22L11.47 3.66A2.25 2.25 0 009.879 3H4.5a3 3 0 00-3 3v12a3 3 0 003 3h15zm-6.75-10.5a.75.75 0 00-1.5 0v4.19l-1.72-1.72a.75.75 0 00-1.06 1.06l3 3a.75.75 0 001.06 0l3-3a.75.75 0 10-1.06-1.06l-1.72 1.72V10.5z"
                                            clip-rule="evenodd" />
                                    </svg>

                                </button>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        @endif

        <div wire:loading wire:target="downloadAll, downloadResiko, downloadSkala">
            <div class="top-0 left-0 z-50 w-screen h-screen bg-gray-800 opacity-70 fixed flex items-center justify-center duration-300 transition-opacity"
                style="z-index: 6000">
                <div class="flex-col">
                    <div class="animate-pulse w-24 h-24">
                        <svg id="Layer_2" xmlns="http://www.w3.org/2000/svg"
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
        </div>
    </x-filament::section>
</x-filament::widget>
