<!DOCTYPE html>
{{-- <html lang="en" class="light" dir="ltr"> --}}

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Central Java Invesment Platform</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta content="An Investment Platform in Central Java" name="description" />
    @yield('meta_berita')
    @yield('meta_investasi')
    @yield('meta_kawasan')
    <meta name="author" content="dpmptspprovjateng" />
    <meta name="website" content="https://web.dpmptsp.jatengprov.go.id/" />
    <meta name="email" content="cjibf.jateng@gmail.com" />

    <meta name="version" content="1.1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- favicon -->
    <link rel="shortcut icon" href="{{ asset('images/cjip-small.png') }}">

    <!-- Css -->
    <link href="{{ asset('assets/libs/tobii/css/tobii.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/libs/tiny-slider/tiny-slider.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/libs/swiper/css/swiper.min.css') }}" rel="stylesheet">
    <!-- Main Css -->
    <link href="{{ asset('assets/libs/%40iconscout/unicons/css/line.css') }}" type="text/css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/css/icons.min.css') }}" />

    <link rel="stylesheet" href="{{ asset('assets/css/tailwind.css') }}" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-nunito text-base text-black dark:text-white dark:bg-slate-900"
    style="background-image: url('https://preline.co/assets/svg/examples/polygon-bg-element.svg'); background-repeat: no-repeat; background-size: cover;">

    <main>
        @yield('content')

        @isset($slot)
            {{ $slot }}
        @endisset
    </main>

    @livewireScripts
    @stack('js')

    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <!-- JAVASCRIPTS -->
    <script src="{{ asset('assets/libs/shufflejs/shuffle.min.js') }}"></script>
    <script src="{{ asset('assets/libs/tobii/js/tobii.min.js') }}"></script>
    <script src="{{ asset('assets/libs/tiny-slider/min/tiny-slider.js') }}"></script>
    <script src="{{ asset('assets/libs/swiper/js/swiper.min.js') }}"></script>
    <script src="{{ asset('assets/libs/feather-icons/feather.min.js') }}"></script>
    @stack('swiper')
    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script src="{{ asset('assets/js/plugins.init.js') }}"></script>

    <script src="https://unpkg.com/flowbite@1.5.3/dist/flowbite.js"></script>
</body>

</html>
