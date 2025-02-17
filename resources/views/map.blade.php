@extends('layouts.app')

@push('style-css')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.1/dist/leaflet.css" integrity="sha256-sA+zWATbFveLLNqWO2gtiw3HL/lh1giY/Inf1BJ0z14=" crossorigin="" />
    {{-- cdn leaflet search --}}
    <link rel="stylesheet" href=" https://cdnjs.cloudflare.com/ajax/libs/leaflet-search/3.0.9/leaflet-search.min.css">
    <style>
        #map {
            height: 100%;
            width: 100%;
            left: 0;
            overflow: hidden;
            position: relative;
        }
        .leaflet-container {
            height: auto;
            width: auto;
            max-width: 100%;
            max-height: 100%;
        }
    </style>
@endpush

@section('content')
<main>
    <!-- contact area start -->
    <section class="tp-contact-inner-ptb">
       <div class="container">
          <div class="row">
             <div class="col-lg-6">
                <div class="tp-contact-inner-heading mb-30">
                   <span class="tp-section-title-pre">FEEL FREE TO CONTACT WITH US</span>
                   <h3 class="tp-section-title">Contact us we are we <br>
                      around the world.</h3>
                </div>
             </div>
             <div class="col-lg-6">
                <div class="tp-contact-inner-item-box d-flex flex-wrap">
                   <div class="tp-contact-inner-item">
                      <span class="tp-contact-inner-item-title">Zoom Level</span>
                        <input class="form-control" type="text" id="zoomLevel" readonly>
                   </div>
                </div>
             </div>
          </div>
       </div>
    </section>
    <!-- contact area end -->


    <!-- map area start -->
    <div class="tp-contact-map">
       <div class="tp-contact-map-content" style="       height: 1000px;   " >
            <div id="map"></div>
       </div>
    </div>
    <!-- map area end -->
</main>


    {{-- <div class="container">
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
        </div>
    </div> --}}
@endsection

@push('javascript')
<script src="https://unpkg.com/leaflet@1.9.1/dist/leaflet.js" integrity="sha256-NDI0K41gVbWqfkkaHj15IzU7PtMoelkzyKp8TOaFQ3s=" crossorigin=""></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet-search/3.0.9/leaflet-search.src.js"></script>

<script>
    function processLayerGroup(groupLayer,item) {
        groupLayer.push(L.geoJSON(item.polygon).setStyle({ color: item.color, fillOpacity: 0.6 }).bindPopup(
                 "<div class='my-2'><img src='"+item.name+"' class='img-fluid' width='700px'></div>" +
                 "<div class='my-2'><strong>Kategori :</strong> <br>"+item.category+"</div>" +
                 "<div class='my-2'><strong>Nama Space:</strong> <br>"+item.name+"</div>" +
                 "<div><a href='/map/"+item.slug+"' class='btn btn-outline-info btn-sm'>Detail Space</a></div>" +
                 "<div class='my-2'></div>") ) ;
        groupLayer.push(L.marker(L.geoJSON(item.polygon).getBounds().getCenter(), {
                icon: L.divIcon({
                    className: 'polygonLabel',
                    html: `<strong>`+item.name+`</strong>`,
                    iconSize: [0, 0]
                })
            }));
    }


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
        var item = @json($item);
        processLayerGroup(arrBatasDistrik,item);
    @endforeach
    @foreach ($fasilitas as $item)
        var item = @json($item);
        processLayerGroup(arrFasilitas,item);
    @endforeach
    @foreach ($pik2 as $item)
        var item = @json($item);
        processLayerGroup(arrPik2,item);
    @endforeach
    @foreach ($greenArea2 as $item)
        var item = @json($item);
        processLayerGroup(arrGreenArea2,item);
    @endforeach
    @foreach ($greenArea3 as $item)
        var item = @json($item);
        processLayerGroup(arrGreenArea3,item);
    @endforeach
    @foreach ($landuseKomersial as $item)
        var item = @json($item);
        processLayerGroup(arrLanduseKomersial,item);
    @endforeach
    @foreach ($landuseResiden as $item)
        var item = @json($item);
        processLayerGroup(arrLanduseResiden,item);
    @endforeach
    @foreach ($komersial as $item)
        var item = @json($item);
        processLayerGroup(arrKomersial,item);
    @endforeach
    @foreach ($ruko as $item)
        var item = @json($item);
        processLayerGroup(arrRuko,item);
    @endforeach
    @foreach ($pasirPutih as $item)
        var item = @json($item);
        processLayerGroup(arrPasirPutih,item);
    @endforeach
    @foreach ($jalan as $item)
        var item = @json($item);
        processLayerGroup(arrJalan,item);
    @endforeach
    @foreach ($jalanToll as $item)
        var item = @json($item);
        processLayerGroup(arrJalanToll,item);
    @endforeach
    @foreach ($kanal as $item)
        var item = @json($item);
        processLayerGroup(arrKanal,item);
    @endforeach

        // console.log(arrJalan);

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
    if (zoomlevel == 16) {
        map.removeLayer(batasDistrik);
        map.addLayer(fasilitas);
        map.addLayer(komersial);
    }
    if (zoomlevel == 15) {
        if (map.hasLayer(pik2)) {
            map.removeLayer(pik2);
        } else {
            console.log("no point layer active");
        }
        map.addLayer(batasDistrik);
    }
    if (zoomlevel == 14) {
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
