<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">

    <meta name="application-name" content="{{ config('app.name') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name') }}</title>

    <link rel="shortcut icon" href="{{ asset('images/cjip-small.png') }}">

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>

    {{-- maps --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <link rel="stylesheet" href="map/cluster/dist/MarkerCluster.css" />
    <link rel="stylesheet" href="map/cluster/dist/MarkerCluster.Default.css" />
    <script src="map/cluster/dist/leaflet.markercluster-src.js"></script>

    <link rel="stylesheet" href="https://unpkg.com/leaflet-fullscreen/dist/leaflet.fullscreen.css" />
    <script src="https://unpkg.com/leaflet-fullscreen/dist/Leaflet.fullscreen.min.js"></script>
    {{-- end maps --}}

    <style>
        #map {
            position: relative;
        }

        #floating-text {
            position: absolute;
            bottom: 20px;
            right: 10px;
            z-index: 10;
            background-color: rgba(255, 255, 255, 0.8);
            padding: 10px;
            padding-top: 5px;
            padding-bottom: 5px;
            border-radius: 5px;
            box-shadow: 0 0 10px grey;
            font-size: 15px;
        }

        @media (max-width: 768px) {
            #floating-text {
                left: 50%;
                transform: translateX(-50%);
                bottom: 10px;
                right: auto;
            }
        }
    </style>

    {{-- style map --}}
    <style>
        .mapContainer {
            display: inline-block;
            position: absolute;
            width: 100%;
            height: 500px;
        }

        #opacity_area {
            width: 400px;
            height: 25px;
            background-color: rgba(0, 0, 0, 0.5);
            margin: 5px;
            font-size: 14pt;
            text-align: center;

        }
    </style>

    <style>
        html,
        body {
            height: 100%;
            margin: 0;
        }

        .leaflet-container {
            height: 400px;
            width: 100%;
            max-width: 200%;
            max-height: 200%;
        }

        .leaflet-button {
            background: white;
            position: center;
            text-align: center;
        }
    </style>

    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-143558094-1');
    </script>

    @filamentStyles
    @stack('css')
    @vite('resources/css/app.css')
</head>

