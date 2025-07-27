{{--
    The wire:poll directive calls the `calculateStats` method every 10 seconds.
    This updated code is optimized for mobile-friendliness.
--}}
<div wire:poll.10s="calculateStats">
    <div class="relative isolate flex min-h-screen overflow-hidden bg-gray-100 dark:bg-gray-900">

        {{-- Decorative Background Gradient --}}
        <div aria-hidden="true" class="absolute -bottom-8 -left-96 -z-10 transform-gpu blur-3xl sm:-bottom-64 sm:-left-40 lg:-bottom-32 lg:left-8 xl:-left-10">
            <div style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"
                 class="aspect-[1266/975] w-[79.125rem] bg-gradient-to-tr from-[#0159B9] to-[#BDD41D] opacity-20"></div>
        </div>

        <main class="relative mx-auto w-full max-w-7xl px-4 py-12 sm:px-6 lg:px-8">

            {{-- Header Section --}}
            <header class="flex flex-col items-center text-center">
                {{-- Logos --}}
                <div class="flex w-full flex-wrap items-center justify-between gap-y-4">
                    {{-- Logos are now smaller on mobile (h-4) and scale up on larger screens (sm:h-6) --}}
                    <div class="flex flex-shrink-0 items-center gap-x-3 sm:gap-x-4">
                        <img class="h-4 sm:h-6" src="{{asset('images/cjibf/pemprov jateng.png')}}" alt="Logo Provinsi Jawa Tengah">
                        <img class="h-4 sm:h-6" src="{{asset('images/cjibf/bkpm.png')}}" alt="Logo Kementerian Investasi/BKPM">
                        <img class="h-4 sm:h-6" src="{{asset('images/cjibf/bank indonesia.png')}}" alt="Logo Bank Indonesia">
                    </div>
                    <div class="flex-shrink-0">
                        {{-- Main event logo is now smaller on mobile (h-10) and larger on sm+ screens (sm:h-12) --}}
                        <img class="h-10 w-auto sm:h-12" src="{{asset('images/cjibf/cjibf 1.png')}}" alt="Logo CJIBF 2025">
                    </div>
                </div>

                {{-- Main Title and Subtitle --}}
                <div class="mt-10 max-w-4xl sm:mt-12">
                    <h1 class="text-3xl font-bold tracking-tight text-transparent bg-clip-text bg-gradient-to-tr from-[#0159B9] to-[#BDD41D] sm:text-5xl lg:text-6xl">
                        CENTRAL JAVA
                        <br>
                        INVESTMENT BUSINESS FORUM 2025
                    </h1>
                    <p class="mt-6 font-bold text-base/8 text-gray-900 dark:text-gray-200 sm:text-lg/8">
                        Inclusive and Sustainable Investment in Supporting Food and Renewable Energy
                    </p>
                </div>

                {{-- Section Title --}}
                <div class="mt-8 w-full max-w-4xl border-t border-black/10 pt-6 dark:border-white/10">
                    <h2 class="font-bold text-lg/8 uppercase text-[#0159B9] sm:text-xl/8">
                        Real Count Kepeminatan Investasi
                    </h2>
                </div>
            </header>
            {{-- End of Header Section --}}

            <hr class="hidden">

            {{-- Statistics Section (Mobile-Optimized) --}}
            <div class="mx-auto mt-12 max-w-4xl">
                <dl class="flex flex-col items-center gap-y-10 text-gray-800 dark:text-white">

                    {{-- Stat 1: Total Interest --}}
                    <div class="flex flex-col-reverse text-center">
                        <dt class="text-base/6 text-transparent bg-clip-text bg-gradient-to-tr from-[#0159B9] to-[#BDD41D]">Jumlah Kepeminatan</dt>
                        <dd id="stat-kepeminatan" class="text-5xl font-semibold tracking-tight sm:text-6xl">{{ $totalKepeminatan }}</dd>
                    </div>

                    {{-- Stats 2 & 3: USD and IDR Totals --}}
                    {{-- Stacks on mobile (grid-cols-1), side-by-side on larger screens (sm:grid-cols-2) --}}
                    <div class="grid w-full max-w-7xl grid-cols-1 gap-y-10 sm:grid-cols-2 sm:gap-x-8">

                        {{-- Stat 2: Total Investment (USD) --}}
                        <div class="flex flex-col-reverse text-center sm:text-left">
                            <dt class="text-base/6 text-transparent bg-clip-text bg-gradient-to-tr from-[#0159B9] to-[#BDD41D]">Total Investasi (USD)</dt>
                            <dd id="stat-usd" class="text-4xl font-semibold tracking-tight sm:text-5xl">{{ $totalInvestasiUsd }}</dd>
                        </div>

                        {{-- Stat 3: Total Investment (Rupiah) --}}
                        {{-- Responsive border: top on mobile, left on larger screens --}}
                        <div class="flex flex-col-reverse text-center sm:text-right">
                            <dt class="text-base/6 text-transparent bg-clip-text bg-gradient-to-tr from-[#0159B9] to-[#BDD41D]">Total Investasi (Rupiah)</dt>
                            <dd id="stat-idr" class="text-4xl font-semibold tracking-tight sm:text-5xl">{{ $totalInvestasiIdr }}</dd>
                        </div>
                    </div>

                </dl>
            </div>
            {{-- End of Statistics Section --}}

        </main>

    </div>
</div>
