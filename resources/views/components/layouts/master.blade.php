<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Central Java Investment Platform</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta content="An Investment Platform in Central Java" name="description" />
    @yield('meta_berita')
    @yield('meta_investasi')
    @yield('meta_kawasan')
    @yield('meta_o3m')
    @yield('meta_cjibf')
    <meta name="author" content="dpmptspprovjateng" />
    <meta name="website" content="https://web.dpmptsp.jatengprov.go.id/" />
    <meta name="email" content="cjibf.jateng@gmail.com" />

    <meta name="version" content="1.1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/logo.png') }}" />

    <link
        href="https://fonts.googleapis.com/css2?family=Didact+Gothic&family=Rubik:ital,wght@0,300..900;1,300..900&display=swap"
        rel="stylesheet">

    <!-- favicon -->
    <link rel="shortcut icon" href="{{ asset('images/cjip-small.png') }}">

    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>

    @filamentStyles
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('css')
</head>

<body class="antialiased" style="font-family: Rubik, sans-serif;">

    <main>
        @yield('content')

        @isset($slot)
            {{ $slot }}
        @endisset
    </main>
    @filamentScripts
    @stack('js')

    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>

    <!-- JAVASCRIPTS -->
    {{-- <script src="{{ asset('assets/libs/tobii/js/tobii.min.js') }}"></script>
    <script src="{{ asset('assets/libs/tiny-slider/min/tiny-slider.js') }}"></script>
    <script src="{{ asset('assets/libs/swiper/js/swiper.min.js') }}"></script>
    <script src="{{ asset('assets/libs/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins.init.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script> --}}
    <!-- JAVASCRIPTS -->

    {{-- <script>
        document.addEventListener('livewire:load', function() {
            Livewire.on('reloadPage', () => {
                location.reload(); // Reload halaman
            });
        });
    </script> --}}
</body>

</html>
