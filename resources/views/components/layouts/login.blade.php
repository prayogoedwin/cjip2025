<!DOCTYPE html>
{{-- <html lang="en" class="light" dir="ltr"> --}}

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Central Java Invesment Platform</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta content="An Investment Platform in Central Java" name="description" />
    <meta name="author" content="dpmptspprovjateng" />
    <meta name="website" content="https://web.dpmptsp.jatengprov.go.id/" />
    <meta name="email" content="cjibf.jateng@gmail.com" />

    <meta name="version" content="1.1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- favicon -->
    <link rel="shortcut icon" href="{{ asset('images/cjip-small.png') }}">



    @filamentStyles
    @vite('resources/css/app.css')
</head>

<body class="antialiased font-nunito text-base text-black dark:text-white dark:bg-slate-900"
    style="background-image: url('https://preline.co/assets/svg/examples/polygon-bg-element.svg'); background-repeat: no-repeat; background-size: cover;">

    <main>
        @yield('content')

        @isset($slot)
            {{ $slot }}
        @endisset
    </main>

    @filamentScripts
    @vite('resources/js/app.js')
    @stack('js')

</body>

</html>
