<div>
    <nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
        <div class="px-3 py-3 lg:px-5 lg:pl-3">
            <div class="flex items-center justify-between">
                <div class="flex items-center justify-start rtl:justify-end">
                    <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar"
                        aria-controls="logo-sidebar" type="button"
                        class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
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
                            class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap dark:text-white"></span>
                    </a>
                </div>
                {{-- <div class="flex items-center">
                    <div class="flex items-center ms-3">
                        <div>
                            <button type="button"
                                class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"
                                aria-expanded="false" data-dropdown-toggle="dropdown-user">
                                <span class="sr-only">Open user menu</span>
                                <img class="w-8 h-8 rounded-full"
                                    src="https://flowbite.com/docs/images/people/profile-picture-5.jpg"
                                    alt="user photo">
                            </button>
                        </div>
                        <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow dark:bg-gray-700 dark:divide-gray-600"
                            id="dropdown-user">
                            <div class="px-4 py-3" role="none">
                                <p class="text-sm text-gray-900 dark:text-white" role="none">
                                    Neil Sims
                                </p>
                                <p class="text-sm font-medium text-gray-900 truncate dark:text-gray-300" role="none">
                                    neil.sims@flowbite.com
                                </p>
                            </div>
                            <ul class="py-1" role="none">
                                <li>
                                    <a href="#"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                                        role="menuitem">Dashboard</a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                                        role="menuitem">Settings</a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                                        role="menuitem">Earnings</a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                                        role="menuitem">Sign out</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </nav>

    <aside id="logo-sidebar"
        class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
        aria-label="Sidebar">
        <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
            <ul class="space-y-2 font-medium">
                <div
                    class="py-3 flex items-center text-sm text-gray-800 after:flex-[1_1_0%] after:border-t after:border-gray-200 after:ms-6 dark:text-white dark:after:border-gray-600">
                    Batas Administrasi</div>
                <li>
                    <a class="flex ring-2 hover:ring-yellow-500 items-center px-3 py-2 text-gray-600 transition-colors duration-300 transform rounded-lg dark:text-gray-200 hover:bg-primary-500 dark:hover:bg-primary-500 dark:hover:text-gray-200 hover:text-yellow-500"
                        href="#" id="markerbataskota">
                        <img src="{{ asset('map/map.png') }}" class="h-5" alt="">

                        <span class="mx-2 text-sm font-medium">{{ __('map.city', [], $locale) }}</span>
                    </a>
                </li>
                <li>
                    <a class="flex ring-2 hover:ring-yellow-500 items-center px-3 py-2 text-gray-600 transition-colors duration-300 transform rounded-lg dark:text-gray-200 hover:bg-primary-500 dark:hover:bg-primary-500 dark:hover:text-gray-200 hover:text-yellow-500"
                        href="#" id="kecamatan">
                        <img src="{{ asset('map/kec.png') }}" class="h-5" alt="">

                        <span class="mx-2 text-sm font-medium">{{ __('map.subdistrict', [], $locale) }}</span>
                    </a>
                </li>
                <div
                    class="py-3 flex items-center text-sm text-gray-800 after:flex-[1_1_0%] after:border-t after:border-gray-200 after:ms-6 dark:text-white dark:after:border-gray-600">
                    Proyek Investasi</div>
                <li>
                    <a class="flex ring-2 hover:ring-yellow-500 items-center px-3 py-2 text-gray-600 transition-colors duration-300 transform rounded-lg dark:text-gray-200 hover:bg-primary-500 dark:hover:bg-primary-500 dark:hover:text-gray-200 hover:text-yellow-500"
                        href="#" id="markerButton">
                        <img src="{{ asset('map/1.png') }}" class="h-6" alt="">

                        <span class="mx-2 text-sm font-medium">{{ __('map.ready', [], $locale) }}</span>
                    </a>
                </li>
                <li>
                    <a class="flex ring-2 hover:ring-yellow-500 items-center px-3 py-2 text-gray-600 transition-colors duration-300 transform rounded-lg dark:text-gray-200 hover:bg-primary-500 dark:hover:bg-primary-500 dark:hover:text-gray-200 hover:text-yellow-500"
                        href="#" id="markerButton4">
                        <img src="{{ asset('map/4.png') }}" class="h-6" alt="">

                        <span class="mx-2 text-sm font-medium">{{ __('map.strategi', [], $locale) }}</span>
                    </a>
                </li>
                <li>
                    <a class="flex ring-2 hover:ring-yellow-500 items-center px-3 py-2 text-gray-600 transition-colors duration-300 transform rounded-lg dark:text-gray-200 hover:bg-primary-500 dark:hover:bg-primary-500 dark:hover:text-gray-200 hover:text-yellow-500"
                        href="#"id="markerButton2">
                        <img src="{{ asset('map/2.png') }}" class="h-6" alt="">

                        <span class="mx-2 text-sm font-medium">{{ __('map.prospective', [], $locale) }}</span>
                    </a>
                </li>
                <li>
                    <a class="flex ring-2 hover:ring-yellow-500 items-center px-3 py-2 text-gray-600 transition-colors duration-300 transform rounded-lg dark:text-gray-200 hover:bg-primary-500 dark:hover:bg-primary-500 dark:hover:text-gray-200 hover:text-yellow-500"
                        href="#"id="markerButton3">
                        <img src="{{ asset('map/3.png') }}" class="h-6" alt="">

                        <span class="mx-2 text-sm font-medium">{{ __('map.potential', [], $locale) }}</span>
                    </a>
                </li>
                <div
                    class="py-3 flex items-center text-sm text-gray-800 after:flex-[1_1_0%] after:border-t after:border-gray-200 after:ms-6 dark:text-white dark:after:border-gray-600">
                    Kawasan Industri</div>
                <li>
                    <a class="flex ring-2 hover:ring-yellow-500 items-center px-3 py-2 text-gray-600 transition-colors duration-300 transform rounded-lg dark:text-gray-200 hover:bg-primary-500 dark:hover:bg-primary-500 dark:hover:text-gray-200 hover:text-yellow-500"
                        href="#" id="markerkawasan">
                        <img src="{{ asset('map/ki.png') }}" class="h-6" alt="">

                        <span class="mx-2 text-sm font-medium">{{ __('map.industry', [], $locale) }}</span>
                    </a>
                </li>
            </ul>
        </div>
    </aside>

    <div class="sm:ml-64">
        <div
            class="py-7 flex items-center text-sm text-gray-800 after:flex-[1_1_0%] after:border-t after:border-gray-200 after:ms-6 dark:text-white dark:after:border-gray-600">
        </div>
        <div class="rounded-lg dark:border-gray-700">
            <div class="z-10" style="height: 90vh; width: auto;" id="map"></div>

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
