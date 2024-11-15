<div>
    @if ($pert_ekonomi)
        @push('js')
            <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.8.0/chart.min.js"
                integrity="sha512-sW/w8s4RWTdFFSduOTGtk4isV1+190E/GghVffMA9XczdJ2MDzSzLEubKAs5h0wzgSJOQTRYyaz73L3d6RtJSg=="
                crossorigin="anonymous" referrerpolicy="no-referrer"></script>

            {{-- js pert_ekonomi --}}
            <script>
                var chartData = JSON.parse(`<?php echo $pert_ekonomi; ?>`)
                // console.log(chartData);
                const ctx = document.getElementById('myChart').getContext('2d');
                const myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: chartData.label,
                        datasets: [{
                            label: 'Pertumbuhan Ekonomi Jawa Tengah',
                            data: chartData.data,
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)',
                            ],
                            borderWidth: 2
                        }, {
                            type: 'bar',
                            label: 'Pertumbuhan Ekonomi Nasional',
                            data: chartData.data1,
                            // fill: false,
                            backgroundColor: [
                                'rgba(54, 162, 235, 0.2)',
                            ],
                            borderColor: [
                                'rgb(54, 162, 235)',
                            ],
                            borderWidth: 2
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            </script>
            {{-- js perf_investasi --}}
            <script>
                var chartData = JSON.parse(`<?php echo $perf_investasi; ?>`)
                // console.log(chartData);
                const ctx1 = document.getElementById('myChart1').getContext('2d');
                const myChart1 = new Chart(ctx1, {
                    type: 'line',
                    data: {
                        labels: chartData.label,
                        datasets: [{
                            label: 'Target',
                            data: chartData.item,
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)',
                            ],
                            borderWidth: 2,
                            tension: 0.1
                        }, {
                            type: 'line',
                            label: 'Realisasi',
                            data: chartData.item1,
                            // fill: false,
                            backgroundColor: [
                                'rgba(54, 162, 235, 0.2)',
                            ],
                            borderColor: [
                                'rgb(54, 162, 235)',
                            ],
                            borderWidth: 2,
                            tension: 0.1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            </script>
        @endpush

        <section class="relative lg:py-10 py-8">
            <div class="container">
                <div class="grid lg:grid-cols-12 md:grid-cols-2 grid-cols-1 items-center mt-5 gap-[30px]">
                    <div class="lg:col-span-4 md:order-2 order-1">
                        <div class="lg:ml-6 justify-center" style="width: auto;height: 20%;">
                            <canvas id="myChart" style="width: 20px; height: 20px;"></canvas>
                        </div>
                    </div>
                    <div class="lg:col-span-8 md:order-1 order-2 mt-8 md:mt-0">
                        <h3
                            class="mb-6 md:text-3xl text-3xl md:leading-normal leading-normal font-semibold text-black dark:text-white">

                            @if ($locale == 'id')
                                {{ $graph->graph_title_pert }}
                            @else
                                {{ $graph->graph_title_pert_en }}
                            @endif

                            {{-- <div class="h-2 bg-yellow-500 w-4/12 mt-2"></div> --}}
                        </h3>

                        <div class="text-justify lg:text-xl mt-2">
                            <p class="text-slate-400 max-w-3xl">
                                @if ($locale == 'id')
                                    {!! $graph->graph_desc_pert !!}
                                @else
                                    {!! $graph->graph_desc_pert_en !!}
                                @endif

                            </p>
                        </div>
                    </div>
                </div>
                <!--end grid-->
            </div>
            <div class="container">
                <div class="grid lg:grid-cols-12 md:grid-cols-2 grid-cols-1 items-center mt-5 gap-[30px]">
                    <div class="lg:col-span-4 md:order-2 order-1">
                        <div class="lg:ml-6" style="width: auto;height: 30%;">
                            <canvas id="myChart1" style="width: 30px; height: 30px;"></canvas>
                        </div>
                    </div>
                    <div class="lg:col-span-8 md:order-1 order-2 mt-8 md:mt-0">
                        <h3
                            class="mb-6 md:text-3xl text-3xl md:leading-normal leading-normal font-semibold text-black dark:text-white">
                            @if ($locale == 'id')
                                {{ $graph->graph_title_perf }}
                            @else
                                {{ $graph->graph_title_perf_en }}
                            @endif
                        </h3>
                        <div class="text-justify lg:text-xl">
                            <p class="text-slate-400 max-w-3xl">
                                @if ($locale == 'id')
                                    {!! $graph->graph_desc_perf !!}
                                @else
                                    {!! $graph->graph_desc_perf_en !!}
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="grid lg:grid-cols-12 md:grid-cols-2 grid-cols-1 items-center mt-10 gap-[30px]">
                    <div class="lg:col-span-7">
                        <div class="lg:mr-8">
                            <h3
                                class="mb-6 md:text-3xl text-3xl md:leading-normal leading-normal font-semibold text-black dark:text-white">
                                @if ($locale == 'id')
                                    {{ $graph->peluang_title }}
                                @else
                                    {{ $graph->peluang_title_en }}
                                @endif
                            </h3>
                            </h3>
                            <div class="text-justify lg:text-xl">
                                <p class="text-slate-400 max-w-3xl">
                                    @if ($locale == 'id')
                                        {!! $graph->peluang_desc !!}
                                    @else
                                        {!! $graph->peluang_desc_en !!}
                                    @endif

                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="lg:col-span-5 mt-8 md:mt-0">
                        <div class="grid grid-cols-1 gap-[30px]">
                            <a href="{{ route('peluang_investasi') }}">
                                <div
                                    class="group flex items-center border border-b-2 hover:border-b-yellow-500 border-b-green-600 relative overflow-hidden p-6 rounded-md shadow-md dark:shadow-gray-700 bg-gray-50 dark:bg-slate-800 hover:bg-primary-600 dark:hover:bg-primary-600 transition-all duration-500 ease-in-out">
                                    <span
                                        class="text-green-600 group-hover:text-yellow-500 text-5xl font-semibold transition-all duration-500 ease-in-out">
                                        <i data-feather="grid" class="mr-3"></i>

                                    </span>
                                    <div class="flex-1 ml-3">
                                        <h5
                                            class="text-green-600 group-hover:text-yellow-500 text-xl font-semibold transition-all duration-500 ease-in-out">
                                            {{ __('navbar.readiness', [], $locale) }}</h5>
                                    </div>
                                    <div
                                        class="absolute left-1 top-5 text-dark/[0.03] dark:text-white/[0.03] text-8xl group-hover:text-white/[0.04] transition-all duration-500 ease-in-out">
                                    </div>
                                </div>
                            </a>
                            <a href="{{ route('sektor') }}">
                                <div
                                    class="group flex items-center border border-b-2 hover:border-b-yellow-500 border-b-green-600 relative overflow-hidden p-6 rounded-md shadow-md dark:shadow-gray-700 bg-gray-50 dark:bg-slate-800 hover:bg-primary-600 dark:hover:bg-primary-600 transition-all duration-500 ease-in-out">
                                    <span
                                        class="text-green-600 group-hover:text-yellow-500 text-5xl font-semibold transition-all duration-500 ease-in-out">
                                        <i data-feather="layers" class="mr-3"></i>
                                    </span>
                                    <div class="flex-1 ml-3">
                                        <h5
                                            class="text-green-600 group-hover:text-yellow-500 text-xl font-semibold transition-all duration-500 ease-in-out">
                                            {{ __('navbar.sector', [], $locale) }}</h5>
                                        {{-- <p
                                        class="text-slate-400 group-hover:text-white/50 transition-all duration-500 ease-in-out mt-2">
                                        There are many variations of passages of Lorem Ipsum available</p> --}}
                                    </div>
                                    <div
                                        class="absolute left-1 top-5 text-dark/[0.03] dark:text-white/[0.03] text-8xl group-hover:text-white/[0.04] transition-all duration-500 ease-in-out">
                                        {{-- <i class="uil uil-tachometer-fast-alt"></i> --}}
                                    </div>
                                </div>
                            </a>

                            <a href="{{ route('peta') }}">
                                <div
                                    class="group flex items-center border border-b-2 hover:border-b-yellow-500 border-b-green-600 relative overflow-hidden p-6 rounded-md shadow-md dark:shadow-gray-700 bg-gray-50 dark:bg-slate-800 hover:bg-primary-600 dark:hover:bg-primary-600 transition-all duration-500 ease-in-out">
                                    <span
                                        class="text-green-600 group-hover:text-yellow-500 text-5xl font-semibold transition-all duration-500 ease-in-out">
                                        <i data-feather="navigation" class="mr-3"></i>
                                    </span>
                                    <div class="flex-1 ml-3">
                                        <h5
                                            class="text-green-600 group-hover:text-yellow-500 text-xl font-semibold transition-all duration-500 ease-in-out">
                                            {{ __('navbar.maps', [], $locale) }}</h5>
                                    </div>
                                    <div
                                        class="absolute left-1 top-5 text-dark/[0.03] dark:text-white/[0.03] text-8xl group-hover:text-white/[0.04] transition-all duration-500 ease-in-out">
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <!--end grid-->
            </div>
        </section>

        {{-- Table UMK --}}
        <section class="relative mt-10">
            <div class="container">
                <div class="grid md:grid-cols-12 grid-cols-1 items-center gap-[30px]">
                    <div class="md:col-span-5">
                        <div class="relative">
                            <img src="{{ asset('storage/' . $profil->umk_image) }}"
                                class="mx-auto rounded-xl shadow-sm" alt="">
                            <div class="absolute bottom-2/4 translate-y-2/4 right-0 left-0 text-center">
                            </div>
                        </div>
                    </div>
                    <!--end col-->

                    <div class="md:col-span-7">
                        <div class="lg:ml-4">
                            <h4 class="mb-6 md:text-3xl text-3xl lg:leading-normal leading-normal font-semibold">

                                @if ($locale == 'id')
                                    {{ $profil->umk_title }}
                                @else
                                    {{ $profil->umk_title_en }}
                                @endif
                                {{-- <div class="h-2 bg-yellow-500 w-48 mt-2"></div> --}}
                            </h4>
                            <div class="text-justify lg:text-xl">
                                <p class="text-slate-400 max-w-3xl text-base">
                                    @if ($locale == 'id')
                                        {!! $profil->umk_desc !!}
                                    @else
                                        {!! $profil->umk_desc_en !!}
                                    @endif


                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container mt-10">
                <nav class="relative z-0 flex border rounded-xl overflow-hidden dark:border-gray-700" aria-label="Tabs"
                    role="tablist">
                    <button type="button"
                        class="hs-tab-active:border-b-green-500 hs-tab-active:text-gray-900 dark:hs-tab-active:text-white dark:hs-tab-active:border-b-green-500 relative min-w-0 flex-1 bg-white first:border-s-0 border-s border-b-2 py-4 px-4 text-gray-500 hover:text-gray-700 text-lg font-medium text-center overflow-hidden hover:bg-gray-50 focus:z-10 focus:outline-none focus:text-green-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-gray-800 dark:border-l-gray-700 dark:border-b-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-400 active"
                        id="bar-with-underline-item-1" data-hs-tab="#bar-with-underline-1"
                        aria-controls="bar-with-underline-1" role="tab">
                        {{ __('profil.title_table', [], $locale) }}
                    </button>
                    <button type="button"
                        class="hs-tab-active:border-b-green-600 hs-tab-active:text-gray-900 dark:hs-tab-active:text-white dark:hs-tab-active:border-b-green-500 relative min-w-0 flex-1 bg-white first:border-s-0 border-s border-b-2 py-4 px-4 text-gray-500 hover:text-gray-700 text-lg font-medium text-center overflow-hidden hover:bg-gray-50 focus:z-10 focus:outline-none focus:text-green-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-gray-800 dark:border-l-gray-700 dark:border-b-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-400"
                        id="bar-with-underline-item-2" data-hs-tab="#bar-with-underline-2"
                        aria-controls="bar-with-underline-2" role="tab">
                        {{ __('beranda.education', [], $locale) }}
                    </button>
                </nav>

                <div class="mt-3">
                    <div id="bar-with-underline-1" role="tabpanel" aria-labelledby="bar-with-underline-item-1">
                        <p class="text-gray-500 dark:text-gray-400">
                            @livewire('beranda.table.umk')
                        </p>
                    </div>
                    <div id="bar-with-underline-2" class="hidden" role="tabpanel"
                        aria-labelledby="bar-with-underline-item-2">
                        <p class="text-gray-500 dark:text-gray-400">
                            @livewire('beranda.table.pendidikan')

                        </p>
                    </div>
                </div>
            </div>
        </section>
        <!--end container-->
    @endif
</div>
