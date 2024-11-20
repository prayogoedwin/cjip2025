<div class="p-2">
    <h2 class="text-lg font-bold">{{ Auth::user()->name }}</h2>
    <ul class="mt-4">
        <li class="mb-2">
            <a href="{{ route('dashboard.investor') }}" class="space-x-2 rounded hover:bg-gray-700 flex items-center"><i
                    class="uil uil-clinic-medical text-lg dark:text-gray-900"></i>
                <span>Dashboard</span></a>
        </li>
        <li class="mb-2">
            <a href="{{ route('dashboard.profile') }}" class="space-x-2 rounded hover:bg-gray-700 flex items-center"><i
                    data-feather="user-check" class="w-4 h-4"></i>
                <span>Profile</span></a>
        </li>
        <li class="mb-2">
            <a href="" class="space-x-2 rounded hover:bg-gray-700 flex items-center"><i
                    class="uil uil-presentation-line text-lg"></i>
                <span>Kepemintan</span></a>
            <ul class="ml-4">
                <li class="mb-2">
                    <a href="{{ route('dashboard.kepeminatan') }}"
                        class="flex items-center space-x-2 rounded hover:bg-gray-700">- Form
                        Pengajuan</a>
                </li>
                <li class="mb-2">
                    <a href="{{ route('dashboard.riwayat-kepeminatan') }}"
                        class="flex items-center space-x-2 rounded hover:bg-gray-700">- Riwayat Pengajuan</a>
                </li>
            </ul>
        </li>
        <li class="mb-2">
            <a href="#" class="space-x-2 rounded hover:bg-gray-700 flex items-center"><i
                    class="mdi mdi-format-quote-open text-lg"></i>
                <span>Kemitraan</span></a>
            <ul class="ml-4">
                <li class="mb-2">
                    <a href="{{ route('product.me') }}" class="flex items-center space-x-2 rounded hover:bg-gray-700">-
                        Produk
                        Saya</a>
                </li>
                <li class="mb-2">
                    <a href="{{ route('product-kemitraan') }}"
                        class="flex items-center space-x-2 rounded hover:bg-gray-700">-
                        Semua
                        Produk</a>
                </li>
                <li class="mb-2">
                    <button type="button"
                        class="flex items-center w-full space-x-2 text-base transition duration-75 rounded-lg group hover:bg-gray-700 dark:text-white dark:hover:bg-gray-700"
                        aria-controls="dropdown-example" data-collapse-toggle="dropdown-example">
                        <span class="flex-1 text-left rtl:text-right whitespace-nowrap">- Minat Produk</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 4 4 4-4" />
                        </svg>
                    </button>
                    <ul id="dropdown-example" class=" py-2 space-y-2">
                        <li>
                            <a href="{{ route('kemitraan.minat-masuk') }}"
                                class="flex items-center w-full space-x-2 transition duration-75 rounded-lg pl-11 group hover:bg-gray-700 dark:text-white dark:hover:bg-gray-700">Kotak
                                Masuk
                                {{-- <span wire:poll.keep-alive
                                    class="inline-flex items-center justify-center w-4 h-4 ms-2 text-xs font-semibold text-blue-800 bg-blue-200 rounded-full">
                                    {{ $minatMasuk }}
                                </span></a> --}}
                        </li>
                        <li>
                            <a href="{{ route('kemitraan.minat-keluar') }}"
                                class="flex items-center w-full space-x-2 transition duration-75 rounded-lg pl-11 group hover:bg-gray-700 dark:text-white dark:hover:bg-gray-700">Kotak
                                Keluar
                                {{-- <span
                                    class="inline-flex items-center justify-center w-4 h-4 ms-2 text-xs font-semibold text-blue-800 bg-blue-200 rounded-full">
                                    2
                                </span> --}}
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- <li class="mb-2">
                    <a href="#" class="flex items-center space-x-2 rounded hover:bg-gray-700">- Riwayat
                        Kemitraan</a>
                </li> --}}
            </ul>
        </li>
        <li class="mb-2">
            <a href="{{ route('dashboard.sinida') }}" class="space-x-2 rounded hover:bg-gray-700 flex items-center"><i
                    class="uil uil-presentation-line text-lg"></i>
                <span>Permohonan Insentif</span>
                <svg class="h-4 w-4 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </a>
            <ul class="ml-4">
                <li class="mb-2">
                    <a href="{{ route('dashboard.sinida') }}"
                        class="flex items-center space-x-2 rounded hover:bg-gray-700">- Form
                        Pengajuan</a>
                </li>
                <li class="mb-2">
                    <a href="{{ route('dashboard.riwayat-sinida') }}"
                        class="flex items-center space-x-2 rounded hover:bg-gray-700">- Riwayat
                        Pengajuan</a>
                </li>
            </ul>
        </li>
        <li class="mb-2">
            <a wire:click="logout"
                class="flex items-center space-x-2 rounded hover:bg-gray-700 cursor-pointer">Logout</a>
        </li>
    </ul>
</div>
