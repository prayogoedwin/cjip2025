<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">

    <meta name="application-name" content="{{ config('app.name') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cjip - Peta Investasi</title>
    <meta name="author" content="dpmptspprovjateng" />
    <meta name="website" content="https://web.dpmptsp.jatengprov.go.id/" />
    <meta name="email" content="cjibf.jateng@gmail.com" />
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
    @stack('css')
    {{-- <link rel="stylesheet" href="{{ mix('/css/app.css') }}" /> --}}
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="antialiased">
    @yield('content')
    @isset($slot)
        {{ $slot }}
    @endisset

    @filamentScripts
    @stack('js')
    {{-- <script src="{{ mix('js/app.js') }}" defer></script> --}}

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>

    <script src="{{ asset('map/data/bataskabkota.js') }}"></script>
    <script src="{{ asset('map/data/jawatengah.js') }}"></script>
    <script src="{{ asset('map/data/kecamatan.js') }}"></script>
    <script src="{{ asset('map/data/jalan_provinsi.js') }}"></script>

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
            var Icon4 = L.icon({
                iconUrl: '/map/pma.png',
                iconSize: [50, 50], // size of the icon
                shadowSize: [50, 64],
            });
            var Icon5 = L.icon({
                iconUrl: '/map/pmdn.png',
                iconSize: [50, 50], // size of the icon
                shadowSize: [50, 64],
            });

            var Icon3 = L.icon({
                iconUrl: '/map/jembatan.png',
                iconSize: [50, 50], // size of the icon
                shadowSize: [50, 64],
            });

            var Icon6 = L.icon({
                iconUrl: '/map/holtikultura.png',
                iconSize: [50, 50], // size of the icon
                shadowSize: [50, 64],
            });
            var Icon7 = L.icon({
                iconUrl: '/map/tanaman_pangan.png',
                iconSize: [50, 50], // size of the icon
                shadowSize: [50, 64],
            });
            var Icon8 = L.icon({
                iconUrl: '/map/peternakan.png',
                iconSize: [50, 50], // size of the icon
                shadowSize: [50, 64],
            });
            var Icon9 = L.icon({
                iconUrl: '/map/perkebunan.png',
                iconSize: [50, 50], // size of the icon
                shadowSize: [50, 64],
            });
            var Icon10 = L.icon({
                iconUrl: '/map/perikanan.png',
                iconSize: [50, 50], // size of the icon
                shadowSize: [50, 64],
            });

            var Icon11 = L.icon({
                iconUrl: '/map/tenaga-kerja.png',
                iconSize: [50, 50], // size of the icon
                shadowSize: [50, 64],
            });

            var Icon12 = L.icon({
                iconUrl: '/map/potensi_tenaga_kerja_new.png',
                iconSize: [50, 50], // size of the icon
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
                var element = this;

                if (element.classList.contains('active')) {
                    element.classList.remove('active');
                    element.classList.remove('text-yellow-500');
                    element.classList.remove('ring-yellow-500');
                } else {
                    element.classList.add('active');
                    element.classList.add('text-yellow-500'); // Active color
                    element.classList.add('ring-yellow-500'); // Active color
                }
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
                var element = this;

                if (element.classList.contains('active')) {
                    element.classList.remove('active');
                    element.classList.remove('text-yellow-500');
                    element.classList.remove('ring-yellow-500');
                } else {
                    element.classList.add('active');
                    element.classList.add('text-yellow-500'); // Active color
                    element.classList.add('ring-yellow-500'); // Active color
                }
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
                var element = this;

                if (element.classList.contains('active')) {
                    element.classList.remove('active');
                    element.classList.remove('text-yellow-500');
                    element.classList.remove('ring-yellow-500');
                } else {
                    element.classList.add('active');
                    element.classList.add('text-yellow-500'); // Active color
                    element.classList.add('ring-yellow-500'); // Active color
                }
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
                var element = this;

                if (element.classList.contains('active')) {
                    element.classList.remove('active');
                    element.classList.remove('text-yellow-500');
                    element.classList.remove('ring-yellow-500');
                } else {
                    element.classList.add('active');
                    element.classList.add('text-yellow-500'); // Active color
                    element.classList.add('ring-yellow-500'); // Active color
                }
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
                var element = this;

                if (element.classList.contains('active')) {
                    element.classList.remove('active');
                    element.classList.remove('text-yellow-500');
                    element.classList.remove('ring-yellow-500');
                } else {
                    element.classList.add('active');
                    element.classList.add('text-yellow-500'); // Active color
                    element.classList.add('ring-yellow-500'); // Active color
                }
                if (map.hasLayer(markersKawasan)) {
                    map.removeLayer(markersKawasan);
                } else {
                    map.addLayer(markersKawasan);
                }
            });
            // ====================================================


            // ================= marker pencaker =======================
            var markersPencaker = L.markerClusterGroup({
                spiderfyOnMaxZoom: true,
                showCoverageOnHover: true,
                zoomToBoundsOnClick: true
            });

            <?php foreach ($pencakers as $map) { ?>

            var redirect =
                '<a href="https://bursakerja.jatengprov.go.id/home/register_penyedia_kerja/" target="blank" class="btn btn-primary rounded py-1 text-sm flex justify-center mt-2 px-1 font-semibold">Buat Lowongan di Emakaryo</a>';
           
            var popupkawasan =
                '<div class="">' +
                 '<h4 style="margin-bottom: 15px; text-align: center;">Ketersediaan Tenaga Kerja</h4>' +
                 '<h4 style="margin-bottom: 15px; text-align: center;"><?= $map->kota ?></h4>' +
                '<div class=" grid-cols-2">' +
                '<span class="control-label col-lg-10">Laki-laki :</span>' +
                '<a class="">' +
                '<span class="control-label col-lg-10"><strong> <?= $map->l ?> </strong></span>' +
                '</a>' +
                '</div>' +
                '<div class=" grid-cols-2">' +
                '<span class="control-label col-lg-10">Perempuan :</span>' +
                '<a class="">' +
                '<span class="control-label col-lg-10"><strong> <?= $map->p ?> </strong></span>' +
                '</a>' +
                '</div>' +

                '<div class=" grid-cols-2">' +
                '<span class="control-label col-lg-10">Lulusan SMA/SMK :</span>' +
                '<a class="">' +
                '<span class="control-label col-lg-10"><strong> <?= $map->lulusan_sma_smk ?> </strong></span>' +
                '</a>' +
                '</div>' +

                '<div class=" grid-cols-2">' +
                '<span class="control-label col-lg-10">Lulusan Dibawah SMA/SMK :</span>' +
                '<a class="">' +
                '<span class="control-label col-lg-10"><strong> <?= $map->lulusan_dibawah_sma_smk ?> </strong></span>' +
                '</a>' +
                '</div>' +

                 '<div class=" grid-cols-2">' +
                '<span class="control-label col-lg-10">Lulusan Sarjana :</span>' +
                '<a class="">' +
                '<span class="control-label col-lg-10"><strong> <?= $map->lulusan_sarjana_keatas ?> </strong></span>' +
                '</a>' +
                '</div>' +


                '<br>' +
                '</div>'+
                redirect;

            var kawasanOptions = {
                'maxWidth': '600',
                'width': '600',
                'className': 'popupCustom'
            };

            var kawasans = L.marker([<?= $map->lat ?>, <?= $map->lng ?>], {
                    icon: Icon11,
                    draggable: false,
                    shadow: true
                })
                .bindPopup(popupkawasan, kawasanOptions);

            markersPencaker.addLayer(kawasans);
            <?php } ?>

            document.getElementById('tenagaKerja').addEventListener('click', function() {
                var element = this;

                if (element.classList.contains('active')) {
                    element.classList.remove('active');
                    element.classList.remove('text-yellow-500');
                    element.classList.remove('ring-yellow-500');
                } else {
                    element.classList.add('active');
                    element.classList.add('text-yellow-500'); // Active color
                    element.classList.add('ring-yellow-500'); // Active color
                }
                if (map.hasLayer(markersPencaker)) {
                    map.removeLayer(markersPencaker);
                } else {
                    map.addLayer(markersPencaker);
                }
            });


            // ================= marker kelulusan =======================
            var markersKelulusan = L.markerClusterGroup({
                spiderfyOnMaxZoom: true,
                showCoverageOnHover: true,
                zoomToBoundsOnClick: true
            });

            <?php foreach ($kelulusans as $map) { ?>

            var redirect =
                '<a href="https://bursakerja.jatengprov.go.id/home/register_penyedia_kerja/" target="blank" class="btn btn-primary rounded py-1 text-sm flex justify-center mt-2 px-1 font-semibold">Hubungi BKK</a>';
           
            var popupkawasan =
                '<div class="">' +
                 '<h4 style="margin-bottom: 15px; text-align: center;">Potensi Kelulusan</h4>' +
                 '<h4 style="margin-bottom: 15px; text-align: center;"><?= $map->kab_kota ?></h4>' +
                '<div class=" grid-cols-2">' +
                '<span class="control-label col-lg-10">Laki-laki :</span>' +
                '<a class="">' +
                '<span class="control-label col-lg-10"><strong> <?= $map->total_laki ?> </strong></span>' +
                '</a>' +
                '</div>' +
                '<div class=" grid-cols-2">' +
                '<span class="control-label col-lg-10">Perempuan :</span>' +
                '<a class="">' +
                '<span class="control-label col-lg-10"><strong> <?= $map->total_perempuan ?> </strong></span>' +
                '</a>' +
                '</div>' +

                '<div class=" grid-cols-2">' +
                '<span class="control-label col-lg-10">Potensi Lulusan SMA/SMK :</span>' +
                '<a class="">' +
                '<span class="control-label col-lg-10"><strong> <?= $map->total_potensi ?> </strong></span>' +
                '</a>' +
                '</div>' +

                '<br>' +
                '</div>'+
                redirect;

            var kawasanOptions = {
                'maxWidth': '600',
                'width': '600',
                'className': 'popupCustom'
            };

            var kawasans = L.marker([<?= $map->lat ?>, <?= $map->lng ?>], {
                    icon: Icon12,
                    draggable: false,
                    shadow: true
                })
                .bindPopup(popupkawasan, kawasanOptions);

            markersKelulusan.addLayer(kawasans);
            <?php } ?>

            document.getElementById('potensiTenagaKerja').addEventListener('click', function() {
                var element = this;

                if (element.classList.contains('active')) {
                    element.classList.remove('active');
                    element.classList.remove('text-yellow-500');
                    element.classList.remove('ring-yellow-500');
                } else {
                    element.classList.add('active');
                    element.classList.add('text-yellow-500'); // Active color
                    element.classList.add('ring-yellow-500'); // Active color
                }
                if (map.hasLayer(markersKelulusan)) {
                    map.removeLayer(markersKelulusan);
                } else {
                    map.addLayer(markersKelulusan);
                }
            });


            // ================= marker pma =======================
            var markersPma = L.markerClusterGroup({
                spiderfyOnMaxZoom: true,
                showCoverageOnHover: true,
                zoomToBoundsOnClick: true
            });

            <?php foreach ($pma as $map) { ?>
            var redirect =
                '<a href="<?= url('daftar-pma-pmdn/' . $map->kab_kota_id . '/PMA') ?>" target="_blank" class="btn btn-primary rounded py-1 text-sm flex justify-center mt-2 px-1 font-semibold">Lihat Daftar PMA</a>';

            var popupkawasan =
                '<div class="">' +
                '<br>' +
                '<div class=" grid-cols-2">' +
                '<span class="control-label col-lg-10">Jumlah PMA :</span>' +
                '<a class="">' +
                '<span class="control-label col-lg-10"><strong> <?= $map->total ?> </strong></span>' +
                '</a>' +
                '</div>' +
                '<div class=" grid-cols-2">' +
                '<span class="control-label col-lg-10">Lokasi :</span>' +
                '<a class="">' +
                '<span class="control-label col-lg-10"><strong> <?= $map->nama ?> </strong></span>' +
                '</a>' +
                '</div>' +
                '<br>' +
                '</div>' +
                redirect;

            var kawasanOptions = {
                'maxWidth': '600',
                'width': '600',
                'className': 'popupCustom'
            };

            var kawasans = L.marker([<?= $map->lat ?>, <?= $map->lng ?>], {
                    icon: Icon4,
                    draggable: false,
                    shadow: true
                })
                .bindPopup(popupkawasan, kawasanOptions);

            markersPma.addLayer(kawasans);
            <?php } ?>

            document.getElementById('markerpma').addEventListener('click', function() {
                var element = this;

                if (element.classList.contains('active')) {
                    element.classList.remove('active');
                    element.classList.remove('text-yellow-500');
                    element.classList.remove('ring-yellow-500');
                } else {
                    element.classList.add('active');
                    element.classList.add('text-yellow-500'); // Active color
                    element.classList.add('ring-yellow-500'); // Active color
                }
                if (map.hasLayer(markersPma)) {
                    map.removeLayer(markersPma);
                } else {
                    map.addLayer(markersPma);
                }
            });

            // ================= marker pmdn =======================
            var markersPmdn = L.markerClusterGroup({
                spiderfyOnMaxZoom: true,
                showCoverageOnHover: true,
                zoomToBoundsOnClick: true
            });

            <?php foreach ($pmdn as $map) { ?>
            var redirect =
                '<a href="<?= url('daftar-pma-pmdn/' . $map->kab_kota_id . '/PMDN') ?>" target="blank" class="btn btn-primary rounded py-1 text-sm flex justify-center mt-2 px-1 font-semibold">Lihat Daftar PMDN</a>';

            var popupkawasan =
                '<div class="">' +
                '<br>' +
                '<div class=" grid-cols-2">' +
                '<span class="control-label col-lg-10">Jumlah PMDN :</span>' +
                '<a class="">' +
                '<span class="control-label col-lg-10"><strong> <?= $map->total ?> </strong></span>' +
                '</a>' +
                '</div>' +
                '<div class=" grid-cols-2">' +
                '<span class="control-label col-lg-10">Lokasi :</span>' +
                '<a class="">' +
                '<span class="control-label col-lg-10"><strong> <?= $map->nama ?> </strong></span>' +
                '</a>' +
                '</div>' +
                '<br>' +
                '</div>' +
                redirect;

            var kawasanOptions = {
                'maxWidth': '600',
                'width': '600',
                'className': 'popupCustom'
            };

            var kawasans = L.marker([<?= $map->lat ?>, <?= $map->lng ?>], {
                    icon: Icon5,
                    draggable: false,
                    shadow: true
                })
                .bindPopup(popupkawasan, kawasanOptions);

            markersPmdn.addLayer(kawasans);
            <?php } ?>

            document.getElementById('markerpmdn').addEventListener('click', function() {
                var element = this;

                if (element.classList.contains('active')) {
                    element.classList.remove('active');
                    element.classList.remove('text-yellow-500');
                    element.classList.remove('ring-yellow-500');
                } else {
                    element.classList.add('active');
                    element.classList.add('text-yellow-500'); // Active color
                    element.classList.add('ring-yellow-500'); // Active color
                }
                if (map.hasLayer(markersPmdn)) {
                    map.removeLayer(markersPmdn);
                } else {
                    map.addLayer(markersPmdn);
                }
            });


            // ================= marker jembatan =======================
            var markersJembatan = L.markerClusterGroup({
                spiderfyOnMaxZoom: true,
                showCoverageOnHover: true,
                zoomToBoundsOnClick: true
            });

            <?php foreach ($jembatans as $map) { 
                $latitude = floatval($map['geometry']['coordinates'][1]);
                $longitude = floatval($map['geometry']['coordinates'][0]);
            ?>
            // var redirect =
            //     '<a href="#" target="blank" class="btn btn-primary rounded py-1 text-sm flex justify-center mt-2 px-1 font-semibold">Lihat Daftar PMDN</a>';

            var popupkawasan =
                '<div class="">' +
                '<br>' +
                '<div class=" grid-cols-2">' +
                '<span class="control-label col-lg-10">Nama Jembatan :</span>' +
                '<a class="">' +
                '<span class="control-label col-lg-10"><strong><?= $map['properties']['nama'] ?></strong></span>' +
                '</a>' +
                '</div>' +
                '<div class=" grid-cols-2">' +
                '<span class="control-label col-lg-10">Unker :</span>' +
                '<a class="">' +
                '<span class="control-label col-lg-10"><strong><?= $map['properties']['unker'] ?></strong></span>' +
                '</a>' +
                '</div>' +
                '<br>' +
                '</div>'
            // +
            // redirect
            ;

            var kawasanOptions = {
                'maxWidth': '600',
                'width': '600',
                'className': 'popupCustom'
            };

            var kawasans = L.marker([<?= $latitude ?>, <?= $longitude ?>], {
                    icon: Icon3,
                    draggable: false,
                    shadow: true
                })
                .bindPopup(popupkawasan, kawasanOptions);

            markersJembatan.addLayer(kawasans);
            <?php } ?>

            document.getElementById('jembatanprovinsi').addEventListener('click', function() {
                var element = this;

                if (element.classList.contains('active')) {
                    element.classList.remove('active');
                    element.classList.remove('text-yellow-500');
                    element.classList.remove('ring-yellow-500');
                } else {
                    element.classList.add('active');
                    element.classList.add('text-yellow-500'); // Active color
                    element.classList.add('ring-yellow-500'); // Active color
                }
                event.preventDefault();
                if (map.hasLayer(markersJembatan)) {
                    map.removeLayer(markersJembatan);
                } else {
                    map.addLayer(markersJembatan);
                }
            });


            // ================= marker holtikultura =======================
            var markersHoltikultura = L.markerClusterGroup({
                spiderfyOnMaxZoom: true,
                showCoverageOnHover: true,
                zoomToBoundsOnClick: true
            });

            <?php foreach ($holtikulturas['data'] as $map) { ?>

            var popupkawasan =
                '<div class="">' +
                '<br>' +
                '<div class=" grid-cols-2">' +
                '<span class="control-label col-lg-10">Kabupaten :</span>' +
                '<a class="">' +
                '<span class="control-label col-lg-10"><strong> <?= $map['kabupaten'] ?> </strong></span>' +
                '</a>' +
                '</div>' +
                '<br>' +
                '<div class=" grid-cols-2">' +
                '<span class="control-label col-lg-10">Tahun :</span>' +
                '<a class="">' +
                '<span class="control-label col-lg-10"><strong> <?= $holtikulturas['tahun'] ?> </strong></span>' +
                '</a>' +
                '</div>' +
                '<br>' +
                '<div class=" grid-cols-2">' +
                '<span class="control-label col-lg-10">Sumber :</span>' +
                '<a target="_blank" href="https://jateng.bps.go.id/indicator/56/<?= $holtikulturas['kode'] ?>/1/produksi-buah-buahan-menurut-jenis-tanaman-dan-kabupaten-kota-di-provinsi-jawa-tengah.html" class="">' +
                '<span class="control-label col-lg-10"><strong> BPS </strong></span>' +
                '</a>' +
                '</div>' +
                '<br>';

            <?php foreach ($map['komoditi'] as $komoditi) { ?>
            popupkawasan +=
                '<div class=" grid-cols-2">' +
                '<span class="control-label col-lg-10">Komoditi :</span>' +
                '<a class="">' +
                '<span class="control-label col-lg-10"><strong> <?= $komoditi['nama'] ?> </strong></span>' +
                '</a>' +
                '</div>' +
                '<div class=" grid-cols-2">' +
                '<span class="control-label col-lg-10">Jumlah :</span>' +
                '<a class="">' +
                '<span class="control-label col-lg-10"><strong> <?= $komoditi['value'] . ' ' . $map['satuan'] ?> </strong></span>' +
                '</a>' +
                '</div>' +
                '<br>';
            <?php } ?>

            popupkawasan += '</div>';

            var kawasanOptions = {
                'maxWidth': '600',
                'width': '600',
                'className': 'popupCustom'
            };

            var kawasans = L.marker([<?= $map['lat'] ?>, <?= $map['lng'] ?>], {
                    icon: Icon6,
                    draggable: false,
                    shadow: true
                })
                .bindPopup(popupkawasan, kawasanOptions);

            markersHoltikultura.addLayer(kawasans);
            <?php } ?>

            document.getElementById('holtikultura').addEventListener('click', function() {
                var element = this;

                if (element.classList.contains('active')) {
                    element.classList.remove('active');
                    element.classList.remove('text-yellow-500');
                    element.classList.remove('ring-yellow-500');
                } else {
                    element.classList.add('active');
                    element.classList.add('text-yellow-500'); // Active color
                    element.classList.add('ring-yellow-500'); // Active color
                }
                event.preventDefault();
                if (map.hasLayer(markersHoltikultura)) {
                    map.removeLayer(markersHoltikultura);
                } else {
                    map.addLayer(markersHoltikultura);
                }
            });

            // ================= marker tanamanPangan =======================
            var markerstanamanPangan = L.markerClusterGroup({
                spiderfyOnMaxZoom: true,
                showCoverageOnHover: true,
                zoomToBoundsOnClick: true
            });

            <?php foreach ($tanamanPangans['data'] as $map) { ?>

            var popupkawasan =
                '<div class=" grid-cols-2">' +
                '<a class="">' +
                '<span class="control-label col-lg-10"><strong> <?= $tanamanPangans['label'] ?></strong></span>' +
                '</a>' +
                '</div>' +
                '<br>' +
                '<div class=" grid-cols-2">' +
                '<span class="control-label col-lg-10">Kabupaten :</span>' +
                '<a class="">' +
                '<span class="control-label col-lg-10"><strong> <?= $map['kabupaten'] ?> </strong></span>' +
                '</a>' +
                '</div>' +
                '<br>' +
                '<div class=" grid-cols-2">' +
                '<span class="control-label col-lg-10">Tahun :</span>' +
                '<a class="">' +
                '<span class="control-label col-lg-10"><strong> <?= $tanamanPangans['tahun'] ?> </strong></span>' +
                '</a>' +
                '</div>' +
                '<br>' +
                '<div class=" grid-cols-2">' +
                '<span class="control-label col-lg-10">Sumber :</span>' +
                '<a target="_blank" href="https://jateng.bps.go.id/indicator/56/<?= $tanamanPangans['kode'] ?>/1/luas-panen-produksi-dan-produktivitas-padi-menurut-kabupaten-kota-di-provinsi-jawa-tengah.html" class="">' +
                '<span class="control-label col-lg-10"><strong> BPS </strong></span>' +
                '</a>' +
                '</div>' +
                '<br>';

            <?php foreach ($map['komoditi'] as $tanaman_pangan) { ?>
            popupkawasan +=
                '<div class=" grid-cols-2">' +
                '<a class="">' +
                '<span class="control-label col-lg-10"><strong> <?= $tanaman_pangan['nama'] ?> : <?= $tanaman_pangan['value'] ?></strong></span>' +
                '</a>' +
                '</div>' +
                '<br>';
            <?php } ?>

            popupkawasan += '</div>';

            var kawasanOptions = {
                'maxWidth': '600',
                'width': '600',
                'className': 'popupCustom'
            };

            var lat = <?= $map['lat'] ?? 'null' ?>;
            var lng = <?= $map['lng'] ?? 'null' ?>;

            if (lat !== null && lng !== null) {
                var kawasans = L.marker([lat, lng], {
                    icon: Icon7,
                    draggable: false,
                    shadow: true
                }).bindPopup(popupkawasan, kawasanOptions);

                markerstanamanPangan.addLayer(kawasans);
            }
            <?php } ?>

            document.getElementById('tanamanPangan').addEventListener('click', function(event) {
                var element = this;

                if (element.classList.contains('active')) {
                    element.classList.remove('active');
                    element.classList.remove('text-yellow-500');
                    element.classList.remove('ring-yellow-500');
                } else {
                    element.classList.add('active');
                    element.classList.add('text-yellow-500'); // Active color
                    element.classList.add('ring-yellow-500'); // Active color
                }
                event.preventDefault();
                if (map.hasLayer(markerstanamanPangan)) {
                    map.removeLayer(markerstanamanPangan);
                } else {
                    map.addLayer(markerstanamanPangan);
                }
            });


            // ================= marker peternakan =======================
            var markersPeternakan = L.markerClusterGroup({
                spiderfyOnMaxZoom: true,
                showCoverageOnHover: true,
                zoomToBoundsOnClick: true
            });

            <?php foreach ($peternakans['data'] as $map) { ?>

            var popupkawasan =
                '<div class=" grid-cols-2">' +
                '<a class="">' +
                '<span class="control-label col-lg-10"><strong> <?= $peternakans['label'] ?></strong></span>' +
                '</a>' +
                '</div>' +
                '<br>' +
                '<div class=" grid-cols-2">' +
                '<span class="control-label col-lg-10">Kabupaten :</span>' +
                '<a class="">' +
                '<span class="control-label col-lg-10"><strong> <?= $map['kabupaten'] ?> </strong></span>' +
                '</a>' +
                '</div>' +
                '<br>' +
                '<div class=" grid-cols-2">' +
                '<span class="control-label col-lg-10">Tahun :</span>' +
                '<a class="">' +
                '<span class="control-label col-lg-10"><strong> <?= $peternakans['tahun'] ?> </strong></span>' +
                '</a>' +
                '</div>' +
                '<br>' +
                '<div class=" grid-cols-2">' +
                '<span class="control-label col-lg-10">Sumber :</span>' +
                '<a target="_blank" href="https://jateng.bps.go.id/indicator/56/<?= $peternakans['kode'] ?>/1/produksi-kulit-menurut-jenis-ternak-dan-kabupaten-kota-di-provinsi-jawa-tengah.html" class="">' +
                '<span class="control-label col-lg-10"><strong> BPS </strong></span>' +
                '</a>' +
                '</div>' +
                '<br>';

            <?php foreach ($map['komoditi'] as $komoditi) { ?>
            popupkawasan +=
                '<div class=" grid-cols-2">' +
                '<a class="">' +
                '<span class="control-label col-lg-10"><strong> <?= $komoditi['nama'] ?> : <?= $komoditi['value'] . ' ' . $map['satuan'] ?></strong></span>' +
                '</a>' +
                '</div>' +
                '<br>';
            <?php } ?>

            popupkawasan += '</div>';

            var kawasanOptions = {
                'maxWidth': '600',
                'width': '600',
                'className': 'popupCustom'
            };

            var lat = <?= $map['lat'] ?? 'null' ?>;
            var lng = <?= $map['lng'] ?? 'null' ?>;

            if (lat !== null && lng !== null) {
                var kawasans = L.marker([lat, lng], {
                    icon: Icon8,
                    draggable: false,
                    shadow: true
                }).bindPopup(popupkawasan, kawasanOptions);

                markersPeternakan.addLayer(kawasans);
            }
            <?php } ?>

            document.getElementById('peternakan').addEventListener('click', function(event) {
                var element = this;

                if (element.classList.contains('active')) {
                    element.classList.remove('active');
                    element.classList.remove('text-yellow-500');
                    element.classList.remove('ring-yellow-500');
                } else {
                    element.classList.add('active');
                    element.classList.add('text-yellow-500'); // Active color
                    element.classList.add('ring-yellow-500'); // Active color
                }
                event.preventDefault();
                if (map.hasLayer(markersPeternakan)) {
                    map.removeLayer(markersPeternakan);
                } else {
                    map.addLayer(markersPeternakan);
                }
            });


            // ================= marker perkebunan =======================
            var markersPerkebunan = L.markerClusterGroup({
                spiderfyOnMaxZoom: true,
                showCoverageOnHover: true,
                zoomToBoundsOnClick: true
            });

            <?php foreach ($perkebunans['data'] as $map) { ?>

            var popupkawasan =
                '<div class=" grid-cols-2">' +
                '<a class="">' +
                '<span class="control-label col-lg-10"><strong> <?= $perkebunans['label'] ?></strong></span>' +
                '</a>' +
                '</div>' +
                '<br>' +
                '<div class=" grid-cols-2">' +
                '<span class="control-label col-lg-10">Kabupaten :</span>' +
                '<a class="">' +
                '<span class="control-label col-lg-10"><strong> <?= $map['kabupaten'] ?> </strong></span>' +
                '</a>' +
                '</div>' +
                '<br>' +
                '<div class=" grid-cols-2">' +
                '<span class="control-label col-lg-10">Sumber :</span>' +
                '<a target="_blank" href="https://jateng.bps.go.id/indicator/56/<?= $perkebunans['kode'] ?>/1/produksi-perkebunan-rakyat-menurut-jenis-tanaman-dan-kabupaten-kota-di-provinsi-jawa-tengah.html" class="">' +
                '<span class="control-label col-lg-10"><strong> BPS </strong></span>' +
                '</a>' +
                '</div>' +
                '<br>';

            <?php foreach ($map['komoditi'] as $komoditi) { ?>
            popupkawasan +=
                '<div class=" grid-cols-2">' +
                '<span class="control-label col-lg-10">Komoditi :</span>' +
                '<a class="">' +
                '<span class="control-label col-lg-10"><strong> <?= $komoditi['nama'] ?> </strong></span>' +
                '</a>' +
                '</div>' +
                '<div class=" grid-cols-2">' +
                '<span class="control-label col-lg-10">Jumlah :</span>' +
                '<a class="">' +
                '<span class="control-label col-lg-10"><strong> <?= $komoditi['value'] . ' ' . $map['satuan'] ?> </strong></span>' +
                '</a>' +
                '</div>' +
                '<br>';
            <?php } ?>

            popupkawasan += '</div>';

            var kawasanOptions = {
                'maxWidth': '600',
                'width': '600',
                'className': 'popupCustom'
            };

            var kawasans = L.marker([<?= $map['lat'] ?>, <?= $map['lng'] ?>], {
                    icon: Icon9,
                    draggable: false,
                    shadow: true
                })
                .bindPopup(popupkawasan, kawasanOptions);

            markersPerkebunan.addLayer(kawasans);
            <?php } ?>

            document.getElementById('perkebunan').addEventListener('click', function() {
                var element = this;

                if (element.classList.contains('active')) {
                    element.classList.remove('active');
                    element.classList.remove('text-yellow-500');
                    element.classList.remove('ring-yellow-500');
                } else {
                    element.classList.add('active');
                    element.classList.add('text-yellow-500'); // Active color
                    element.classList.add('ring-yellow-500'); // Active color
                }
                event.preventDefault();
                if (map.hasLayer(markersPerkebunan)) {
                    map.removeLayer(markersPerkebunan);
                } else {
                    map.addLayer(markersPerkebunan);
                }
            });


            // ================= marker perikanan =======================
            var markersPerikanan = L.markerClusterGroup({
                spiderfyOnMaxZoom: true,
                showCoverageOnHover: true,
                zoomToBoundsOnClick: true
            });

            <?php foreach ($perikanans['data'] as $map) { ?>

            var popupkawasan =
                '<div class=" grid-cols-2">' +
                '<a class="">' +
                '<span class="control-label col-lg-10"><strong> <?= $perikanans['label'] ?></strong></span>' +
                '</a>' +
                '</div>' +
                '<br>' +
                '<div class=" grid-cols-2">' +
                '<span class="control-label col-lg-10">Kabupaten :</span>' +
                '<a class="">' +
                '<span class="control-label col-lg-10"><strong> <?= $map['kabupaten'] ?> </strong></span>' +
                '</a>' +
                '</div>' +
                '<br>' +
                '<div class=" grid-cols-2">' +
                '<span class="control-label col-lg-10">Tahun :</span>' +
                '<a class="">' +
                '<span class="control-label col-lg-10"><strong> <?= $perikanans['tahun'] ?> </strong></span>' +
                '</a>' +
                '</div>' +
                '<br>' +
                '<div class=" grid-cols-2">' +
                '<span class="control-label col-lg-10">Sumber :</span>' +
                '<a target="_blank" href="https://jateng.bps.go.id/indicator/56/<?= $perikanans['kode'] ?>/1/jumlah-perahu-menurut-kategori-perahu-dan-kabupaten-kota-di-provinsi-jawa-tengah.html" class="">' +
                '<span class="control-label col-lg-10"><strong> BPS </strong></span>' +
                '</a>' +
                '</div>' +
                '<br>';

            <?php foreach ($map['komoditi'] as $komoditi) { ?>
            popupkawasan +=
                '<div class=" grid-cols-2">' +
                '<a class="">' +
                '<span class="control-label col-lg-10"><strong> <?= $komoditi['nama'] ?> : <?= $komoditi['value'] . ' ' . $map['satuan'] ?></strong></span>' +
                '</a>' +
                '</div>' +
                '<br>';
            <?php } ?>

            popupkawasan += '</div>';

            var kawasanOptions = {
                'maxWidth': '600',
                'width': '600',
                'className': 'popupCustom'
            };

            var lat = <?= $map['lat'] ?? 'null' ?>;
            var lng = <?= $map['lng'] ?? 'null' ?>;

            if (lat !== null && lng !== null) {
                var kawasans = L.marker([lat, lng], {
                    icon: Icon10,
                    draggable: false,
                    shadow: true
                }).bindPopup(popupkawasan, kawasanOptions);

                markersPerikanan.addLayer(kawasans);
            }
            <?php } ?>

            document.getElementById('perikanan').addEventListener('click', function(event) {
                var element = this;

                if (element.classList.contains('active')) {
                    element.classList.remove('active');
                    element.classList.remove('text-yellow-500');
                    element.classList.remove('ring-yellow-500');
                } else {
                    element.classList.add('active');
                    element.classList.add('text-yellow-500'); // Active color
                    element.classList.add('ring-yellow-500'); // Active color
                }
                event.preventDefault();
                if (map.hasLayer(markersPerikanan)) {
                    map.removeLayer(markersPerikanan);
                } else {
                    map.addLayer(markersPerikanan);
                }
            });







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
                var element = this;

                if (element.classList.contains('active')) {
                    element.classList.remove('active');
                    element.classList.remove('text-yellow-500');
                    element.classList.remove('ring-yellow-500');
                } else {
                    element.classList.add('active');
                    element.classList.add('text-yellow-500'); // Active color
                    element.classList.add('ring-yellow-500'); // Active color
                }

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
                var element = this;

                if (element.classList.contains('active')) {
                    element.classList.remove('active');
                    element.classList.remove('text-yellow-500');
                    element.classList.remove('ring-yellow-500');
                } else {
                    element.classList.add('active');
                    element.classList.add('text-yellow-500'); // Active color
                    element.classList.add('ring-yellow-500'); // Active color
                }
                if (map.hasLayer(kecamatan)) {
                    map.removeLayer(kecamatan);
                } else {
                    map.addLayer(kecamatan);
                }
            });


            // jalan provinsi
            var jalanprovince = L.geoJSON(jalanprovinsi, {
                onEachFeature: function(feature, layer) {
                    layer.bindPopup('<b>NAMA JALAN PROVINSI : </b>' +
                        feature.properties.Nm_Ruas)
                },
                style: function(feature) {
                    city = feature.properties.Nm_Ruas;
                    return {
                        fillColor: "gray",
                        fillOpacity: 0.2,
                        color: "yellow",
                        dashArray: '2',
                        weight: 3,
                        opacity: 1
                    }
                }
            });

            document.getElementById('jalanprovinsi').addEventListener('click', function() {
                event.preventDefault();

                var element = this;

                if (element.classList.contains('active')) {
                    element.classList.remove('active');
                    element.classList.remove('text-yellow-500');
                    element.classList.remove('ring-yellow-500');
                } else {
                    element.classList.add('active');
                    element.classList.add('text-yellow-500'); // Active color
                    element.classList.add('ring-yellow-500'); // Active color
                }

                if (map.hasLayer(jalanprovince)) {
                    map.removeLayer(jalanprovince);
                } else {
                    map.addLayer(jalanprovince);
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
