@extends('layouts.app')

@section('style-css')

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.1/dist/leaflet.css"
integrity="sha256-sA+zWATbFveLLNqWO2gtiw3HL/lh1giY/Inf1BJ0z14=" crossorigin="" />

{{-- cdn leaflet search --}}
<link rel="stylesheet" href=" https://cdnjs.cloudflare.com/ajax/libs/leaflet-search/3.0.9/leaflet-search.min.css">

<style>
    html,
    body {
        height: 100%;
        margin: 0;
        padding: 0;
        margin: 0;
    }
    #map {
        height: 80%;
        width: 100%;
        left: 0;
        top: 20%;
        overflow: hidden;
        position: fixed;
    }
    .leaflet-container {
        height: auto;
        width: auto;
        max-width: 100%;
        max-height: 100%;
    }
</style>
@endsection

@section('content')

<div class="container">
    <div class="card-body">
        <div class="card-title">
            Zoom Level :
            <input type="text" id="zoomLevel">
        </div>
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif



        <div id="map"></div>
    </div>
</div>




@endsection

@push('javascript')
<script src="https://unpkg.com/leaflet@1.9.1/dist/leaflet.js" integrity="sha256-NDI0K41gVbWqfkkaHj15IzU7PtMoelkzyKp8TOaFQ3s=" crossorigin=""></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet-search/3.0.9/leaflet-search.src.js"></script>

<script>
    var streets = L.tileLayer('https://{s}.tile.openstreetmap.fr/hot/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© OpenStreetMap contributors, Tiles style by Humanitarian OpenStreetMap Team hosted by OpenStreetMap France'
        }),
        clean = L.tileLayer('https://tile.openstreetmap.bzh/ca/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Tiles courtesy of <a href="https://www.openstreetmap.cat" target="_blank">Breton OpenStreetMap Team</a>'
        });

    //map
    var map = L.map('map', {
            center: [{{ $centrePoint->location }}],
            zoom: 14,
            layers: [streets]
        });
        var baseLayers = {
            "Streets": streets,
            "Clean": clean
        };
    var zoomlevel = map.getZoom();
    document.getElementById("zoomLevel").value = zoomlevel;

    var arrPik2 = [];
    var arrBatasDistrik = [];
    var arrFasilitas = [];
    var arrGreenArea2 = [];
    var arrGreenArea3 = [];
    var arrLanduseKomersial = [];
    var arrLanduseResiden = [];
    var arrKomersial = [];
    var arrRuko = [];
    var arrPasirPutih = [];
    var arrJalan = [];
    var arrJalanToll = [];
    var arrKanal = [];


    // Menampilkan popup data ketika marker di klik
    @foreach ($batasDistrik as $item)
        arrBatasDistrik.push(L.geoJSON(@json($item->polygon)).setStyle({ color: 'green', fillOpacity: 0.6 }).bindPopup(
                 "<div class='my-2'><img src='{{ $item->getImage() }}' class='img-fluid' width='700px'></div>" +
                 "<div class='my-2'><strong>Kategori :</strong> <br>{{ $item->category }}</div>" +
                 "<div class='my-2'><strong>Nama Space:</strong> <br>{{ $item->name }}</div>" +
                 "<div><a href='{{ route('map.show', $item->slug) }}' class='btn btn-outline-info btn-sm'>Detail Space</a></div>" +
                 "<div class='my-2'></div>") ) ;
    @endforeach
    @foreach ($fasilitas as $item)
        arrFasilitas.push(L.geoJSON(@json($item->polygon)).setStyle({ color: 'blue', fillOpacity: 0.6 }).bindPopup(
                 "<div class='my-2'><img src='{{ $item->getImage() }}' class='img-fluid' width='700px'></div>" +
                 "<div class='my-2'><strong>Kategori :</strong> <br>{{ $item->category }}</div>" +
                 "<div class='my-2'><strong>Nama Space:</strong> <br>{{ $item->name }}</div>" +
                 "<div><a href='{{ route('map.show', $item->slug) }}' class='btn btn-outline-info btn-sm'>Detail Space</a></div>" +
                 "<div class='my-2'></div>")) ;
    @endforeach
    @foreach ($pik2 as $item)
        arrPik2.push(L.geoJSON(@json($item->polygon)).setStyle({ color: 'red', fillOpacity: 0.6 }).bindPopup(
                 "<div class='my-2'><img src='{{ $item->getImage() }}' class='img-fluid' width='700px'></div>" +
                 "<div class='my-2'><strong>Kategori :</strong> <br>{{ $item->category }}</div>" +
                 "<div class='my-2'><strong>Nama Space:</strong> <br>{{ $item->name }}</div>" +
                 "<div><a href='{{ route('map.show', $item->slug) }}' class='btn btn-outline-info btn-sm'>Detail Space</a></div>" +
                 "<div class='my-2'></div>")) ;
    @endforeach


    var pik2 = L.layerGroup(arrPik2);
    var batasDistrik = L.layerGroup(arrBatasDistrik);
    var fasilitas = L.layerGroup(arrFasilitas);
    var greenArea2 = L.layerGroup(arrGreenArea2);
    var greenArea3 = L.layerGroup(arrGreenArea3);
    var landuseKomersial = L.layerGroup(arrLanduseKomersial);
    var landuseResiden = L.layerGroup(arrLanduseResiden);
    var komersial = L.layerGroup(arrKomersial);
    var ruko = L.layerGroup(arrRuko);
    var pasirPutih = L.layerGroup(arrPasirPutih);
    var jalan = L.layerGroup(arrJalan);
    var jalanToll = L.layerGroup(arrJalanToll);
    var kanal = L.layerGroup(arrKanal);
    var overlays = {
        'PIK 2': pik2,
        'Batas Distrik': batasDistrik,
        'Fasilitas': fasilitas,
        'Green Area 2': greenArea2,
        'Green Area 3': greenArea3,
        'Landuse Komersil': landuseKomersial,
        'Landuse Resident': landuseResiden,
        'Komersial': komersial,
        'Ruko': ruko,
        'Pasir Putih': pasirPutih,
        'Jalan': jalan,
        'Jalan Toll': jalanToll,
        'Kanal': kanal
    };

    L.control.layers(baseLayers, overlays).addTo(map);
    //default open
    map.addLayer(pik2);

    map.on("zoomend", function() {
    zoomlevel = map.getZoom();
    document.getElementById("zoomLevel").value = zoomlevel;
    if (zoomlevel >= 16) {
        if (map.hasLayer(fasilitas)) {
            console.log("layer already added");
        } else {
            map.addLayer(fasilitas);
        }
    }
    
    if (zoomlevel >= 15) {
        if (map.hasLayer(pik2)) {
            map.removeLayer(pik2);
        } else {
            console.log("no point layer active");
        }
        map.addLayer(batasDistrik);

    }
    if (zoomlevel <= 14) {
        if (map.hasLayer(pik2)) {
            console.log("layer already added");
        } else {
            map.addLayer(pik2);
            map.removeLayer(batasDistrik);
            map.removeLayer(fasilitas);
        }
    }

    console.log("Current Zoom Level = " + zoomlevel);
});




</script>
@endpush
