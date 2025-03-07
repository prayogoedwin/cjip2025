<div class="grid grid-cols-1 dark:bg-gray-900 md:grid-cols-12 gap-4" wire:ignore>
    <!-- Memastikan library Leaflet dimuat -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-fullscreen/dist/leaflet.fullscreen.css" />

    <!-- Container untuk peta -->
    <div class="md:col-span-2 bg-white dark:bg-gray-800 shadow-md rounded-lg p-2">
        <div id="map" class="w-full rounded-lg" style="height: 75vh;"></div>
    </div>

    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-fullscreen/dist/Leaflet.fullscreen.min.js"></script>

    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster/dist/MarkerCluster.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster/dist/MarkerCluster.Default.css" />
    <script src="https://unpkg.com/leaflet.markercluster/dist/leaflet.markercluster.js"></script>


    <script src="{{ asset('map/data/jawatengah.js') }}"></script>
    <script src="{{ asset('map/data/bataskabkota.js') }}"></script>
    @if ($locale == 'id')
        @isset($locations)
            <script>
                document.addEventListener('livewire:initialized', function() {
                    component = @this;

                    var map = L.map("map", {
                        maxZoom: 20,
                        trackResize: false
                    }).setView([-7.314319095811024, 110.16720334357437], 9);

                    googleHybrid = L.tileLayer('http://{s}.google.com/vt?lyrs=s,h&x={x}&y={y}&z={z}', {
                        maxZoom: 20,
                        subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
                    })

                    var osm = L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
                        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
                        maxZoom: 20
                    }).addTo(map);

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

                    // batas kota
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
                    }).addTo(map);

                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                    }).addTo(map);

                    // Base Maps
                    var baseMaps = {
                        "Open Street Map": osm,
                        "Google Hybrid": googleHybrid,
                    };

                    var overlayMaps = {
                        // ..
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

                    // ==================================================================

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

                    // MarkerClusterGroup
                    var markers = L.markerClusterGroup();

                    // ready to over
                    <?php foreach ($locations as $map) { ?>
                    var marker = L.marker([<?php echo $map->lat; ?>, <?php echo $map->lng; ?>], {
                        icon: IconReadyToOver
                    });

                    marker.bindPopup(
                        "<img src='{{ asset('storage/' . $map->foto[0]) }}' class='rounded-lg' style='width: 100%;'/>" +
                        "<b><?php echo $map->nama; ?></b> " +
                        "<br>" + "<?php echo $map->kabkota->nama; ?>" +
                        "<br>" + "<?php echo $map->market->nama; ?>"
                    );

                    markers.addLayer(marker);
                    <?php } ?>

                    // prospective
                    <?php foreach ($locations1 as $map) { ?>
                    var marker = L.marker([<?php echo $map->lat; ?>, <?php echo $map->lng; ?>], {
                        icon: IconProspective
                    });

                    marker.bindPopup(
                        "<img src='{{ asset('storage/' . $map->foto[0]) }}' class='rounded-lg' style='width: 100%;'/>" +
                        "<b><?php echo $map->nama; ?></b> " +
                        "<br>" + "<?php echo $map->kabkota->nama; ?>" +
                        "<br>" + "<?php echo $map->market->nama; ?>"
                    );
                    markers.addLayer(marker);
                    <?php } ?>

                    // potential
                    <?php foreach ($locations2 as $map) { ?>
                    var marker = L.marker([<?php echo $map->lat; ?>, <?php echo $map->lng; ?>], {
                        icon: IconPotential
                    });

                    marker.bindPopup(
                        "<img src='{{ asset('storage/' . $map->foto[0]) }}' class='rounded-lg' style='width: 100%;'/>" +
                        "<b><?php echo $map->nama; ?></b> " +
                        "<br>" + "<?php echo $map->kabkota->nama; ?>" +
                        "<br>" + "<?php echo $map->market->nama; ?>"
                    );
                    markers.addLayer(marker);
                    <?php } ?>

                    // strategi
                    <?php foreach ($locations3 as $map) { ?>
                    var marker = L.marker([<?php echo $map->lat; ?>, <?php echo $map->lng; ?>], {
                        icon: IconStrategi
                    });

                    marker.bindPopup(
                        "<img src='{{ asset('storage/' . $map->foto[0]) }}' class='rounded-lg' style='width: 100%;'/>" +
                        "<b><?php echo $map->nama; ?></b> " +
                        "<br>" + "<?php echo $map->kabkota->nama; ?>" +
                        "<br>" + "<?php echo $map->market->nama; ?>"
                    );
                    markers.addLayer(marker);
                    <?php } ?>

                    // Add MarkerClusterGroup to the map
                    map.addLayer(markers);


                });
            </script>
        @endisset
    @endif
</div>
