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
    <link rel="shortcut icon" href="{{ asset('images/cjip-small.png') }}">

    <link
        href="https://fonts.googleapis.com/css2?family=Didact+Gothic&family=Rubik:ital,wght@0,300..900;1,300..900&display=swap"
        rel="stylesheet">

    <style>
        button.fi-fo-toggle.fi-color-custom.bg-custom-600 {
            /* !important is used to ensure this style takes precedence */
            background-color: #84cc16 !important; /* A vibrant lime green */
            border-color: #65a30d !important; /* A darker lime for the border */
        }

        /*
          Optional: Style the focus ring to match the new color.
        */
        button.fi-fo-toggle.fi-color-custom.bg-custom-600:focus-visible {
            --tw-ring-color: #a3e635;
        }

        /*
          Optional: Style the inner circle's background color if needed.
          By default, it's white, which usually looks good.
        */
        button.fi-fo-toggle > span {
            background-color: #ffffff;
        }
        input[name="data.status_investasi"].fi-radio-input {
            color: #65a30d !important; /* A strong lime green for the checkmark */
        }

        /*
          In dark mode, Filament also sets a background color on the checked input.
          This rule ensures our custom color is used there as well.
        */
        .dark input[name="data.status_investasi"].fi-radio-input:checked {
            background-color: #65a30d !important;
        }


        /*
          Update the focus ring to match the new lime color.
          This provides a consistent look and feel for user interaction.
        */
        input[name="data.status_investasi"].fi-radio-input:focus {
            --tw-ring-color: #84cc16 !important; /* A brighter lime for the focus ring */
            --tw-ring-offset-shadow: var(--tw-ring-inset) 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color);
            --tw-ring-shadow: var(--tw-ring-inset) 0 0 0 calc(2px + var(--tw-ring-offset-width)) var(--tw-ring-color);
            box-shadow: var(--tw-ring-offset-shadow), var(--tw-ring-shadow), var(--tw-shadow, 0 0 #0000);
        }

        input[name="data.local_plan"].fi-radio-input {
            color: #65a30d !important; /* Strong lime green */
        }

        /*
          Handles the background color for the checked state in dark mode.
        */
        .dark input[name="data.local_plan"].fi-radio-input:checked {
            background-color: #65a30d !important;
        }

        /*
          Updates the focus ring to match the lime theme.
        */
        input[name="data.local_plan"].fi-radio-input:focus {
            --tw-ring-color: #84cc16 !important; /* Brighter lime for focus */
            --tw-ring-offset-shadow: var(--tw-ring-inset) 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color);
            --tw-ring-shadow: var(--tw-ring-inset) 0 0 0 calc(2px + var(--tw-ring-offset-width)) var(--tw-ring-color);
            box-shadow: var(--tw-ring-offset-shadow), var(--tw-ring-shadow), var(--tw-shadow, 0 0 #0000);
        }
    </style>
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


            {{ $slot }}

    </main>
    @filamentScripts
    @stack('js')

    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
</body>

</html>
