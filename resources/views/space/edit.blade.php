<x-app-layout>
    <x-slot name="header">
        <h1 class="pb-0">Spaces Management</h1>
        <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
            <ol class="breadcrumb pt-0">
                <li class="breadcrumb-item">
                    <a href="#">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="#">Management</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Spaces</li>
            </ol>
        </nav>
    </x-slot>

    <div class="card mb-4">
        {{-- <div class="card-header">Create Polygon Space</div> --}}
        <div class="card-body">
            <h5 class="mb-4">Edit layer asset</h5>
            <form action="{{ route('space.update',$space) }}" method="post" enctype="multipart/form-data" id="main-form">
                <input type="hidden" name="type" value="polygon">
                @csrf
                @method('PUT')
                <div class="form-group mb-3">
                    <label for="category">Kategori Layer</label>
                    <select class="form-control select2" name="category" id="category">
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
                    @error('category')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="name">Nama Layer</label>
                    <input type="text" name="name" value="{{ $space->name }}" class="form-control @error('name') is-invalid @enderror" id="name">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label class="form-label" for="color">Warna Layer</label><br>
                    <input type="text" name="color" data-coloris class="" value="{{ $space->color }}" id="color">
                </div>
                <div class="form-group mb-3">
                    <label for="">Foto Space</label><br>
                    <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" id="image">
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <label for="">Preview</label><br>
                    <img id="previewImage" class="mb-2" src="{{ $space->getImage() }}" width="25%" alt="">
                </div>
                <div class="form-group mb-3">
                    <label for="">Deskripsi</label>
                    <textarea id="content" name="content" class="form-control @error('content') is-invalid @enderror" cols="30" rows="10" placeholder="Deskripsi"> {{$space->content}}</textarea>
                    @error('content')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="">Lokasi</label>
                    <input type="text" name="location" value="{{ $space->location }}" class="form-control @error('location') is-invalid @enderror" readonly id="location">
                    @error('location')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="">GEOJSON File</label><br>
                    <input type="file" name="geojson_file" class="form-control @error('geojson_file') is-invalid @enderror" id="geojson_file" accept=".geojson" >
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

    @section('title','Food')
    @push('style')
    <link rel="stylesheet" href="{{asset('admin/css/vendor/dataTables.bootstrap4.min.css')}}" />
    <link rel="stylesheet" href="{{asset('admin/css/vendor/datatables.responsive.bootstrap4.min.css')}}" />
    <link rel="stylesheet" href="{{asset('admin/css/vendor/select2.min.css')}}" />
    <link rel="stylesheet" href="{{asset('admin/css/vendor/select2-bootstrap.min.css')}}" />
    <link rel="stylesheet" href="{{asset('admin/css/coloris.min.css')}}" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css"  crossorigin="" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.css"/>
    <style>
        #map {
            height: 500px;
        }
    </style>
    @endpush
    @push('script')
        <script src="{{asset('admin/js/vendor/datatables.min.js')}}"></script>
        <script src="{{asset('admin/js/vendor/select2.full.js')}}"></script>
        <script src="{{asset('admin/js/tinymce/tinymce.min.js')}}" ></script>
        <script src="{{asset('admin/js/coloris.min.js')}}" ></script>
        {{-- <script src="https://cdn.tiny.cloud/1/plwma52yu00x4tqlceirfxgbrjcl2k0djs5v0ph3cv8m8hv7/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script> --}}

        <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js" crossorigin=""></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.js"></script>
        <script src='//api.tiles.mapbox.com/mapbox.js/plugins/leaflet-omnivore/v0.3.1/leaflet-omnivore.min.js'></script>
        <script>

            $(document).ready(function () {
                // tinymce.init({
                //     selector: 'textarea',
                //     plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
                //     toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
                // });
                $('.select2').select2({
                    width: 'resolve'
                });
                $("#category").val("{{ $space->category }}").trigger('change');
                // tinymce.get('content').setContent("{{ $space->content }}");
                Coloris.setInstance('.instance1', {
                    theme: 'pill',
                    themeMode: 'dark',
                    formatToggle: true,
                    closeButton: true,
                    clearButton: true,
                    swatches: [
                        '#067bc2',
                        '#84bcda',
                        '#80e377',
                        '#ecc30b',
                        '#f37748',
                        '#d56062'
                    ]
                    });
            });
            Coloris({
                el: '.coloris',
                swatches: [
                    '#264653',
                    '#2a9d8f',
                    '#e1ff00',
                    '#f4a261',
                    '#e76f51',
                    '#d62828',
                    '#023e8a',
                    '#0077b6',
                    '#0096c7',
                    '#00b4d8',
                    '#48cae4'
                ]
                });
        </script>
         <script> </script>
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
            var drawnItems = L.geoJSON(@json($space->polygon)) ;

            var map = L.map('map', {
                center: [{{ $space->location }}],
                zoom: 15,
                layers: [streets]
            });

            var baseLayers = {
                "Streets": streets,
                "Clean": clean
            };

            var overlays = {
                'This Layer': drawnItems
                // "Streets": streets,
                // "Satellite": satellite,
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

            $("#geojson_file").change(function() {
                //TODO : VALIDASI file nya harus GEOJSON
                if (this.files && this.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        // $('#deskripsi').val(JSON.parse(e.target.result));
                        // console.log(JSON.parse(e.target.result));

                        //clear drawlayer dahulu dari map dan dari array
                        drawnItems.clearLayers();
                        //assign layer dari file
                        drawnItems = L.geoJSON(JSON.parse(e.target.result)) ;
                        //masukin layer ke map
                        map.addLayer(drawnItems);
                        var centerpoint = drawnItems.getBounds().getCenter();
                        $('#location').val(centerpoint.lat + "," + centerpoint.lng);
                    }
                    hasil = reader.readAsText(this.files[0]);
                }
            });
            $("form#main-form").submit(function(e) {

                e.preventDefault();
                var formData = new FormData(this);
                drawData = drawnItems.toGeoJSON();
                formData.append('polygon', JSON.stringify(drawData));

                //ajax
                $.ajax({
                    url: document.getElementById("main-form").action,
                    type: 'POST',
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (hasil) {
                        // alert('ok');
                        console.log(hasil);
                        window.location = "/admin/space/"
                    },
                    error: function (err) {
                        alert('ga ok');
                        console.log(err);
                    }
                });
            });

        </script>
    @endpush
</x-app-layout>
