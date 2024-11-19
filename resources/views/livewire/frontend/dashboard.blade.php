@push('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
@endpush
<section class="bg-gray-50 dark:bg-gray-900">
    <section class="relative table w-full md:py-16 py-32 lg:py-48 bg-no-repeat bg-center bg-cover"
        style="background-image: url('{{ asset('assets/images/candi.jpg') }}')">
        <div class="absolute inset-0 bg-black opacity-70"></div>
        <div class="container">
            <div class="grid grid-cols-1 pb-8 text-center mt-10">
                <h3 class="md:text-4xl text-3xl md:leading-normal leading-normal font-medium text-white">
                    {{ $title ?? 'Dashboard' }}
                </h3>
            </div>
            <!--end grid-->
        </div>
        <!--end container-->
    </section>
    <!--end section-->
    <div class="relative">
        <div class="shape overflow-hidden z-1 text-slate-50 dark:text-slate-900">
            <svg viewBox="0 0 2880 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 48H1437.5H2880V0H2160C1442.5 52 720 0 720 0H0V48Z" fill="currentColor"></path>
            </svg>
        </div>
    </div>
    <!-- End Hero -->


    {{-- isi content --}}
    <div class="bg-slate-50 dark:bg-slate-900">
        <!-- Start -->
        <section class="relative md:py-18 py-10 mt-10">
            <div class="lg:mx-20 md:mx-8 py-5 px-8">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div class="col-span-1 md:col-span-1 bg-gray-900 text-gray-100 p-4 rounded-md">
                        @livewire('sidebar-dashboard')
                        {{-- <livewire:ajuan.sidebar> --}}
                    </div>
                    <div class="col-span-5 md:col-span-3 bg-slate-800 p-1">
                        @yield('content-pengguna')
                    </div>
                </div>
            </div>
        </section>
        <!--end section-->
        <!-- End -->
    </div>
</section>
@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
@endpush
