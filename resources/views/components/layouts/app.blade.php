<!DOCTYPE html>
<html lang="en" class="light scroll-smooth" dir="ltr">

<head>
    <meta charset="utf-8">

    <meta name="application-name" content="{{ config('app.name') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="digitizing the promotion of investment opportunities in Central Java">
    <meta name="keywords"
        content="cjip, cjibf, investasi, investasi jawa tengah, proyek jawa tengah, central java, investment central java">
    <meta name="author" content="DPMPTSPProvinsiJateng">
    <meta name="website" content="https://web.dpmptsp.jatengprov.go.id">
    <meta name="email" content="cjibf.jateng@gmail.com">
    <meta name="version" content="2.1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    @yield('meta_berita')
    @yield('meta_investasi')
    @yield('meta_kawasan')

    <!-- favicon -->
    <link rel="shortcut icon" href="{{ asset('images/cjip-small.png') }}">

    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />

    <!-- Css -->
    <link href="{{ asset('assets/libs/tobii/css/tobii.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/libs/tiny-slider/tiny-slider.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/libs/swiper/css/swiper.min.css') }}" rel="stylesheet">
    <!-- Main Css -->
    <link href="{{ asset('assets/libs/%40iconscout/unicons/css/line.css') }}" type="text/css" rel="stylesheet">
    <link href="{{ asset('assets/libs/%40mdi/font/css/materialdesignicons.min.css') }}" rel="stylesheet"
        type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/css/tailwind1.min.css') }}">

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>

    @filamentStyles
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('css')
</head>

<body class="antialiased font-nunito text-base text-black dark:text-white dark:bg-slate-900">
    <main>
        @livewire('base.navbar')
        @yield('content')
        @isset($slot)
            {{ $slot }}
        @endisset
        @livewire('base.footer')

    </main>

    @filamentScripts
    @stack('js')

    <!-- Back to top -->
    <a href="#" onclick="topFunction()" id="back-to-top"
        class="back-to-top fixed hidden text-lg rounded-full z-50 py-1 bottom-5 right-5 h-9 w-9 text-center bg-green-600 text-white leading-9"><i
            class="uil uil-arrow-up"></i>
    </a>

    {{-- whatsapp --}}
    <div class="fixed bottom-10 mb-6 m-2 -right-1 z-10 pr-4 ">
        <a href="https://wa.me/628112949326?text=Hai%20saya%20butuh%20bantuan%20CJIP" target="blank">
            <img src="{{ asset('images/whatsapp.png') }}" class="h-9 shadow-md rounded-full" alt="">
        </a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>

    <!-- JAVASCRIPTS -->
    <script src="{{ asset('assets/libs/tobii/js/tobii.min.js') }}"></script>
    <script src="{{ asset('assets/libs/tiny-slider/min/tiny-slider.js') }}"></script>
    <script src="{{ asset('assets/libs/swiper/js/swiper.min.js') }}"></script>
    <script src="{{ asset('assets/libs/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins.init.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
    <!-- JAVASCRIPTS -->

    <script>
        document.addEventListener('livewire:load', function() {
            Livewire.on('reloadPage', () => {
                location.reload(); // Reload halaman
            });
        });
    </script>
</body>

</html>
