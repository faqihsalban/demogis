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
        height: 90%;
        width: 100%;
        left: 0;
        top: 10%;
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
        <div class="card-title">{{ __('Dashboard') }}</div>
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
    var arrBatasDistrik = [];
    var arrFasilitas = [];
    var arrPik2 = [];

    // var arrMarker = [];
    // var arrPolygon = [];
    // Menampilkan popup data ketika marker di klik
    // @foreach ($spaces as $item)
    //     arrMarker.push("{{ $item->slug }}");
    //     L.marker([{{ $item->location }}])
    //         .bindPopup(
    //             "<div class='my-2'><img src='{{ $item->getImage() }}' class='img-fluid' width='700px'></div>" +
    //             "<div class='my-2'><strong>Nama Space:</strong> <br>{{ $item->name }}</div>" +
    //             "<div><a href='{{ route('map.show', $item->slug) }}' class='btn btn-outline-info btn-sm'>Detail Space</a></div>" +
    //             "<div class='my-2'></div>"
    //         ).addTo(map);
    // @endforeach

    @foreach ($batasDistrik as $item)
        arrBatasDistrik.push(L.geoJSON(@json($item->polygon)).setStyle({ color: 'green', fillOpacity: 0.6 }).bindPopup(
                 "<div class='my-2'><img src='{{ $item->getImage() }}' class='img-fluid' width='700px'></div>" +
                 "<div class='my-2'><strong>Nama Space:</strong> <br>{{ $item->name }}</div>" +
                 "<div><a href='{{ route('map.show', $item->slug) }}' class='btn btn-outline-info btn-sm'>Detail Space</a></div>" +
                 "<div class='my-2'></div>") ) ;
    @endforeach
    @foreach ($fasilitas as $item)
        arrFasilitas.push(L.geoJSON(@json($item->polygon)).setStyle({ color: 'blue', fillOpacity: 0.6 }).bindPopup(
                 "<div class='my-2'><img src='{{ $item->getImage() }}' class='img-fluid' width='700px'></div>" +
                 "<div class='my-2'><strong>Nama Space:</strong> <br>{{ $item->name }}</div>" +
                 "<div><a href='{{ route('map.show', $item->slug) }}' class='btn btn-outline-info btn-sm'>Detail Space</a></div>" +
                 "<div class='my-2'></div>")) ;
    @endforeach
    @foreach ($pik2 as $item)
        arrPik2.push(L.geoJSON(@json($item->polygon)).setStyle({ color: 'red', fillOpacity: 0.6 }).bindPopup(
                 "<div class='my-2'><img src='{{ $item->getImage() }}' class='img-fluid' width='700px'></div>" +
                 "<div class='my-2'><strong>Nama Space:</strong> <br>{{ $item->name }}</div>" +
                 "<div><a href='{{ route('map.show', $item->slug) }}' class='btn btn-outline-info btn-sm'>Detail Space</a></div>" +
                 "<div class='my-2'></div>")) ;
    @endforeach
     var batasDistrik = L.layerGroup(arrBatasDistrik);
     var fasilitas = L.layerGroup(arrFasilitas);
     var pik2 = L.layerGroup(arrPik2);
    // var    zone = L.layerGroup(arrPolygon);
    var overlays = {
            'PIK 2': pik2,
            'Batas Distrik': batasDistrik,
            'Fasilitas': fasilitas,
            // 'Green Area 2': batasDistrik,
            // 'Green Area 3': batasDistrik,
            // 'Landuse Komersil': batasDistrik,
            // 'Landuse Resident': batasDistrik,
            // 'Commercial': fasilitas,
            // 'Ruko': fasilitas,
            // 'Pasir Putih': fasilitas,
            // 'Road': fasilitas,
            // 'Toll Road': fasilitas,
            // 'Canal': fasilitas
        };

    L.control.layers(baseLayers, overlays).addTo(map);

    var datas = [
        @foreach ($spaces as $key => $value)
            {
                "loc": [{{ $value->location }}],
                "title": '{!! $value->name !!}'
            },
        @endforeach
    ];
    // pada koding ini kita menambahkan control pencarian data
    var markersLayer = new L.LayerGroup();
    map.addLayer(markersLayer);
    var controlSearch = new L.Control.Search({
        position: 'topleft',
        layer: markersLayer,
        initial: false,
        zoom: 17,
        markerLocation: true
    });
    //menambahkan variabel controlsearch pada addControl
    map.addControl(controlSearch);

    // looping variabel datas utuk menampilkan data space ketika melakukan pencarian data
    // for (i in datas) {

    //     var title = datas[i].title,
    //         loc = datas[i].loc,
    //         marker = new L.Marker(new L.latLng(loc), {
    //             title: title
    //         });
    //     markersLayer.addLayer(marker);

        // melakukan looping data untuk memunculkan popup dari space yang dipilih
        // @foreach ($spaces as $item)
        //     L.marker([{{ $item->location }}])
        //         .bindPopup(
        //             "<div class='my-2'><img src='{{ $item->getImage() }}' class='img-fluid' width='700px'></div>" +
        //             "<div class='my-2'><strong>Nama Spot:</strong> <br>{{ $item->name }}</div>" +
        //             "<a href='{{ route('map.show', $item->slug) }}' class='btn btn-outline-info btn-sm'>Detail Spot</a></div>" +
        //             "<div class='my-2'></div>"
        //         ).addTo(map);
        // @endforeach
    }
</script>
@endpush
