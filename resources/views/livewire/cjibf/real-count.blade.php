{{--
    The wire:poll directive calls the `calculateStats` method every 15 seconds.
--}}
<div wire:poll.10s="calculateStats">
    <div class="relative isolate flex min-h-screen overflow-hidden bg-gray-100 dark:bg-gray-900">

        <div aria-hidden="true" class="absolute -bottom-8 -left-96 -z-10 transform-gpu blur-3xl sm:-bottom-64 sm:-left-40 lg:-bottom-32 lg:left-8 xl:-left-10">
            <div style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"
                 class="aspect-[1266/975] w-[79.125rem] bg-gradient-to-tr from-[#0159B9] to-[#BDD41D] opacity-20"></div>
        </div>

        <div class="relative mx-auto w-full max-w-7xl px-4 py-12 sm:px-6 lg:px-8">

            <!-- New Header Section -->
            <div class="flex flex-col items-center text-center">
                <!-- Logos -->
                <div class="flex w-full items-center justify-between">
                    <div class="flex flex-shrink-0 items-center gap-x-3 sm:gap-x-6">
                        <img class="h-5 sm:h-6" src="{{asset('images/cjibf/pemprov jateng.png')}}" alt="Logo Provinsi Jawa Tengah" >
                        <img class="h-5 sm:h-6" src="{{asset('images/cjibf/bkpm.png')}}" alt="Logo Kementerian Investasi/BKPM">
                        <img class="h-5 sm:h-6" src="{{asset('images/cjibf/bank indonesia.png')}}" alt="Logo Bank Indonesia">
                    </div>
                    <div class="flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-md sm:h-12 sm:w-12">
                        <img class="h-auto w-full" src="{{asset('images/cjibf/cjibf 1.png')}}" alt="Logo CJIBF 2025">
                    </div>
                </div>

                <!-- Title and Subtitle -->
                <div class="mt-10 max-w-4xl sm:mt-12">
                    <h1 class="text-3xl font-bold tracking-tight text-transparent bg-clip-text drop-shadow bg-gradient-to-tr from-[#0159B9] to-[#BDD41D] sm:text-5xl lg:text-6xl" >
                        CENTRAL JAVA
                        <br>
                        INVESTMENT BUSINESS FORUM 2025
                    </h1>
                    <p class="mt-6 font-bold text-base/8 text-gray-900 dark:text-gray-200 sm:text-lg/8">
                        Inclusive and Sustainable Investment in Supporting Food and Renewable Energy
                    </p>
                </div>

                <!-- Title and Subtitle -->
                <div class="mt-8 w-full max-w-4xl border-t border-black/10 dark:border-white/10">
                    <h2 class="mt-6 font-bold text-lg/8 text-[#0159B9] uppercase sm:text-xl/8">
                        Real Count Kepeminatan Investasi
                    </h2>
                </div>
            </div>
            <!-- End of New Header Section -->


            <!-- Statistics Section -->
            <div class="mx-auto mt-12 max-w-2xl lg:mx-0 lg:max-w-none lg:mt-16">
                <dl class="grid grid-cols-1 gap-y-10 text-center text-gray-800 dark:text-white sm:grid-cols-3 sm:text-left">
                    <!-- Stat: Total Investasi (USD) -->
                    <div class="flex flex-col-reverse gap-y-2">
                        <dt class="text-base/6 text-transparent bg-clip-text bg-gradient-to-tr from-[#0159B9] to-[#BDD41D]">Total Investasi (USD)</dt>
                        <dd id="stat-usd" class="text-4xl font-semibold tracking-tight sm:text-5xl">{{ $totalInvestasiUsd }}</dd>
                    </div>

                    <!-- Stat: Total Investasi (Rupiah) -->
                    <div class="flex flex-col-reverse gap-y-2 border-t border-black/10 pt-8 sm:border-l sm:border-t-0 sm:pl-6 sm:pt-0">
                        <dt class="text-base/6 text-transparent bg-clip-text bg-gradient-to-tr from-[#0159B9] to-[#BDD41D]">Total Investasi (Rupiah)</dt>
                        <dd id="stat-idr" class="text-4xl font-semibold tracking-tight sm:text-5xl">{{ $totalInvestasiIdr }}</dd>
                    </div>

                    <!-- Stat: Jumlah Kepeminatan -->
                    <div class="flex flex-col-reverse gap-y-2 border-t border-black/10 pt-8 sm:border-l sm:border-t-0 sm:pl-6 sm:pt-0">
                        <dt class="text-base/6 text-transparent bg-clip-text bg-gradient-to-tr from-[#0159B9] to-[#BDD41D]">Jumlah Kepeminatan</dt>
                        <dd id="stat-kepeminatan" class="text-4xl font-semibold tracking-tight sm:text-5xl">{{ $totalKepeminatan }}</dd>
                    </div>
                </dl>
            </div>
            <!-- End of Statistics Section -->
        </div>
    </div>

</div>
