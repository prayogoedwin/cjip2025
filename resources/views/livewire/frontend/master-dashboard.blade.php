<div>

    @push('css')
        <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.css" rel="stylesheet" />
    @endpush

    @push('js')
        <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.js"></script>
    @endpush
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
                        <img src="{{ asset('images/logo.png') }}" class="h-10 me-3" alt="FlowBite Logo" />
                        <span
                            class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap dark:text-white"></span>
                    </a>
                </div>
                <div class="flex items-center">
                    <div class="flex items-center ms-3">

                        <div>
                            <button type="button"
                                class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"
                                aria-expanded="false" data-dropdown-toggle="dropdown-user">
                                <span class="sr-only">Open user menu</span>
                                @if (Auth::user()->profile_photo_path)
                                    <img class="w-8 h-8 rounded-full"
                                        src="{{ asset('storage/' . Auth::user()->profile_photo_path) }}"
                                        alt="user photo">
                                @else
                                    <img class="w-8 h-8 inline-block rounded-full ring-2 cursor-pointer"
                                        style="--tw-ring-color: rgb(255 255 255);"
                                        src='https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png'
                                        alt="" id="profileMenuButton">
                                @endif
                            </button>
                        </div>
                        <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow dark:bg-gray-700 dark:divide-gray-600"
                            id="dropdown-user">
                            <div class="px-4 py-3" role="none">
                                <p class="text-sm text-gray-900 dark:text-white" role="none">
                                    {{ Auth::user()->name }}
                                </p>
                                <p class="text-sm font-medium text-gray-900 truncate dark:text-gray-300" role="none">
                                    {{ Auth::user()->email }}
                                </p>
                            </div>
                            <ul class="py-1" role="none">
                                <li>
                                    <a href="/"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                                        role="menuitem">Beranda</a>
                                </li>
                                <li>
                                    <a href="#" wire:click="logout"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                                        role="menuitem">Keluar</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <aside id="logo-sidebar"
        class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
        aria-label="Sidebar">
        <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
            <ul class="space-y-2 font-medium">
                <li>
                    <a href="{{ route('dashboard.investor') }}"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white @if (request()->is('dashboard')) bg-gray-100 @else text-black @endif hover:bg-gray-100 dark:hover:bg-gray-700 group ">
                        <svg class="w-6 h-6 @if (request()->is('dashboard')) text-green-700 @else text-black @endif text-gray-800 dark:text-white"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M11.293 3.293a1 1 0 0 1 1.414 0l6 6 2 2a1 1 0 0 1-1.414 1.414L19 12.414V19a2 2 0 0 1-2 2h-3a1 1 0 0 1-1-1v-3h-2v3a1 1 0 0 1-1 1H7a2 2 0 0 1-2-2v-6.586l-.293.293a1 1 0 0 1-1.414-1.414l2-2 6-6Z"
                                clip-rule="evenodd" />
                        </svg>

                        <span
                            class="ms-3 @if (request()->is('dashboard')) text-green-700 @else text-black @endif">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('dashboard.profile') }}"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white @if (request()->is('dashboard/profile')) bg-gray-100 @else text-black @endif hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <svg class="w-6 h-6 @if (request()->is('dashboard/profile')) text-green-700 @else text-black @endif text-gray-800 dark:text-white"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M12 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4h-4Z"
                                clip-rule="evenodd" />
                        </svg>

                        <span
                            class="flex-1 ms-3 @if (request()->is('dashboard/profile')) text-green-700 @else text-black @endif">Profile</span>
                    </a>
                </li>
                <li>
                    <button type="button"
                        class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group @if (request()->is(['dashboard/kepeminatan', 'dashboard/riwayat-kepeminatan'])) bg-gray-100 @else text-black @endif hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"
                        aria-controls="dropdown-example" data-collapse-toggle="dropdown-example">
                        <svg class="w-6 h-6 text-gray-800 dark:text-white @if (request()->is(['dashboard/kepeminatan', 'dashboard/riwayat-kepeminatan'])) text-green-700 @else text-black @endif"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M9 2a1 1 0 0 0-1 1H6a2 2 0 0 0-2 2v15a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2h-2a1 1 0 0 0-1-1H9Zm1 2h4v2h1a1 1 0 1 1 0 2H9a1 1 0 0 1 0-2h1V4Zm5.707 8.707a1 1 0 0 0-1.414-1.414L11 14.586l-1.293-1.293a1 1 0 0 0-1.414 1.414l2 2a1 1 0 0 0 1.414 0l4-4Z"
                                clip-rule="evenodd" />
                        </svg>

                        <span
                            class="flex-1 ms-3 text-left rtl:text-right @if (request()->is(['dashboard/kepeminatan', 'dashboard/riwayat-kepeminatan'])) text-green-700 @else text-black @endif">Kepeminatan</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="m1 1 4 4 4-4" />
                        </svg>
                    </button>
                    <ul id="dropdown-example" class="hidden py-2 space-y-2">
                        <li>
                            <a href="#"
                                class="@if (request()->is('dashboard/kepeminatan')) text-green-700 @else text-black @endif flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Form
                                Pengajuan</a>
                        </li>
                        <li>
                            <a href="#"
                                class="@if (request()->is('dashboard/riwayat-kepeminatan')) text-green-700 @else text-black @endif flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Riwayat
                                Pengajuann</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <button type="button"
                        class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group @if (request()->is([
                                'dashboard/product-me',
                                'dashboard/product-kemitraan',
                                'dashboard/minat-masuk',
                                'dashboard/minat-keluar',
                            ])) bg-gray-100 @else text-black @endif hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"
                        aria-controls="dropdown-mitra" data-collapse-toggle="dropdown-mitra">
                        <svg class="w-6 h-6 text-gray-800 dark:text-white @if (request()->is([
                                'dashboard/product-me',
                                'dashboard/product-kemitraan',
                                'dashboard/minat-masuk',
                                'dashboard/minat-keluar',
                            ])) text-green-700 @else text-black @endif"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M14 7h-4v3a1 1 0 0 1-2 0V7H6a1 1 0 0 0-.997.923l-.917 11.924A2 2 0 0 0 6.08 22h11.84a2 2 0 0 0 1.994-2.153l-.917-11.924A1 1 0 0 0 18 7h-2v3a1 1 0 1 1-2 0V7Zm-2-3a2 2 0 0 0-2 2v1H8V6a4 4 0 0 1 8 0v1h-2V6a2 2 0 0 0-2-2Z"
                                clip-rule="evenodd" />
                        </svg>


                        <span
                            class="flex-1 ms-3 text-left rtl:text-right @if (request()->is([
                                    'dashboard/product-me',
                                    'dashboard/product-kemitraan',
                                    'dashboard/minat-masuk',
                                    'dashboard/minat-keluar',
                                ])) text-green-700 @else text-black @endif">Kemitraan</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="m1 1 4 4 4-4" />
                        </svg>
                    </button>
                    <ul id="dropdown-mitra" class="hidden py-2 space-y-2">
                        <li>
                            <a href="#"
                                class="@if (request()->is('dashboard/product-me')) text-green-700 @else text-black @endif flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Produk
                                Saya</a>
                        </li>
                        <li>
                            <a href="#"
                                class="@if (request()->is('dashboard/product-kemitraan')) text-green-700 @else text-black @endif flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Semua
                                Produk</a>
                        </li>
                        <li>
                            <button type="button"
                                class="flex items-center w-full text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"
                                aria-controls="dropdown-minat" data-collapse-toggle="dropdown-minat">
                                <span
                                    class="flex items-center w-auto p-2 text-gray-900 transition duration-75 rounded-lg pl-11 pr- group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Minat
                                    Produk</span>
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 10 6">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 4 4 4-4" />
                                </svg>
                            </button>
                            <ul id="dropdown-minat" class="hidden py-2 space-y-2">
                                <li>
                                    <a href="#"
                                        class="@if (request()->is('dashboard/minat-masuk')) text-green-700 @else text-black @endif flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Kotak
                                        Masuk</a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="@if (request()->is('dashboard/minat-keluar')) text-green-700 @else text-black @endif flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Kotak
                                        Keluar</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>

                <li>
                    <button type="button"
                        class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group @if (request()->is(['dashboard/sinida', 'dashboard/riwayat-sinida'])) bg-gray-100 @else text-black @endif hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"
                        aria-controls="dropdown-isentif" data-collapse-toggle="dropdown-isentif">
                        <svg class="w-6 h-6 text-gray-800 @if (request()->is(['dashboard/sinida', 'dashboard/riwayat-sinida'])) text-green-700 @else text-black @endif"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M7 6a2 2 0 0 1 2-2h11a2 2 0 0 1 2 2v7a2 2 0 0 1-2 2h-2v-4a3 3 0 0 0-3-3H7V6Z"
                                clip-rule="evenodd" />
                            <path fill-rule="evenodd"
                                d="M2 11a2 2 0 0 1 2-2h11a2 2 0 0 1 2 2v7a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2v-7Zm7.5 1a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5Z"
                                clip-rule="evenodd" />
                            <path d="M10.5 14.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0Z" />
                        </svg>


                        <span
                            class="flex-1 ms-3 @if (request()->is(['dashboard/sinida', 'dashboard/riwayat-sinida'])) text-green-700 @else text-black @endif text-left rtl:text-right whitespace-nowrap">Pengajuan
                            Insentif</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="m1 1 4 4 4-4" />
                        </svg>
                    </button>
                    <ul id="dropdown-isentif" class="hidden py-2 space-y-2">
                        <li>
                            <a href="#"
                                class="flex items-center @if (request()->is('dashboard/sinida')) text-green-700 @else text-black @endif w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Form
                                Pengajuan</a>
                        </li>
                        <li>
                            <a href="#"
                                class="flex items-center @if (request()->is('dashboard/riwayat-sinida')) text-green-700 @else text-black @endif w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Riwayat
                                Pengajuan</a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="#" wire:click="logout"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2"
                                d="M20 12H8m12 0-4 4m4-4-4-4M9 4H7a3 3 0 0 0-3 3v10a3 3 0 0 0 3 3h2" />
                        </svg>

                        <span class="flex-1 ms-3 whitespace-nowrap">Keluar</span>
                    </a>
                </li>
            </ul>
        </div>
    </aside>

    <div class="p-4 sm:ml-64">
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
            @yield('content-pengguna')
        </div>
    </div>
</div>
