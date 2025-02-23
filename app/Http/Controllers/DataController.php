<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CentrePoint;
use App\Models\Space;
use Illuminate\Http\Request;

use function PHPSTORM_META\type;

class DataController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function centrepoint()
    {
        // Method ini untuk menampilkan data centrepoint atau koordinat
        // ke dalam datatables kita juga menambahkan column untuk menampilkan button
        // action
        $centrepoint = CentrePoint::orderBy('created_at', 'DESC');
        return datatables()->of($centrepoint)
            ->addColumn('action', 'centrepoint.action')
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->toJson();
    }

    public function spaces(Request $request)
    {
        // Method ini untuk menampilkan data dari tabel spaces
        // ke dalam datatables kita juga menambahkan column untuk menampilkan button
        // action
        // $spaces = Space::select('id, name,category');
        // return datatables()->of($spaces)
        // ->addColumn('action','space.action')
        // ->addIndexColumn()
        // ->rawColumns(['action'])
        // ->toJson();
        //SETUP
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $request->columns[$request->order[0]['column']]['data'];
        $dir = $request->input('order.0.dir');
        $totalData = Space::count();
        if(empty($request->input('search.value')))
        {
            //QUERI CUSTOM
            $data = Space::select("id","name","category","slug")->offset($start)->limit($limit)->orderBy($order,$dir)->get();
            $totalFiltered = $totalData;
        }
        else {
            $search = $request->input('search.value');
            //QUERI CUSTOM
            $data =  Space::select("id","name","category","slug")
                ->where('name','LIKE',"%{$search}%")
                ->orWhere('category','LIKE',"%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order,$dir)
                ->get();

            //QUERI CUSTOM
            $totalFiltered = Space::where('name','LIKE',"%{$search}%")
            ->orWhere('category','LIKE',"%{$search}%")->count();
        }
        $datas = [];
        if(!empty($data))
        {
            foreach ($data as $key)
            {
                $nestedData = $key;
                $nestedData['action'] = "<a href='".route('space.edit',$key->id)."' class='btn btn-warning btn-sm'>Edit</a>
                                        <button href='".route('space.destroy',$key->id). "' class='btn btn-danger btn-sm' id='delete'>Hapus</button>";
                $datas[] = $nestedData;
            }
        }
        $json_data = array(
            "draw"            => intval($request->input('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $datas
        );
        return json_encode($json_data);

    }
}
