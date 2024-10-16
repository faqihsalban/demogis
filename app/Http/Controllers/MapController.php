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

        /**
         *  Pada method index kita mengambil single data dari tabel centrepoint
         *  Selanjutnya kita mengambil seluruh data dari tabel space untuk menampilkan marker yang akan
         *  kita gtampilkan pada view map.blade
         */
        $centrePoint = CentrePoint::get()->first();
        $spaces = Space::where('type','marker')->get();
        $polygon = Space::where('type','polygon')->get();



        return view('map',[
            'spaces' => $spaces,
            'polygon' => $polygon,
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
