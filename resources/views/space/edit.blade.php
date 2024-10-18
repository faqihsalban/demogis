@extends('layouts.app')

@section('style-css')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css"
        integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ=="
        crossorigin="" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <style>
        #map {
            height: 500px;
        }

    </style>
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
                    <div class="card-header">Edit Space</div>
                    <div class="card-body">
                        <form action="{{ route('space.update',$space) }}" method="post" enctype="multipart/form-data" id="edit-form">
                            @csrf
                            @method('PUT')
                            <div class="form-group mb-3">
                                <label for="">Nama space</label>
                                <input type="text" name="name" value="{{ $space->name }}" class="form-control @error('name') is-invalid @enderror" id="">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Foto space</label><br>
                                <img id="previewImage" class="mb-2" src="{{ $space->getImage() }}" width="100%" alt="">
                                <input type="file" name="image" class="form-control @error('image') is-invalid @enderror"
                                    id="image">
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="">Deskripsi</label>
                                <textarea name="content" class="form-control @error('content')
                                    is-invalid
                                @enderror" id="" cols="30" rows="10" placeholder="Deskripsi">{{ $space->content }}</textarea>
                                @error('content')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Lokasi</label>
                                <input type="text" name="location" value="{{ $space->location }}"
                                    class="form-control @error('location') is-invalid @enderror" readonly id="">
                                @error('location')
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
    <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js"
        integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ=="
        crossorigin=""></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


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

        var map = L.map('map', {
            center: [{{ $space->location }}],
            zoom: 14,
            layers: [streets]
        });

        var baseLayers = {
            "Streets": streets,
            "Clean": clean
        };

        var overlays = {
            "Streets": streets,
            "Satellite": clean,
        };

        L.control.layers(baseLayers, overlays).addTo(map);

        var curLocation = [{{ $space->location }}];
        map.attributionControl.setPrefix(false);

        var marker = new L.marker(curLocation, {
            draggable: 'true',
        });
        map.addLayer(marker);

        marker.on('dragend', function(event) {
            var location = marker.getLatLng();
            marker.setLatLng(location, {
                draggable: 'true',
            }).bindPopup(location).update();

            $('#location').val(location.lat + "," + location.lng).keyup()
        });

        var loc = document.querySelector("[name=location]");
        map.on("click", function(e) {
            var lat = e.latlng.lat;
            var lng = e.latlng.lng;

            if (!marker) {
                marker = L.marker(e.latlng).addTo(map);
            } else {
                marker.setLatLng(e.latlng);
            }
            loc.value = lat + "," + lng;
        });

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


    </script>
@endpush
