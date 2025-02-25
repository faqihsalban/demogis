@extends('layouts.app')

@section('style-css')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css"
        integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ=="
        crossorigin="" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.css"/>
    <style>
        #map {
            height: 500px;
        }
    </style>
    {{-- <link href="https://api.mapbox.com/mapbox-gl-js/v3.3.0/mapbox-gl.css" rel="stylesheet"/> --}}
@endsection

    {{-- Untuk form edit sama dengan form create yang membedakannya hanya route action yaitu update,
    dan kita juga melakukan passing parameter mke route tersebut ,
    method post kita ubah menjadi PUT

    dan menambahkan value pada tiap-tiap tag input dengan varaibel $space lalu di ikuti nama field
    dari tabel space
    --}}

    @section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card rounded">
                    <div class="card-header">Create Polygon Space</div>
                    <div class="card-body">
                        <form action="{{ route('space.store') }}" method="post" enctype="multipart/form-data" id="edit-form">
                            <input type="hidden" name="type" value="polygon">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="">Kategori</label>
                                <select class="form-control" name="category" id="category">
                                    <option value="PIK 2">PIK 2</option>
                                    <option value="Batas Distrik">Batas Distrik</option>
                                    <option value="Kanal">Kanal</option>
                                    <option value="Jalan">Jalan</option>
                                    <option value="Jalan Tol">Jalan Tol</option>
                                    <option value="Komersial">Komersial</option>
                                    <option value="Fasilitas">Fasilitas</option>
                                    <option value="Ruko">Ruko</option>
                                    <option value="Green Area 2">Green Area 2</option>
                                    <option value="Green Area 3">Green Area 3</option>
                                    <option value="Landuse Komersil">Landuse Komersil</option>
                                    <option value="Landuse Residen">Landuse Residen</option>
                                    <option value="Pasir Putih">Pasir Putih</option>
                                </select>
                                {{-- <input type="text" name="category" value="" class="form-control @error('category') is-invalid @enderror" id=""> --}}
                                @error('category')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Nama</label>
                                <input type="text" name="name" value="" class="form-control @error('name') is-invalid @enderror" id="">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Foto space</label><br>
                                <img id="previewImage" class="mb-2" src="#" width="100%" alt="">
                                <input type="file" name="image" class="form-control @error('image') is-invalid @enderror"
                                    id="image">
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="">Deskripsi</label>
                                <textarea id="deskripsi" name="content" class="form-control @error('content')
                                    is-invalid
                                @enderror" id="" cols="30" rows="10" placeholder="Deskripsi"></textarea>
                                @error('content')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Lokasi</label>
                                <input type="text" name="location" value=""
                                    class="form-control @error('location') is-invalid @enderror" readonly id="location">
                                @error('location')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            {{-- <div class="form-group mb-3">
                                <label for="">SHP File</label><br>
                                <input type="file" name="shp_file" class="form-control @error('shp_file') is-invalid @enderror"
                                    id="shp_file" multiple>
                                @error('shp_file')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div> --}}
                            <div class="form-group mb-3">
                                <label for="">GEOJSON File</label><br>
                                <input type="file" name="geojson_file" class="form-control @error('geojson_file') is-invalid @enderror"
                                    id="geojson_file" >
                                @error('geojson_file')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div id="map"></div>
                            <div class="form-group mt-3">
                                <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('javascript')
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js" crossorigin=""></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.js"></script>
    <script src="https://unpkg.com/shpjs@latest/dist/shp.min.js"></script>
    {{-- <script src="https://api.mapbox.com/mapbox-gl-js/v3.3.0/mapbox-gl.js"></script> --}}
    <script src='//api.tiles.mapbox.com/mapbox.js/plugins/leaflet-omnivore/v0.3.1/leaflet-omnivore.min.js'></script>

    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#previewImage').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#image").change(function() {
            readURL(this);
        });



        var streets = L.tileLayer('https://{s}.tile.openstreetmap.fr/hot/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© OpenStreetMap contributors, Tiles style by Humanitarian OpenStreetMap Team hosted by OpenStreetMap France'
        }),
        clean = L.tileLayer('https://tile.openstreetmap.bzh/ca/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Tiles courtesy of <a href="https://www.openstreetmap.cat" target="_blank">Breton OpenStreetMap Team</a>'
        });
        var drawnItems = new L.FeatureGroup();

        var map = L.map('map', {
            center: [{{ $centrepoint->location }}],
            zoom: 14,
            layers: [streets]
        });

        var baseLayers = {
            "Streets": streets,
            "Clean": clean
        };

        var overlays = {
            'drawlayer': drawnItems
            // "Streets": streets,
            // "Satellite": satellite,
        };


        L.control.layers(baseLayers, overlays).addTo(map);


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
        map.addLayer(drawnItems);

        map.on(L.Draw.Event.CREATED, function (event) {
            var layer = event.layer;
            drawnItems.addLayer(layer);
            var centerpoint = drawnItems.getBounds().getCenter();
            $('#location').val(centerpoint.lat + "," + centerpoint.lng);


        });

        $("#geojson_file").change(function() {
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    // $('#deskripsi').val(JSON.parse(e.target.result));
                    console.log(JSON.parse(e.target.result));
                    drawnItems = L.geoJSON(JSON.parse(e.target.result)) ;
                    map.addLayer(drawnItems);
                    var centerpoint = drawnItems.getBounds().getCenter();
                    $('#location').val(centerpoint.lat + "," + centerpoint.lng);

                }
                hasil = reader.readAsText(this.files[0]);

            }
        });
        $("form#edit-form").submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            var temppolygon = [];
            drawData = drawnItems.toGeoJSON();
            formData.append('polygon', JSON.stringify(drawData));
            console.log(drawData);
            //ajax
            $.ajax({
                url: document.getElementById("edit-form").action,
                type: 'POST',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function (hasil) {
                    // console.log(hasil);
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
