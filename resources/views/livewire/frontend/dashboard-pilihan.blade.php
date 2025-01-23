@extends('livewire.frontend.master-dashboard')
@section('content-pengguna')
    {{-- <div class="bg-slate-50 dark:bg-slate-900">
        <!-- Start -->
        <section class="relative md:py-18 py-10 mt-10">
            <div class="lg:mx-20 md:mx-8 py-5 px-8">
                
                <!--end container-->
            </div>
        </section>
        <!--end section-->
        <!-- End -->
    </div> --}}

    <div class="grid grid-cols-1 lg:grid-cols-1 md:grid-cols-1 gap-5">

        <a href="{{ route('dashboard.kepeminatan') }}"
            class="group hover:bg-gray-200 ring-1 ring-gray-300 relative flex flex-col md:flex-row md:space-y-0 rounded-xl shadow-lg p-3 mx-auto bg-white dark:bg-gray-800 ">
            <div class=" grid place-items-center">
                <img src="{{ asset('images/minat.png') }}" alt="tailwind logo" class="rounded-xl object-cover"
                    style="height: 200px; width: 500px;" />
            </div>
            <div class="w-full flex flex-col space-y-3 p-4">

                <h3
                    class="font-bold text-gray-800 md:text-3xl text-2xl group-hover:text-black dark:group-hover:text-white dark:text-gray-300">
                    Kepeminatan</h3>
                <p
                    class="md:text-lg text-gray-500 text-base group-hover:text-black dark:group-hover:text-white text-justify">
                    Kepeminatan ini
                    akan menjadi jembatan
                    antara investor yang berminat
                    dengan proyek
                    investasi di Jawa
                    Tengah sehingga bisa mengajukan kepeminatannya untuk dilakukan fasilitasi lebih lanjut
                    oleh DPMPTSP Provinsi maupun Kabupaten/Kota.</p>

            </div>
        </a>

        <a href="{{ route('product-kemitraan') }}"
            class="group hover:bg-gray-100 ring-1 ring-gray-300 relative flex flex-col md:flex-row md:space-y-0 rounded-xl shadow-lg p-3 mx-auto bg-white dark:bg-gray-800">
            <div class=" grid place-items-center">
                <img src="{{ asset('images/mitra.png') }}" alt="tailwind logo" class="rounded-xl object-cover"
                    style="height: 200px; width: 500px;" />
            </div>
            <div class="w-full flex flex-col space-y-3 p-4">

                <h3
                    class="font-bold text-gray-800 dark:text-gray-300 md:text-3xl text-2xl group-hover:text-black dark:group-hover:text-white">
                    Kemitraan</h3>
                <p
                    class="md:text-lg text-gray-500 text-base group-hover:text-black text-justify dark:group-hover:text-white">
                    Kemitraan
                    memberikan peluang Pelaku Usaha
                    untuk menawarkan produk/jasa maupun mencari produk/jasa yang dibutuhkan untuk menunjang operasional
                    usaha dengan skema kerja sama kemitraan antar pelaku usaha.</p>

            </div>
        </a>

        <a href="{{ route('dashboard.sinida') }}"
            class="group hover:bg-gray-100 ring-1 ring-gray-300 relative flex flex-col md:flex-row md:space-y-0 rounded-xl shadow-lg p-3 mx-auto bg-white dark:bg-gray-800">
            <div class=" grid place-items-center">
                <img src="{{ asset('images/sinida.png') }}" alt="tailwind logo" class="rounded-xl object-cover"
                    style="height: 200px; width: 500px;" />
            </div>
            <div class="w-full flex flex-col space-y-3 p-4">

                <h3
                    class="font-bold text-gray-800 md:text-3xl text-2xl group-hover:text-black dark:text-gray-300 dark:group-hover:text-white">
                    Permohonan
                    Insentif</h3>
                <p
                    class="md:text-lg text-gray-500 text-base group-hover:text-black text-justify dark:group-hover:text-white">
                    Sistem Permohonan
                    Insentif Daerah
                    dapat digunakan oleh pelaku usaha di Jawa Tengah dalam mengajukan Insentif Daerah. Pengajuan
                    tersebut akan dilakukan review dan approval berjenjang. Untuk menunjang agar pelaku usaha di
                    Jawa Tengah terbantu dan dipermudah dengan adanya pengajuan insentif daerah.</p>

            </div>
        </a>

        {{-- <a href="{{ route('product-kemitraan') }}"
            class="relative flex flex-col md:flex-row  md:space-y-0 rounded-xl shadow-lg p-3 mx-auto border border-white bg-white">
            <div class=" bg-white grid place-items-center">
                <img src="{{ asset('images/kemitraan.jpg') }}" alt="tailwind logo" class="rounded-xl object-cover"
                    style="height: 200px; width: 500px;" />
            </div>
            <div class="w-full bg-white flex flex-col space-y-2 p-3">
                <div class="flex justify-between item-center">

                </div>
                <h3 class="font-black text-gray-800 md:text-3xl text-xl">Kemitraan</h3>
                <p class="md:text-lg text-gray-500 text-base">Kemitraan
                    memberikan peluang Pelaku Usaha
                    untuk menawarkan produk/jasa maupun mencari produk/jasa yang dibutuhkan untuk menunjang operasional
                    usaha dengan skema kerja sama kemitraan antar pelaku usaha.</p>

            </div>
        </a> --}}

        {{-- <a href="{{ route('dashboard.sinida') }}"
            class="relative flex flex-col md:flex-row  md:space-y-0 rounded-xl shadow-lg p-3 mx-auto border border-white bg-white">
            <div class=" bg-white grid place-items-center">
                <img src="{{ asset('images/sinida.jpg') }}" alt="tailwind logo" class="rounded-xl object-cover"
                    style="height: 200px; width: 500px;" />
            </div>
            <div class="w-full bg-white flex flex-col space-y-2 p-3">
                <div class="flex justify-between item-center">

                </div>
                <h3 class="font-black text-gray-800 md:text-3xl text-xl">Permohonan
                    Insentif</h3>
                <p class="md:text-lg text-gray-500 text-base">Sistem Permohonan
                    Insentif Daerah
                    dapat digunakan oleh pelaku usaha di Jawa Tengah dalam mengajukan Insentif Daerah. Pengajuan
                    tersebut akan dilakukan review dan approval berjenjang. Untuk menunjang agar pelaku usaha di
                    Jawa Tengah terbantu dan dipermudah dengan adanya pengajuan insentif daerah.</p>

            </div>
        </a> --}}
    </div>
@endsection
