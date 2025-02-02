<?php

namespace App\Http\Controllers;

use App\Models\CentrePoint;
use App\Models\Space;
use Illuminate\Http\Request;

class MapController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {

        // return   $data = Space::select("id","name","category","slug")->orderBy("id","DESC")->get();

        /**
         *  Pada method index kita mengambil single data dari tabel centrepoint
         *  Selanjutnya kita mengambil seluruh data dari tabel space untuk menampilkan marker yang akan
         *  kita gtampilkan pada view map.blade
         */
        $centrePoint = CentrePoint::get()->first();
        // $marker = Space::where('type','marker')->get();
        $batasDistrik       = Space::where('type','polygon')->where('category','Batas Distrik')->get();
        $fasilitas          = Space::where('type','polygon')->where('category','Fasilitas')->get();
        $pik2               = Space::where('type','polygon')->where('category','PIK 2')->get();
        $greenArea2         = Space::where('type','polygon')->where('category','PIK 2')->get();
        $greenArea3         = Space::where('type','polygon')->where('category','PIK 2')->get();
        $landuseKomersial   = Space::where('type','polygon')->where('category','PIK 2')->get();
        $landuseResiden     = Space::where('type','polygon')->where('category','PIK 2')->get();
        $komersial          = Space::where('type','polygon')->where('category','Komersial')->get();
        $ruko               = Space::where('type','polygon')->where('category','PIK 2')->get();
        $pasirPutih         = Space::where('type','polygon')->where('category','PIK 2')->get();
        $jalan    = Space::where('type','polygon')->where('category','PIK 2')->get();
        $jalanToll          = Space::where('type','polygon')->where('category','PIK 2')->get();
        $kanal              = Space::where('type','polygon')->where('category','PIK 2')->get();



        return view('map',[
            // 'marker' => $marker,
            'pik2' => $pik2,
            'batasDistrik' => $batasDistrik,
            'fasilitas' => $fasilitas,
            'greenArea2' => $greenArea2,
            'greenArea3' => $greenArea3,
            'landuseKomersial' => $landuseKomersial,
            'landuseResiden' => $landuseResiden,
            'komersial' => $komersial,
            'ruko' => $ruko,
            'pasirPutih' => $pasirPutih,
            'jalan' => $jalan,
            'jalanToll' => $jalanToll,
            'kanal' => $kanal,
            'centrePoint' => $centrePoint
        ]);
    }

    public function show($slug)
    {
        /**
         * Hampir sama dengam method index diatas
         * tapi disini kita hanya akan menampilkan single data saja untuk space
         * yang kita pilih pada view map dan selanjutnya kita akan di arahkan
         * ke halaman detail untuk melihat informasi lebih lengkap dari space
         * yang kita pilih
         */
        $centrePoint = CentrePoint::get()->first();
        $spaces = Space::where('slug',$slug)->first();
        $polygon = Space::where('type','polygon')->where('slug',$slug)->first();
        return view('detail',[
            'centrePoint' => $centrePoint,
            'spaces' => $spaces,
            'polygon' => $polygon
        ]);
    }
}
