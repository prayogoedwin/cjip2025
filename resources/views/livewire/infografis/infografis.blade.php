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


<section class="relative md:py-18 py-15 mt-10" x-data="{ mobileMenuOpen: false }">
    <div class="">
        <div class="grid md:grid-cols-12 grid-cols-1 gap-[30px] mt-5">
            <div class="md:col-span-12">
                <div class="grid grid-cols-1 md:grid-cols-5 gap-6">
                    <!-- Mobile Menu Button -->
                    <div class="md:hidden">
                        <button @click="mobileMenuOpen = true" class="p-2 rounded-md bg-gray-200 dark:bg-gray-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                            <span class="sr-only">Open menu</span>
                        </button>
                    </div>

                    <!-- Overlay -->
                    <div x-show="mobileMenuOpen" @click.away="mobileMenuOpen = false" 
                         class="fixed inset-0 z-50 bg-black bg-opacity-50 md:hidden transition-opacity duration-300 flex items-center justify-center p-4"
                         x-transition:enter="ease-out duration-300"
                         x-transition:enter-start="opacity-0"
                         x-transition:enter-end="opacity-100"
                         x-transition:leave="ease-in duration-200"
                         x-transition:leave-start="opacity-100"
                         x-transition:leave-end="opacity-0">
                        
                        <!-- Sidebar Content - Center Position -->
                        <div @click.stop
                             class="bg-white dark:bg-gray-800 rounded-lg shadow-xl w-full max-w-md max-h-[80vh] overflow-y-auto"
                             x-transition:enter="ease-out duration-300"
                             x-transition:enter-start="opacity-0 scale-95"
                             x-transition:enter-end="opacity-100 scale-100"
                             x-transition:leave="ease-in duration-200"
                             x-transition:leave-start="opacity-100 scale-100"
                             x-transition:leave-end="opacity-0 scale-95">
                            <div class="p-6">
                                <div class="flex justify-between items-center mb-4">
                                    <div class="font-medium text-lg">Menu</div>
                                    <button @click="mobileMenuOpen = false" class="p-1 text-gray-500 hover:text-gray-700 dark:hover:text-gray-300">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                                <div class="space-y-2">
                                    <button wire:click="selectMenu('tenaga_kerja')" @click="mobileMenuOpen = false" class="block w-full text-left px-3 py-2 rounded hover:bg-gray-200 dark:hover:bg-gray-700 {{ $selectedMenu === 'tenaga_kerja' ? 'bg-gray-200 dark:bg-gray-700' : '' }}">
                                        Tenaga Kerja
                                    </button>
                                    <button wire:click="selectMenu('bkk')" @click="mobileMenuOpen = false" class="block w-full text-left px-3 py-2 rounded hover:bg-gray-200 dark:hover:bg-gray-700 {{ $selectedMenu === 'bkk' ? 'bg-gray-200 dark:bg-gray-700' : '' }}">
                                        Bursa Kerja Khusus
                                    </button>
                                    <button wire:click="selectMenu('potensi_kelulusan')" @click="mobileMenuOpen = false" class="block w-full text-left px-3 py-2 rounded hover:bg-gray-200 dark:hover:bg-gray-700 {{ $selectedMenu === 'potensi_kelulusan' ? 'bg-gray-200 dark:bg-gray-700' : '' }}">
                                        Potensi Kelulusan
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Regular Sidebar (Desktop) -->
                    <div class="hidden md:block md:col-span-1 bg-gray-50 dark:bg-gray-800 p-4 rounded-lg sticky top-4 flex flex-col" style="height: calc(100vh - 100px)">
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

                                <div wire:ignore 
                                    x-data="chartRenderer(@js($tenagaKerjaPendidikanData), 'bar')"
                                    wire:key="chart-tenaga-kerja-pendidikan">
                                </div>

                                <!-- Pie Chart -->
                               <div style="display: flex; gap: 20px; justify-content: center; align-items: center; min-height: 500px;">
                                    <div style="width: 45%; max-width: 500px;" wire:ignore 
                                        x-data="chartRenderer(@js($tenagaKerjaKelaminPieData), 'pie')"
                                        wire:key="chart-tenaga-kerja-pie-1">
                                    </div>

                                    <div style="width: 45%; max-width: 500px;" wire:ignore 
                                        x-data="chartRenderer(@js($tenagaKerjaPieData), 'pie')"
                                        wire:key="chart-tenaga-kerja-pie-2">
                                    </div>
                                </div>

                            @elseif ($selectedMenu === 'bkk')
                            
                                <div wire:ignore 
                                    x-data="chartRenderer(@js($bkkData), 'bar')"
                                    wire:key="chart-bkk">
                                </div>

                            @elseif ($selectedMenu === 'potensi_kelulusan')
                                <div wire:ignore 
                                    x-data="chartRenderer(@js($dapodikData), 'bar')"
                                    wire:key="chart-dapodik">
                                </div>
                            @endif

                             {{-- @elseif ($selectedMenu === 'asd')
                                <div wire:ignore 
                                    x-data="chartRenderer(@js($bkkData), 'donut')"
                                    wire:key="chart-bkk">
                                </div>
                            @endif --}}
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
                    setTimeout(() => {
                        this.renderChart(data, type);
                    }, 50);
                });
            },
            renderChart(data, type) {
                const textColor = '#000000';
                const options = {
                    chart: { 
                        type: type,
                        height: 500,
                        animations: { enabled: false },
                        foreColor: textColor,
                    },
                    title: { 
                        text: data.title,
                        style: {
                            color: textColor,
                            fontSize: '16px',
                            fontWeight: 'bold',
                        }
                    },
                    theme: {
                        mode: 'light',
                    },
                    // Nonaktifkan dataLabels secara global (opsional)
                    dataLabels: {
                        enabled: false, // <-- Matikan dataLabels di seluruh chart
                    },
                };

                if (type === 'bar' || type === 'column') {
                    options.series = data.series;
                    options.xaxis = { 
                        categories: data.categories,
                        labels: {
                            style: {
                                colors: textColor,
                                fontSize: '12px',
                            }
                        },
                    };
                    options.yaxis = {
                        labels: {
                            style: {
                                colors: textColor,
                                fontSize: '12px',
                            }
                        },
                    };
                    options.tooltip = {
                        enabled: true, // Pastikan tooltip aktif
                        theme: 'light',
                        y: {
                            formatter: function(value) {
                                return value; // Menampilkan nilai saat hover
                            }
                        },
                    };
                    // Override dataLabels untuk bar/column (jika diperlukan)
                    options.plotOptions = {
                        bar: {
                            dataLabels: {
                                enabled: false, // <-- Pastikan dataLabels mati di diagram batang
                            }
                        }
                    };
                } else if (type === 'pie' || type === 'donut') {
                    options.series = data.slices.map(s => s.value);
                    options.labels = data.slices.map(s => s.name);
                    options.colors = data.slices.map(s => s.color);
                    // Biarkan dataLabels aktif untuk pie/donut (sesuaikan kebutuhan)
                    options.dataLabels = {
                        enabled: true,
                        style: {
                            colors: [textColor],
                            fontSize: '14px',
                        },
                        formatter: function(val, opts) {
                            return opts.w.config.series[opts.seriesIndex] + ` (${Math.round(val)}%)`;
                        },
                    };
                }

                this.chart = new ApexCharts(this.$el, options);
                this.chart.render();
            },
        }));
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>