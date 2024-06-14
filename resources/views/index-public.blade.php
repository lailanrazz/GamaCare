@extends('layouts.template')

@section('styles')
    <link rel="icon" href="https://i.ibb.co.com/BCLJxwR/logo-gamacare.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.css">
    <style>
        html,
        body {
            height: 100%;
            width: 100%;
        }

        #map {
            height: calc(100vh - 56px);
            width: 100%;
            margin: 0;
        }

        /* Custom styles for popups */
        .leaflet-popup-content-wrapper {
            max-width: 200px !important;
            /* Adjust the width as needed */
            padding: 5px;
        }

        .leaflet-popup-content {
            font-size: 12px;
            /* Adjust the font size as needed */
        }

        .img-thumbnail {
            max-width: 100px;
            /* Adjust the image size as needed */
            height: auto;
        }
    </style>
@endsection

@section('content')
    <div id="map"></div>
@endsection

@section('script')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    {{-- J Query --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        // Map
        var map = L.map('map').setView([-7.770147, 110.377072], 16); // Coordinates for UGM

        // Basemap
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        /* GeoJSON Point */
        var redIcon = L.icon({
            iconUrl: '{{ asset('images/marker-icon-yellow.png') }}',
            iconSize: [40, 41],
            iconAnchor: [12, 41],
            popupAnchor: [1, -34],
            tooltipAnchor: [16, -28],
            shadowSize: [41, 41]
        });

        var point = L.geoJson(null, {
            pointToLayer: function(feature, latlng) {
                return L.marker(latlng, {
                    icon: redIcon
                });
            },
            onEachFeature: function(feature, layer) {
                var popupContent = "<b>" + feature.properties.name + "</b>" + "<br>" +
                    feature.properties.description + "<br>" +
                    "<img src='{{ asset('storage/images/') }}/" + feature.properties.image +
                    "' class='img-thumbnail' alt=''> ";
                layer.bindPopup(popupContent);
                layer.on({
                    mouseover: function(e) {
                        layer.bindTooltip(feature.properties.name)
                    .openTooltip(); // Bind and open the tooltip on mouseover
                    }
                });
            }
        });

        $.getJSON("{{ route('api.points') }}", function(data) {
            point.addData(data);
            map.addLayer(point);
            point.eachLayer(function(layer) {
                layer.openPopup();
            });
        });

        /* GeoJSON Polyline */
        var polyline = L.geoJson(null, {
            onEachFeature: function(feature, layer) {
                var popupContent = "Name: " + feature.properties.name + "<br>" +
                    "Deskripsi: " + feature.properties.description + "<br>" +
                    "Foto: <img src='{{ asset('storage/images/') }}/" + feature.properties.image +
                    "' class='img-thumbnail' alt=''> ";
                layer.bindPopup(popupContent);
                layer.on({
                    mouseover: function(e) {
                        layer.bindTooltip(feature.properties.kab_kota).openTooltip();
                    },
                });
            },
        });
        $.getJSON("{{ route('api.polylines') }}", function(data) {
            polyline.addData(data);
            map.addLayer(polyline);
        });

        /* GeoJSON Polygon */
        var polygon = L.geoJson(null, {
            style: function(feature) {
                return {
                    fillColor: 'green', // Warna isi poligon (hijau)
                    fillOpacity: 0.5, // Opasitas poligon
                    color: 'black', // Warna garis tepi poligon
                    weight: 1 // Ketebalan garis tepi poligon
                };
            },
            onEachFeature: function(feature, layer) {
                var popupContent = "Name: " + feature.properties.name + "<br>" +
                    "Deskripsi: " + feature.properties.description + "<br>" +
                    "Foto: <img src='{{ asset('storage/images/') }}/" + feature.properties.image +
                    "' class='img-thumbnail' alt=''> ";
                layer.bindPopup(popupContent);
                layer.on({
                    mouseover: function(e) {
                        layer.bindTooltip(feature.properties.kab_kota).openTooltip();
                    },
                });
            },
        });
        $.getJSON("{{ route('api.polygons') }}", function(data) {
            polygon.addData(data);
            map.addLayer(polygon);
        });

        // Layer control
        var overlayMaps = {
            "Fasilitas": point,
            // "Polyline": polyline,
            "Kawasan UGM": polygon
        };

        var layerControl = L.control.layers(null, overlayMaps, {
            collapsed: false
        }).addTo(map);
        // Basemaps
        var basemap1 = L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png");
        var basemap2 = L.tileLayer(
            "https://server.arcgisonline.com/ArcGIS/rest/services/World_Street_Map/MapServer/tile/{z}/{y}/{x}");
        var basemap3 = L.tileLayer(
            "https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}");


        // Tambahkan salah satu basemap sebagai default
        basemap1.addTo(map);

        // Kontrol Layer
        var baseMaps = {
            "OpenStreetMap": basemap1,
            "Esri World Street": basemap2,
            "Esri Imagery": basemap3,

        };

        L.control.layers(baseMaps).addTo(map);
        // Plugin EasyPrint
        L.easyPrint({
            title: "Print",
        }).addTo(map);

        // // Plugin Search
        // var searchControl = new L.Control.Search({
        //     position: "topleft",
        //     layer: wfsgeoserver1, // Nama variabel layer
        //     propertyName: "Klasifikas", // Field untuk pencarian
        //     marker: false,
        //     moveToLocation: function (latlng, title, map) {
        //         var zoom = map.getBoundsZoom(latlng.layer.getBounds());
        //         map.setView(latlng, zoom);
        //     },
        // });
        // searchControl
        //     .on("search:locationfound", function (e) {
        //         e.layer.setStyle({
        //             fillColor: "#ffff00",
        //             color: "#0000ff",
        //         });
        //     })
        //     .on("search:collapse", function (e) {
        //         wfsgeoserver1.eachLayer(function (layer) {
        //             wfsgeoserver1.resetStyle(layer);
        //         });
        //     });

        // map.addControl(searchControl);
        // Basemaps
        var basemap1 = L.tileLayer(
            "https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
                maxZoom: 19,
                attribution: 'Map data © <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
            }
        );
        basemap1.addTo(map);

        // Plugin Geolocation
        var locateControl = L.control
            .locate({
                position: "topleft",
                drawCircle: true,
                follow: true,
                setView: true,
                keepCurrentZoomLevel: false,
                markerStyle: {
                    weight: 1,
                    opacity: 0.8,
                    fillOpacity: 0.8,
                },
                circleStyle: {
                    weight: 1,
                    clickable: false,
                },
                icon: "fas fa-crosshairs",
                metric: true,
                strings: {
                    title: "Click for Your Location",
                    popup: "You're here. Accuracy {distance} {unit}",
                    outsideMapBoundsMsg: "Not available",
                },
                locateOptions: {
                    maxZoom: 16,
                    watch: true,
                    enableHighAccuracy: true,
                    maximumAge: 10000,
                    timeout: 10000,
                },
            })
            .addTo(map);

        // Plugin Mouse Position Coordinate
        L.control
            .mousePosition({
                position: "bottomright",
                separator: ",",
                prefix: "Point Coodinate: ",
            })
            .addTo(map);

        // Plugin Routing
        L.Routing.control({
            waypoints: [
                L.latLng(-7.590700061386111, 110.42768787014823),
                L.latLng(-7.78910508484698, 110.36342969381099),
            ],
            routeWhileDragging: true,
        }).addTo(map);
    </script>
@endsection
