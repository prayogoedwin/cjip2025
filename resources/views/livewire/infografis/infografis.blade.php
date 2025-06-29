<div>
    <div class="relative overflow-hidden before:absolute before:top-0 before:start-1/2 before:bg-[url('https://preline.co/assets/svg/examples/polygon-bg-element.svg')] before:bg-no-repeat before:bg-top before:bg-cover before:w-full before:h-full before:-z-[50] before:transform before:-translate-x-1/2 dark:before:bg-[url('https://preline.co/assets/svg/examples-dark/polygon-bg-element.svg')]">
        <div class="max-w-[85rem] mx-auto px-4 sm:px-6 lg:px-8 pt-24 pb-10">
            <div class="mt-10 max-w-2xl text-center mx-auto">
                <h1 class="block font-bold text-gray-800 text-4xl md:text-5xl lg:text-6xl dark:text-gray-200">
                    {{-- {{ __('navbar.grafis', [], $locale) }} --}}
                    INFOGRAFIS
                </h1>
            </div>
        </div>
    </div>

    <section class="relative md:py-18 py-15 mt-10">
        <div class="container">
            <div class="grid md:grid-cols-12 grid-cols-1 gap-[30px] mt-5">
                <div class="md:col-span-12">
                    <div class="grid grid-cols-1 md:grid-cols-5 gap-6">
                        <!-- Sidebar -->
                        <div class="md:col-span-1 bg-gray-50 dark:bg-gray-800 p-4 rounded-lg sticky top-4 flex flex-col" style="height: calc(100vh - 100px)">
                            <div class="font-medium text-lg mb-4">Menu</div>
                            <div class="flex-1 overflow-y-auto">
                                <div class="space-y-2">
                                    <button wire:click="selectMenu('tenaga_kerja')" class="block px-3 py-2 rounded hover:bg-gray-200 dark:hover:bg-gray-700 {{ $selectedMenu === 'tenaga_kerja' ? 'bg-gray-200 dark:bg-gray-700' : '' }}">
                                        Tenaga Kerja
                                    </button>
                                    <button wire:click="selectMenu('bkk')" class="block px-3 py-2 rounded hover:bg-gray-200 dark:hover:bg-gray-700 {{ $selectedMenu === 'bkk' ? 'bg-gray-200 dark:bg-gray-700' : '' }}">
                                        Bursa Kerja Khusus
                                    </button>
                                    <button wire:click="selectMenu('potensi_kelulusan')" class="block px-3 py-2 rounded hover:bg-gray-200 dark:hover:bg-gray-700 {{ $selectedMenu === 'potensi_kelulusan' ? 'bg-gray-200 dark:bg-gray-700' : '' }}">
                                        Potensi Kelulusan
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Main Content -->
                        <div class="md:col-span-4 bg-white dark:bg-gray-900 p-6 rounded-lg shadow-sm">
                           @if ($selectedMenu === 'tenaga_kerja')
                                <div wire:ignore 
                                    x-data="chartRenderer(@js($tenagaKerjaData), 'bar')"
                                    wire:key="chart-tenaga-kerja">
                                </div>

                                <!-- Pie Chart -->
                                <div wire:ignore 
                                    x-data="chartRenderer(@js($tenagaKerjaPieData), 'pie')"
                                    wire:key="chart-tenaga-kerja-pie">
                                </div>

                            @elseif ($selectedMenu === 'bkk')
                                <div wire:ignore 
                                    x-data="chartRenderer(@js($bkkData), 'donut')"
                                    wire:key="chart-bkk">
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- Add ApexCharts library -->
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('chartRenderer', (data, type) => ({
            chart: null,
            init() {
                this.renderChart(data, type);
                
                Livewire.on('chartChanged', () => {
                    if (this.chart) {
                        this.chart.destroy();
                    }
                    // Beri sedikit delay untuk memastikan DOM sudah update
                    setTimeout(() => {
                        this.renderChart(data, type);
                    }, 50);
                });
            },
            renderChart(data, type) {
                const textColor = window.matchMedia('(prefers-color-scheme: dark)').matches ? 
                                '#000' : '#000';
                const options = {
                    chart: { 
                        type: type,
                        height: 500,
                        animations: { enabled: false }
                    },
                    title: { text: data.title }
                };

               if (type === 'bar' || type === 'column') {
                    options.series = data.series;
                    options.xaxis = { 
                        categories: data.categories,
                        labels: { style: { colors: textColor } }
                    };
                    options.yaxis = {
                        labels: { style: { colors: textColor } }
                    };
                } else {
                    // For pie/donut charts
                    options.series = data.slices.map(s => s.value);
                    options.labels = data.slices.map(s => s.name);
                    options.colors = data.slices.map(s => s.color);
                    options.dataLabels = {
                        enabled: true,
                        formatter: function(val, opts) {
                            return opts.w.config.series[opts.seriesIndex] + 
                                ` (${Math.round(val)}%)`;
                        },
                        style: {
                            colors: [textColor],
                            fontSize: '14px'
                        }
                    };
                }

                this.chart = new ApexCharts(this.$el, options);
                this.chart.render();
            }
        }));
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>