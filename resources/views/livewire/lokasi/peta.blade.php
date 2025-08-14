<div>
    <nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-200 ">
        <div class="px-3 py-3 lg:px-5 lg:pl-3">
            <div class="flex items-center justify-between">
                <div class="flex items-center justify-start rtl:justify-end">
                    <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar"
                        aria-controls="logo-sidebar" type="button"
                        class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 ">
                        <span class="sr-only">Open sidebar</span>
                        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path clip-rule="evenodd" fill-rule="evenodd"
                                d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
                            </path>
                        </svg>
                    </button>
                    <a href="/" class="flex ms-2 md:me-24">
                        <img src="{{ asset('images/cjip.png') }}" class="h-8 me-3" alt="FlowBite Logo" />
                        <span
                            class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap text-black lg:text-center">Peta
                            Investasi Jawa Tengah</span>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <aside id="logo-sidebar"
        class="fixed top-0 left-0 z-40 w-72 h-screen pt-16 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 "
        aria-label="Sidebar">
        <div class="h-full px-3 pb-4 overflow-y-auto bg-white">
            <ul class="space-y-2 font-medium">
                <div
                    class="py-3 flex items-center text-sm text-black after:flex-[1_1_0%] after:border-t after:border-gray-200 after:ms-6 dark:after:border-gray-600">
                    Batas Administrasi</div>
                <li>
                    <a class="flex ring-1 hover:ring-yellow-500 items-center px-3 py-2  transition-colors duration-300 transform rounded-lg  hover:bg-primary-500  hover:text-yellow-500"
                        href="#" id="markerbataskota">
                        <img src="{{ asset('map/map.png') }}" class="h-5" alt="">

                        <span class="mx-2 text-sm font-medium">{{ __('map.city', [], $locale) }}</span>
                    </a>
                </li>
                <li>
                    <a class="flex ring-1 hover:ring-yellow-500 items-center px-3 py-2  transition-colors duration-300 transform rounded-lg  hover:bg-primary-500  hover:text-yellow-500"
                        href="#" id="kecamatan">
                        <img src="{{ asset('map/kec.png') }}" class="h-5" alt="">

                        <span class="mx-2 text-sm font-medium">{{ __('map.subdistrict', [], $locale) }}</span>
                    </a>
                </li>
                <div
                    class="py-3 flex items-center text-sm text-black after:flex-[1_1_0%] after:border-t after:border-gray-200 after:ms-6 dark:after:border-gray-600">
                    Proyek Investasi</div>
                <li>
                    <a class="flex ring-1 hover:ring-yellow-500 items-center px-3 py-2  transition-colors duration-300 transform rounded-lg  hover:bg-primary-500  hover:text-yellow-500"
                        href="#" id="markerButton">
                        <img src="{{ asset('map/1.png') }}" class="h-6" alt="">

                        <span class="mx-2 text-sm font-medium">{{ __('map.ready', [], $locale) }}</span>
                    </a>
                </li>
                <li>
                    <a class="flex ring-1 hover:ring-yellow-500 items-center px-3 py-2  transition-colors duration-300 transform rounded-lg  hover:bg-primary-500  hover:text-yellow-500"
                        href="#" id="markerButton4">
                        <img src="{{ asset('map/4.png') }}" class="h-6" alt="">

                        <span class="mx-2 text-sm font-medium">{{ __('map.strategi', [], $locale) }}</span>
                    </a>
                </li>
                <li>
                    <a class="flex ring-1 hover:ring-yellow-500 items-center px-3 py-2  transition-colors duration-300 transform rounded-lg  hover:bg-primary-500  hover:text-yellow-500"
                        href="#"id="markerButton2">
                        <img src="{{ asset('map/2.png') }}" class="h-6" alt="">

                        <span class="mx-2 text-sm font-medium">{{ __('map.prospective', [], $locale) }}</span>
                    </a>
                </li>
                <li>
                    <a class="flex ring-1 hover:ring-yellow-500 items-center px-3 py-2  transition-colors duration-300 transform rounded-lg  hover:bg-primary-500  hover:text-yellow-500"
                        href="#"id="markerButton3">
                        <img src="{{ asset('map/3.png') }}" class="h-6" alt="">

                        <span class="mx-2 text-sm font-medium">{{ __('map.potential', [], $locale) }}</span>
                    </a>
                </li>
                <div
                    class="py-3 flex items-center text-sm text-black after:flex-[1_1_0%] after:border-t after:border-gray-200 after:ms-6 dark:after:border-gray-600">
                    Kawasan Industri</div>
                <li>
                    <a class="flex ring-1 hover:ring-yellow-500 items-center px-3 py-2  transition-colors duration-300 transform rounded-lg  hover:bg-primary-500  hover:text-yellow-500"
                        href="#" id="markerkawasan">
                        <img src="{{ asset('map/ki.png') }}" class="h-6" alt="">

                        <span class="mx-2 text-sm font-medium">{{ __('map.industry', [], $locale) }}</span>
                    </a>
                </li>

                <div
                    class="py-3 flex items-center text-sm text-black after:flex-[1_1_0%] after:border-t after:border-gray-200 after:ms-6 dark:after:border-gray-600">
                    Ketersediaan Tenaga Kerja</div>
                <li>
                    <a class="flex ring-1 hover:ring-yellow-500 items-center px-3 py-2  transition-colors duration-300 transform rounded-lg  hover:bg-primary-500  hover:text-yellow-500"
                    href="#" id="tenagaKerja">
                    <img src="{{ asset('map/tenaga-kerja.png') }}" class="h-6" alt="">

                    <span class="mx-2 text-sm font-medium">{{ __('map.tenaga_kerja', [], $locale) }}</span>
                    </a>
                </li>
                <li>
                    <a class="flex ring-1 hover:ring-yellow-500 items-center px-3 py-2  transition-colors duration-300 transform rounded-lg  hover:bg-primary-500  hover:text-yellow-500"
                        href="#" id="potensiTenagaKerja">
                        <img src="{{ asset('map/potensi_tenaga_kerja_new.png') }}" class="h-6" alt="">

                        <span class="mx-2 text-sm font-medium">{{ __('map.potensi', [], $locale) }}</span>
                    </a>
                </li>

                <div
                    class="py-3 flex items-center text-sm text-black after:flex-[1_1_0%] after:border-t after:border-gray-200 after:ms-6 dark:after:border-gray-600">
                    Perusahaan</div>
                <li>
                    <a class="flex ring-1 hover:ring-yellow-500 items-center px-3 py-2  transition-colors duration-300 transform rounded-lg  hover:bg-primary-500  hover:text-yellow-500"
                        href="#" id="markerpma">
                        <img src="{{ asset('map/pma.png') }}" class="h-6" alt="">

                        <span class="mx-2 text-sm font-medium">{{ __('map.pma', [], $locale) }}</span>
                    </a>
                </li>
                <li>
                    <a class="flex ring-1 hover:ring-yellow-500 items-center px-3 py-2  transition-colors duration-300 transform rounded-lg  hover:bg-primary-500  hover:text-yellow-500"
                        href="#" id="markerpmdn">
                        <img src="{{ asset('map/pmdn.png') }}" class="h-6" alt="">

                        <span class="mx-2 text-sm font-medium">{{ __('map.pmdn', [], $locale) }}</span>
                    </a>
                </li>
                <div
                    class="py-3 flex items-center text-sm text-black after:flex-[1_1_0%] after:border-t after:border-gray-200 after:ms-6 dark:after:border-gray-600">
                    Infrastruktur</div>
                <li>
                    <a class="flex ring-1 hover:ring-yellow-500 items-center px-3 py-2  transition-colors duration-300 transform rounded-lg  hover:bg-primary-500  hover:text-yellow-500"
                        href="#" id="jembatanprovinsi">
                        <img src="{{ asset('map/jembatan.png') }}" class="h-5" alt="">

                        <span class="mx-2 text-sm font-medium">{{ __('map.province_bridge', [], $locale) }}</span>
                    </a>
                </li>
                <li>
                    <a class="flex ring-1 hover:ring-yellow-500 items-center px-3 py-2  transition-colors duration-300 transform rounded-lg  hover:bg-primary-500  hover:text-yellow-500"
                        href="#" id="jalanprovinsi">
                        <img src="{{ asset('map/jalan.png') }}" class="h-5" alt="">

                        <span class="mx-2 text-sm font-medium">{{ __('map.province_road', [], $locale) }}</span>
                    </a>
                </li>
                <div
                    class="py-3 flex items-center text-sm text-black after:flex-[1_1_0%] after:border-t after:border-gray-200 after:ms-6 dark:after:border-gray-600">
                    Komoditas</div>
                <li>
                    <a class="flex ring-1 hover:ring-yellow-500 items-center px-3 py-2  transition-colors duration-300 transform rounded-lg  hover:bg-primary-500  hover:text-yellow-500"
                        href="#" id="holtikultura">
                        <img src="{{ asset('map/holtikultura.png') }}" class="h-5" alt="">

                        <span class="mx-2 text-sm font-medium">{{ __('map.horticulture', [], $locale) }}</span>
                    </a>
                </li>

                <li>
                    <a class="flex ring-1 hover:ring-yellow-500 items-center px-3 py-2  transition-colors duration-300 transform rounded-lg  hover:bg-primary-500  hover:text-yellow-500"
                        href="#" id="tanamanPangan">
                        <img src="{{ asset('map/tanaman_pangan.png') }}" class="h-5" alt="">

                        <span class="mx-2 text-sm font-medium">{{ __('map.crops', [], $locale) }}</span>
                    </a>
                </li>

                <li>
                    <a class="flex ring-1 hover:ring-yellow-500 items-center px-3 py-2  transition-colors duration-300 transform rounded-lg  hover:bg-primary-500  hover:text-yellow-500"
                        href="#" id="peternakan">
                        <img src="{{ asset('map/peternakan.png') }}" class="h-5" alt="">

                        <span class="mx-2 text-sm font-medium">{{ __('map.farm', [], $locale) }}</span>
                    </a>
                </li>

                <li>
                    <a class="flex ring-1 hover:ring-yellow-500 items-center px-3 py-2  transition-colors duration-300 transform rounded-lg  hover:bg-primary-500  hover:text-yellow-500"
                        href="#" id="perkebunan">
                        <img src="{{ asset('map/perkebunan.png') }}" class="h-5" alt="">

                        <span class="mx-2 text-sm font-medium">{{ __('map.plantation', [], $locale) }}</span>
                    </a>
                </li>

                <li>
                    <a class="flex ring-1 hover:ring-yellow-500 items-center px-3 py-2  transition-colors duration-300 transform rounded-lg  hover:bg-primary-500  hover:text-yellow-500"
                        href="#" id="perikanan">
                        <img src="{{ asset('map/perikanan.png') }}" class="h-5" alt="">

                        <span class="mx-2 text-sm font-medium">{{ __('map.fishery', [], $locale) }}</span>
                    </a>
                </li>

            </ul>
        </div>
    </aside>

    <div class="sm:ml-72">
        <div
            class="mb-14 flex items-center text-sm text-gray-800 after:flex-[1_1_0%] after:border-t after:border-gray-200 after:ms-6 dark:after:border-gray-600">
        </div>
        <div class="rounded-lg dark:border-gray-700">
            <div class="z-10" style="height: 94vh; width: auto;" id="map"></div>
        </div>
    </div>

    @push('script')
        <script>
            var planes = [
                ["7C6B07", -40.99497, 174.50808],
                ["7C6B38", -41.30269, 173.63696],
                ["7C6CA1", -41.49413, 173.5421],
                ["7C6CA2", -40.98585, 174.50659],
                ["C81D9D", -40.93163, 173.81726],
                ["C82009", -41.5183, 174.78081],
                ["C82081", -41.42079, 173.5783],
                ["C820AB", -42.08414, 173.96632],
                ["C820B6", -41.51285, 173.53274]
            ];

            var Mymap = L.map('Mymap').setView([-41.3058, 174.82082], 8);
            mapLink =
                '<a href="http://openstreetmap.org">OpenStreetMap</a>';
            L.tileLayer(
                'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; ' + mapLink + ' Contributors',
                    maxZoom: 18,
                }).addTo(Mymap);

            for (var i = 0; i < planes.length; i++) {
                marker = new L.marker([planes[i][1], planes[i][2]])
                    .bindPopup(planes[i][0])
                    .addTo(Mymap);
            }
        </script>
    @endpush
</div>
