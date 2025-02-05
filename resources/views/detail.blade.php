@extends('layouts.app')
@section('style-css')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css"
        integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ=="
        crossorigin="" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.css"/>
    <style>
        /* .leaflet-container {
                height: 400px;
                width: 600px;
                max-width: 100%;
                max-height: 100%;
            } */
        #map {
            height: 500px;
        }

    </style>
@endsection
@section('content')
    <div class="container py-4 justify-content-center">
        <div class="row">

            <div class="col-md-6 col-xs-6 mb-2">
                <div class="card">
                    <div class="card-header">Informasi Umum</div>
                    <div class="card-body">
                        <h5><strong>Kategori :</strong></h5>
                        <p>{{ $spaces->category }}</p>
                        <h5><strong>Nama Space :</strong></h5>
                        <p>{{ $spaces->name }}</p>

                        <h4> <strong>Foto</strong> </h4>
                        <img class="img-fluid" width="200" src="{{ $spaces->getImage() }}"
                            alt="">
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xs-6 mb-2">
                <div class="card">
                    <div class="card-header">Informasi Detail</div>
                    <div class="card-body">
                        <h5><strong>Keterangan Wilayah :</strong></h5>
                        <p>{{ $spaces->content }}</p>
                        <h5><strong>Luas :</strong></h5>
                        <p>1000 M2</p>
                        <h5><strong>Elevasi</strong></h5>
                        <p>50 M</p>

                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xs-6 mb-2">
                <div class="card">
                    <div class="card-header">File Pendukung</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-borderless ">
                                {{-- <thead>
                                    <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Filename</th>
                                    <th scope="col">Action</th>
                                    </tr>
                                </thead> --}}
                                <tbody>
                                    <tr>
                                    <th scope="row">1</th>
                                    <td>File 1.pdf</td>
                                    <td style="text-align: right"><a href="#" class="btn btn-primary">Download</a></td>
                                    </tr>
                                    <tr>
                                    <th scope="row">2</th>
                                    <td>File 2.pdf</td>
                                    <td style="text-align: right"><a href="#" class="btn btn-primary">Download</a></td>
                                    </tr>
                                    <tr>
                                    <th scope="row">3</th>
                                    <td>File 3.pdf</td>
                                    <td style="text-align: right"><a href="#" class="btn btn-primary">Download</a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xs-6">
                <div class="card">
                    <div class="card-body">
                        <div id="map"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('javascript')
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js"
        integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ=="
        crossorigin=""></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.js"></script>


    <script>
        var streets = L.tileLayer('https://{s}.tile.openstreetmap.fr/hot/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© OpenStreetMap contributors, Tiles style by Humanitarian OpenStreetMap Team hosted by OpenStreetMap France'
        }),
        clean = L.tileLayer('https://tile.openstreetmap.bzh/ca/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Tiles courtesy of <a href="https://www.openstreetmap.cat" target="_blank">Breton OpenStreetMap Team</a>'
        });

        var drawnItems = L.geoJSON(@json($spaces->polygon)) ;
        var map = L.map('map', {
            center: [{{ $spaces->location }}],
            zoom: 14,
            layers: [streets]
        });
        var baseLayers = {
            "Streets": streets,
            "Clean": clean
        };
        var overlays = {
            'This Layer': drawnItems
        };
        L.control.layers(baseLayers, overlays).addTo(map);

        map.addLayer(drawnItems);

        map.addControl(new L.Control.Draw({
            edit: {
                featureGroup: drawnItems,
                poly: {
                    allowIntersection: false
                }
            },
            draw: {
                polygon: {
                    allowIntersection: false,
                    showArea: true
                }
            }
        }));

        map.on(L.Draw.Event.CREATED, function (event) {
            var layer = event.layer;
            drawnItems.addLayer(layer);
            // console.log(layer.toGeoJSON());
        });

        $("form#edit-form").submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            var temppolygon = [];
            drawData = drawnItems.toGeoJSON();
            formData.append('polygon', JSON.stringify(drawData));
            console.log(drawData);


            //ajax
            // console.log(drawData);
            $.ajax({
                url: document.getElementById("edit-form").action,
                type: 'POST',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function (hasil) {
                    console.log(hasil);

                    alert('ok');
                },
                error: function (err) {
                    alert('ga ok');
                    console.log(err);
                }
            });

        });

    </script>
@endpush