<body class="antialiased">
    @yield('content')
    @isset($slot)
        {{ $slot }}
    @endisset

    @filamentScripts
    @stack('js')
    @vite('resources/js/app.js')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>

    <script src="{{ asset('map/data/bataskabkota.js') }}"></script>
    <script src="{{ asset('map/data/jawatengah.js') }}"></script>
    <script src="{{ asset('map/data/kecamatan.js') }}"></script>

    @isset($locations)
        <script>
            var map = L.map("map", {
                maxZoom: 15,
                trackResize: false
            }).setView([-7.314319095811024, 110.16720334357437], 9);

            // googleSat = L.tileLayer('http://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}', {
            //     maxZoom: 20,
            //     subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
            // });

            googleHybrid = L.tileLayer('http://{s}.google.com/vt?lyrs=s,h&x={x}&y={y}&z={z}', {
                maxZoom: 15,
                subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
            })

            var osm = L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
                maxZoom: 15
            }).addTo(map);

            // googleStreets = L.tileLayer('http://{s}.google.com/vt?lyrs=m&x={x}&y={y}&z={z}', {
            //     maxZoom: 20,
            //     subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
            // });

            // Icon Marker
            var IconReadyToOver = L.icon({
                iconUrl: '/map/1.png',
                iconSize: [40, 40], // size of the icon
                shadowSize: [50, 64],
            });
            var IconProspective = L.icon({
                iconUrl: '/map/2.png',
                iconSize: [40, 40], // size of the icon
                shadowSize: [50, 64],
            });
            var IconPotential = L.icon({
                iconUrl: '/map/3.png',
                iconSize: [40, 40], // size of the icon
                shadowSize: [50, 64],
            });

            var IconStrategi = L.icon({
                iconUrl: '/map/4.png',
                iconSize: [40, 40], // size of the icon
                shadowSize: [50, 64],
            });

            var Icon2 = L.icon({
                iconUrl: '/map/ki.png',
                iconSize: [40, 40], // size of the icon
                shadowSize: [50, 64],
            });

            // ====================================================

            // ================= marker ready to over =====================

            var markersReady = L.markerClusterGroup({
                spiderfyOnMaxZoom: true,
                showCoverageOnHover: true,
                zoomToBoundsOnClick: true
            });

            <?php foreach ($locations as $map) { ?>
            var redirect =
                '<a href="https://www.google.com/maps/search/?api=1&query=<?= $map->lat ?>,<?= $map->lng ?>" target="blank" class="btn btn-primary rounded py-1 text-sm flex justify-center mt-2 px-1 font-semibold">Google Maps</a>';
            var button =
                '<a href="{{ route('detail_investasi', $map->id) }}" class="btn btn-primary rounded py-1 text-sm flex justify-center mt-2 px-1 hover:bg-yellow-500 font-semibold">Lihat Selengkapnya</a>';
            var photoImg =
                '<img src="{{ asset('storage/' . $map->foto[0]) }}" class="rounded-lg" style="width: 100%;"/>';
            var popupproyek =

                photoImg + '<br>' +

                '<div class=" grid-cols-2">' +
                '<span class="control-label col-lg-10">Nama Proyek :</span>' +
                '<a class="">' +
                '<span class="control-label col-lg-10"><strong> <?= $map->nama ?></strong></span>' +
                '</a>' +
                '</div>' +

                '<div class=" grid-cols-2">' +
                '<span class="control-label col-lg-10">Nilai Investasi : </span>' +
                '<a class="">' +
                '<span class="control-label text-warning-500 col-lg-10"><strong> <?= $map->nilai_investasi ?> </strong></span>' +
                '</a>' +
                '</div>' +

                '<div class=" grid-cols-2">' +
                '<span class="control-label col-lg-10">Luas Lahan :</span>' +
                '<a class="">' +
                '<span class="control-label col-lg-10"><strong> <?= $map->luas_lahan ?> </strong></span>' +
                '</a>' +
                '</div>' +

                '<div class=" grid-cols-2">' +
                '<span class="control-label col-lg-10">Net Present Value (NPV) :</span>' +
                '<a class="">' +
                '<span class="control-label col-lg-10"><strong> <?= $map->npv ?> </strong></span>' +
                '</a>' +
                '</div>' +

                '<div class=" grid-cols-2">' +
                '<span class="control-label col-lg-10">Internal Rate of Return (IRR) :</span>' +
                '<a class="">' +
                '<span class="control-label col-lg-10"><strong> <?= $map->irr ?> </strong></span>' +
                '</a>' +
                '</div>' +

                '<div class=" grid-cols-2">' +
                '<span class="control-label col-lg-10">Benefit Cost Ratio (BCR) :</span>' +
                '<a class="">' +
                '<span class="control-label col-lg-10"><strong> <?= $map->bc_ratio ?> </strong></span>' +
                '</a>' +
                '</div>' +

                '<div class=" grid-cols-2">' +
                '<span class="control-label col-lg-10">Contact Person :</span>' +
                '<a class="">' +
                '<span class="control-label col-lg-10"><strong> <?= $map->cp_nama ?> </strong></span>' +
                '</a>' +
                '</div>' +

                '<div class=" grid-cols-2">' +
                '<span class="control-label col-lg-10">Email :</span>' +
                '<a class="">' +
                '<span class="control-label col-lg-10"><strong> <?= $map->cp_email ?> </strong></span>' +
                '</a>' +
                '</div>' +

                '<div class=" grid-cols-2">' +
                '<span class="control-label col-lg-10">Kabupaten/Kota :</span>' +
                '<a class="">' +
                '<span class="control-label col-lg-10"><strong> <?= $map->kabkota->nama ?> </strong></span>' +
                '</a>' +
                '</div>' +

                '<div class=" grid-cols-2">' +
                '<span class="control-label col-lg-10">Market :</span>' +
                '<a class="">' +
                '<span class="control-label italic col-lg-10"><strong> <?= $map->market->nama ?> </strong></span>' +
                '</a>' +
                '</div>' + button;
            var customOptions = {
                'maxWidth': '1080',
                'width': '1080',
                'className': 'popupCustom'
            }

            var readytoover = L.marker([<?= $map->lat ?>, <?= $map->lng ?>], {
                    icon: IconReadyToOver,
                    draggable: false,
                    shadow: true
                })
                .bindPopup(popupproyek, customOptions)

            markersReady.addLayer(readytoover);

            <?php } ?>

            // button marker
            document.getElementById('markerButton').addEventListener('click', function() {
                if (map.hasLayer(markersReady)) {
                    map.removeLayer(markersReady);
                } else {
                    map.addLayer(markersReady);
                }
            });

            // ================= marker National Strategic Project =====================

            var markersStrategi = L.markerClusterGroup({
                spiderfyOnMaxZoom: true,
                showCoverageOnHover: true,
                zoomToBoundsOnClick: true
            });

            <?php foreach ($locations3 as $map) { ?>
            var redirect =
                '<a href="https://www.google.com/maps/search/?api=1&query=<?= $map->lat ?>,<?= $map->lng ?>" target="blank" class="btn btn-primary rounded py-1 text-sm flex justify-center mt-2 px-1 font-semibold">Google Maps</a>';
            var button =
                '<a href="{{ route('detail_investasi', $map->id) }}" class="btn btn-primary hover:bg-yellow-500 rounded py-1 text-sm flex justify-center mt-2 px-1 font-semibold">Lihat Selengkapnya</a>';
            var photoImg =
                '<img src="{{ asset('storage/' . $map->foto[0]) }}" class="rounded-lg" style="width: 100%;"/>';
            var popupproyek =

                photoImg + '<br>' +

                '<div class=" grid-cols-2">' +
                '<span class="control-label col-lg-10">Nama Proyek :</span>' +
                '<a class="">' +
                '<span class="control-label col-lg-10"><strong> <?= $map->nama ?></strong></span>' +
                '</a>' +
                '</div>' +

                '<div class=" grid-cols-2">' +
                '<span class="control-label col-lg-10">Nilai Investasi : </span>' +
                '<a class="">' +
                '<span class="control-label text-warning-500 col-lg-10"><strong> <?= $map->nilai_investasi ?> </strong></span>' +
                '</a>' +
                '</div>' +

                '<div class=" grid-cols-2">' +
                '<span class="control-label col-lg-10">Luas Lahan :</span>' +
                '<a class="">' +
                '<span class="control-label col-lg-10"><strong> <?= $map->luas_lahan ?> </strong></span>' +
                '</a>' +
                '</div>' +

                '<div class=" grid-cols-2">' +
                '<span class="control-label col-lg-10">Net Present Value (NPV) :</span>' +
                '<a class="">' +
                '<span class="control-label col-lg-10"><strong> <?= $map->npv ?> </strong></span>' +
                '</a>' +
                '</div>' +

                '<div class=" grid-cols-2">' +
                '<span class="control-label col-lg-10">Internal Rate of Return (IRR) :</span>' +
                '<a class="">' +
                '<span class="control-label col-lg-10"><strong> <?= $map->irr ?> </strong></span>' +
                '</a>' +
                '</div>' +

                '<div class=" grid-cols-2">' +
                '<span class="control-label col-lg-10">Benefit Cost Ratio (BCR) :</span>' +
                '<a class="">' +
                '<span class="control-label col-lg-10"><strong> <?= $map->bc_ratio ?> </strong></span>' +
                '</a>' +
                '</div>' +

                '<div class=" grid-cols-2">' +
                '<span class="control-label col-lg-10">Contact Person :</span>' +
                '<a class="">' +
                '<span class="control-label col-lg-10"><strong> <?= $map->cp_nama ?> </strong></span>' +
                '</a>' +
                '</div>' +

                '<div class=" grid-cols-2">' +
                '<span class="control-label col-lg-10">Email :</span>' +
                '<a class="">' +
                '<span class="control-label col-lg-10"><strong> <?= $map->cp_email ?> </strong></span>' +
                '</a>' +
                '</div>' +

                '<div class=" grid-cols-2">' +
                '<span class="control-label col-lg-10">Kabupaten/Kota :</span>' +
                '<a class="">' +
                '<span class="control-label col-lg-10"><strong> <?= $map->kabkota->nama ?> </strong></span>' +
                '</a>' +
                '</div>' +

                '<div class=" grid-cols-2">' +
                '<span class="control-label col-lg-10">Market :</span>' +
                '<a class="">' +
                '<span class="control-label italic col-lg-10"><strong> <?= $map->market->nama ?> </strong></span>' +
                '</a>' +
                '</div>' + button;
            var customOptions = {
                'maxWidth': '1080',
                'width': '1080',
                'className': 'popupCustom'
            }

            var strategi = L.marker([<?= $map->lat ?>, <?= $map->lng ?>], {
                    icon: IconStrategi,
                    draggable: false,
                    shadow: true
                })
                .bindPopup(popupproyek, customOptions)

            markersStrategi.addLayer(strategi);

            <?php } ?>

            // button marker
            document.getElementById('markerButton4').addEventListener('click', function() {
                if (map.hasLayer(markersStrategi)) {
                    map.removeLayer(markersStrategi);
                } else {
                    map.addLayer(markersStrategi);
                }
            });

            // ================= marker prospective =====================

            var markersProspective = L.markerClusterGroup({
                spiderfyOnMaxZoom: true,
                showCoverageOnHover: true,
                zoomToBoundsOnClick: true
            });

            <?php foreach ($locations1 as $map) { ?>

            var redirect =
                '<a href="https://www.google.com/maps/search/?api=1&query=<?= $map->lat ?>,<?= $map->lng ?>" target="blank" class="btn btn-primary rounded py-1 text-sm flex justify-center mt-2 px-1 font-semibold">Google Maps</a>';
            var button =
                '<a href="{{ route('detail_investasi', $map->id) }}" class="btn hover:bg-yellow-500 btn-primary rounded py-1 text-sm flex justify-center mt-2 px-1 font-semibold">Lihat Selengkapnya</a>';
            var photoImg =
                '<img src="{{ asset('storage/' . $map->foto[0]) }}" class="rounded-lg" style="width: 100%;"/>';
            var popupproyek =

                photoImg + '<br>' +

                '<div class=" grid-cols-2">' +
                '<span class="control-label col-lg-10">Nama Proyek :</span>' +
                '<a class="">' +
                '<span class="control-label col-lg-10"><strong> <?= $map->nama ?></strong></span>' +
                '</a>' +
                '</div>' +

                '<div class=" grid-cols-2">' +
                '<span class="control-label col-lg-10">Nilai Investasi : </span>' +
                '<a class="">' +
                '<span class="control-label text-warning-500 col-lg-10"><strong> <?= $map->nilai_investasi ?> </strong></span>' +
                '</a>' +
                '</div>' +

                '<div class=" grid-cols-2">' +
                '<span class="control-label col-lg-10">Luas Lahan :</span>' +
                '<a class="">' +
                '<span class="control-label col-lg-10"><strong> <?= $map->luas_lahan ?> </strong></span>' +
                '</a>' +
                '</div>' +

                '<div class=" grid-cols-2">' +
                '<span class="control-label col-lg-10">Net Present Value (NPV) :</span>' +
                '<a class="">' +
                '<span class="control-label col-lg-10"><strong> <?= $map->npv ?> </strong></span>' +
                '</a>' +
                '</div>' +

                '<div class=" grid-cols-2">' +
                '<span class="control-label col-lg-10">Internal Rate of Return (IRR) :</span>' +
                '<a class="">' +
                '<span class="control-label col-lg-10"><strong> <?= $map->irr ?> </strong></span>' +
                '</a>' +
                '</div>' +

                '<div class=" grid-cols-2">' +
                '<span class="control-label col-lg-10">Benefit Cost Ratio (BCR) :</span>' +
                '<a class="">' +
                '<span class="control-label col-lg-10"><strong> <?= $map->bc_ratio ?> </strong></span>' +
                '</a>' +
                '</div>' +

                '<div class=" grid-cols-2">' +
                '<span class="control-label col-lg-10">Contact Person :</span>' +
                '<a class="">' +
                '<span class="control-label col-lg-10"><strong> <?= $map->cp_nama ?> </strong></span>' +
                '</a>' +
                '</div>' +

                '<div class=" grid-cols-2">' +
                '<span class="control-label col-lg-10">Email :</span>' +
                '<a class="">' +
                '<span class="control-label col-lg-10"><strong> <?= $map->cp_email ?> </strong></span>' +
                '</a>' +
                '</div>' +

                '<div class=" grid-cols-2">' +
                '<span class="control-label col-lg-10">Kabupaten/Kota :</span>' +
                '<a class="">' +
                '<span class="control-label col-lg-10"><strong> <?= $map->kabkota->nama ?> </strong></span>' +
                '</a>' +
                '</div>' +

                '<div class=" grid-cols-2">' +
                '<span class="control-label col-lg-10">Market :</span>' +
                '<a class="">' +
                '<span class="control-label italic col-lg-10"><strong> <?= $map->market->nama ?> </strong></span>' +
                '</a>' +
                '</div>' + button;
            var customOptions = {
                'maxWidth': '1080',
                'width': '1080',
                'className': 'popupCustom'
            }

            var prospective = L.marker([<?= $map->lat ?>, <?= $map->lng ?>], {
                    icon: IconProspective,
                    draggable: false,
                    shadow: true
                })
                .bindPopup(popupproyek, customOptions)


            markersProspective.addLayer(prospective);

            <?php } ?>

            document.getElementById('markerButton2').addEventListener('click', function() {
                if (map.hasLayer(markersProspective)) {
                    map.removeLayer(markersProspective);
                } else {
                    map.addLayer(markersProspective);
                }
            });

            // ================= marker potential =====================

            var markersPotential = L.markerClusterGroup({
                spiderfyOnMaxZoom: true,
                showCoverageOnHover: true,
                zoomToBoundsOnClick: true
            });

            <?php foreach ($locations2 as $map) { ?>

            var redirect =
                '<a href="https://www.google.com/maps/search/?api=1&query=<?= $map->lat ?>,<?= $map->lng ?>" target="blank" class="btn btn-primary rounded py-1 text-sm flex justify-center mt-2 px-1 font-semibold">Google Maps</a>';
            var button =
                '<a href="{{ route('detail_investasi', $map->id) }}" class="btn btn-primary hover:bg-yellow-500 rounded py-1 text-sm flex justify-center mt-2 px-1 font-semibold">Lihat Selengkapnya</a>';
            var photoImg =
                '<img src="{{ asset('storage/' . $map->foto[0]) }}" class="rounded-lg" style="width: 100%;"/>';
            var popupproyek =

                photoImg + '<br>' +

                '<div class=" grid-cols-2">' +
                '<span class="control-label col-lg-10">Nama Proyek :</span>' +
                '<a class="">' +
                '<span class="control-label col-lg-10"><strong> <?= $map->nama ?></strong></span>' +
                '</a>' +
                '</div>' +

                '<div class=" grid-cols-2">' +
                '<span class="control-label col-lg-10">Nilai Investasi : </span>' +
                '<a class="">' +
                '<span class="control-label text-warning-500 col-lg-10"><strong> <?= $map->nilai_investasi ?> </strong></span>' +
                '</a>' +
                '</div>' +

                '<div class=" grid-cols-2">' +
                '<span class="control-label col-lg-10">Luas Lahan :</span>' +
                '<a class="">' +
                '<span class="control-label col-lg-10"><strong> <?= $map->luas_lahan ?> </strong></span>' +
                '</a>' +
                '</div>' +

                '<div class=" grid-cols-2">' +
                '<span class="control-label col-lg-10">Net Present Value (NPV) :</span>' +
                '<a class="">' +
                '<span class="control-label col-lg-10"><strong> <?= $map->npv ?> </strong></span>' +
                '</a>' +
                '</div>' +

                '<div class=" grid-cols-2">' +
                '<span class="control-label col-lg-10">Internal Rate of Return (IRR) :</span>' +
                '<a class="">' +
                '<span class="control-label col-lg-10"><strong> <?= $map->irr ?> </strong></span>' +
                '</a>' +
                '</div>' +

                '<div class=" grid-cols-2">' +
                '<span class="control-label col-lg-10">Benefit Cost Ratio (BCR) :</span>' +
                '<a class="">' +
                '<span class="control-label col-lg-10"><strong> <?= $map->bc_ratio ?> </strong></span>' +
                '</a>' +
                '</div>' +

                '<div class=" grid-cols-2">' +
                '<span class="control-label col-lg-10">Contact Person :</span>' +
                '<a class="">' +
                '<span class="control-label col-lg-10"><strong> <?= $map->cp_nama ?> </strong></span>' +
                '</a>' +
                '</div>' +

                '<div class=" grid-cols-2">' +
                '<span class="control-label col-lg-10">Email :</span>' +
                '<a class="">' +
                '<span class="control-label col-lg-10"><strong> <?= $map->cp_email ?> </strong></span>' +
                '</a>' +
                '</div>' +

                '<div class=" grid-cols-2">' +
                '<span class="control-label col-lg-10">Kabupaten/Kota :</span>' +
                '<a class="">' +
                '<span class="control-label col-lg-10"><strong> <?= $map->kabkota->nama ?> </strong></span>' +
                '</a>' +
                '</div>' +

                '<div class=" grid-cols-2">' +
                '<span class="control-label col-lg-10">Market :</span>' +
                '<a class="">' +
                '<span class="control-label italic col-lg-10"><strong> <?= $map->market->nama ?> </strong></span>' +
                '</a>' +
                '</div>' + button;
            var customOptions = {
                'maxWidth': '1080',
                'width': '1080',
                'className': 'popupCustom'
            }

            var potential = L.marker([<?= $map->lat ?>, <?= $map->lng ?>], {
                    icon: IconPotential,
                    draggable: false,
                    shadow: true
                })
                .bindPopup(popupproyek, customOptions)

            markersPotential.addLayer(potential);

            <?php } ?>

            document.getElementById('markerButton3').addEventListener('click', function() {
                if (map.hasLayer(markersPotential)) {
                    map.removeLayer(markersPotential);
                } else {
                    map.addLayer(markersPotential);
                }
            });

            // ================= marker kawasan industri =====================

            var markersKawasan = L.markerClusterGroup({
                spiderfyOnMaxZoom: true,
                showCoverageOnHover: true,
                zoomToBoundsOnClick: true
            });

            <?php foreach ($kawasans as $map) { ?>

            var redirect =
                '<a href="https://www.google.com/maps/search/?api=1&query=<?= $map->lat ?>,<?= $map->lng ?>" target="blank" class="btn btn-primary rounded py-1 text-sm flex justify-center mt-2 px-1 font-semibold">Google Maps</a>';
            var button =
                '<a href="{{ route('detail_kawasan', $map->id) }}" class="btn btn-primary hover:bg-yellow-500 rounded py-1 text-sm flex justify-center mt-2 px-1 font-semibold">Lihat Selengkapnya</a>';
            var photoImg =
                '<img src="{{ asset('storage/' . $map->foto[0]) }}" class="rounded-lg" width="100%"/>';
            var popupkawasan =
                photoImg +
                '<div class="">' +
                '<br>' +

                '<div class=" grid-cols-2">' +
                '<span class="control-label col-lg-10">Nama Kawasan Industri :</span>' +
                '<a class="">' +
                '<span class="control-label col-lg-10"><strong> <?= $map->nama ?> </strong></span>' +
                '</a>' +
                '</div>' +

                '<div class=" grid-cols-2">' +
                '<span class="control-label col-lg-10">Koordinat :</span>' +
                '<a class="">' +
                '<span class="control-label col-lg-10"><strong> <?= $map->lat ?>, <?= $map->lng ?> </strong></span>' +
                '</a>' +
                '</div>' +

                '<div class=" grid-cols-2">' +
                '<span class="control-label col-lg-10">Jenis Kawasan Industri :</span>' +
                '<a class="">' +
                '<span class="control-label col-lg-10 italic"><strong> <?= $map->jeniskawasan->nama ?> </strong></span>' +
                '</a>' +
                '</div>' +

                '<br>' +
                '<div class=" grid-cols-2">' +
                '<span class="control-label col-lg-10">Profil Kawasan :</span>' +
                '<a class="">' +
                '<span class="control-label col-lg-10 text-justify"><strong> <?= $map->kawasan ?> </strong></span>' +
                '</a>' +
                '</div>' +

                // '<div class=" grid-cols-2">' +
                // '<span class="control-label col-lg-10">Profil Perusahaan :</span>' +
                // '<a class="">' +
                // '<span class="control-label col-lg-10 text-justify"><strong> <?= $map->perusahaan ?> </strong></span>' +
                // '</a>' +
                // '</div>' +

                '</div>' +
                button;
            var kawasanOptions = {
                'maxWidth': '600',
                'width': '600',
                'className': 'popupCustom'
            }
            var kawasans = L.marker([<?= $map->lat ?>, <?= $map->lng ?>], {
                    icon: Icon2,
                    draggable: false,
                    shadow: true
                })
                .bindPopup(popupkawasan, kawasanOptions)

            markersKawasan.addLayer(kawasans);

            <?php } ?>

            document.getElementById('markerkawasan').addEventListener('click', function() {
                if (map.hasLayer(markersKawasan)) {
                    map.removeLayer(markersKawasan);
                } else {
                    map.addLayer(markersKawasan);
                }
            });
            // ====================================================

            // ================= load geojson =====================

            var bataskota = L.geoJSON(bataskabkota, {
                onEachFeature: function(feature, layer) {
                    layer.bindPopup('<b>KAB/KOTA : </b>' +
                        feature.properties.dak_nkab)
                },
                style: function(feature) {
                    city = feature.properties.dak_nkab;
                    return {
                        fillColor: "gray",
                        fillOpacity: 0.2,
                        color: "black",
                        dashArray: '2',
                        weight: 1,
                        opacity: 0.7
                    }
                }
            });

            document.getElementById('markerbataskota').addEventListener('click', function() {
                if (map.hasLayer(bataskota)) {
                    map.removeLayer(bataskota);
                } else {
                    map.addLayer(bataskota);
                }
            });

            // batas kecamatan
            var kecamatan = new L.geoJSON(kecamatan, {
                onEachFeature: function(feature, layer) {
                    layer.bindPopup('<b>Kecamatan : </b>' +
                        feature.properties.kecamatan)
                },
                style: function(feature) {
                    city = feature.properties.kecamatan;
                    return {
                        fillColor: '#633971',
                        fillOpacity: 0,
                        color: "blue",
                        dashArray: '1',
                        weight: 1,
                        opacity: 0.7
                    }
                }
            });

            document.getElementById('kecamatan').addEventListener('click', function() {
                if (map.hasLayer(kecamatan)) {
                    map.removeLayer(kecamatan);
                } else {
                    map.addLayer(kecamatan);
                }
            });

            // batas provinsi
            var jateng = L.geoJSON(jateng, {
                onEachFeature: function(feature, layer) {
                    layer.bindPopup('<b>PROVINSI : </b>' +
                        feature.properties.PROVINSI)
                },
                style: function(feature) {
                    city = feature.properties.jateng;
                    return {
                        fillColor: '#00000',
                        fillOpacity: 0.1,
                        color: "black",
                        dashArray: '1',
                        weight: 2,
                        opacity: 0.7
                    }
                }
            }).addTo(map);

            // Base Maps
            var baseMaps = {
                "Open Street Map": osm,
                // "Google Satellite": googleSat,
                "Google Hybrid": googleHybrid,
                // "Google Streets": googleStreets,
            };

            var overlayMaps = {
                // "Batas Kabupaten/Kota": bataskota,
                // "Batas Kecamatan": kecamatan,
                // "Kawasan Industri": markerGroupKawasan,
                // "Proyek Ready To Over": markerGroupProyeks,
                // "Proyek Prospective": markerGroupProyeks1,
                // "Proyek Potential": markerGroupProyeks2,
            };

            L.control.layers(baseMaps, overlayMaps, {
                collapsed: true
            }).addTo(map);

            L.control.scale().addTo(map);

            // Tambahkan kontrol fullscreen
            map.addControl(new L.Control.Fullscreen());

            // Atur tampilan peta ke mode fullscreen saat diaktifkan
            map.on('enterFullscreen', function() {
                map.invalidateSize();
            });

            // Atur tampilan peta kembali normal saat keluar dari mode fullscreen
            map.on('exitFullscreen', function() {
                map.invalidateSize();
            });
        </script>
    @endisset

</body>
</html>
