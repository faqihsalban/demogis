<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CentrePoint;
use App\Models\Space;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Shapefile\Shapefile;
use Shapefile\ShapefileException;
use Shapefile\ShapefileReader;

class SpaceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Menampilkan data dari tabel space
        return view('space.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Memanggil model CentrePoint untuk mendapatkan data yang akan dikirimkan ke form create
        // space
        $centrepoint = CentrePoint::get()->first();
        return view('space.create', [
            'centrepoint' => $centrepoint,
        ]);
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createPolygon()
    {
        // Memanggil model CentrePoint untuk mendapatkan data yang akan dikirimkan ke form create
        // space
        $centrepoint = CentrePoint::get()->first();
        return view('space.create-polygon', [
            'centrepoint' => $centrepoint,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Lakukan validasi data
        $this->validate($request, [
            // 'name' => 'required',
            // 'content' => 'required',
            // 'image' => 'image|mimes:png,jpg,jpeg',
            // 'location' => 'required'
        ]);

        // melakukan pengecekan ketika ada file gambar yang akan di input
        $spaces = new Space();
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $uploadFile = time() . '_' . $file->getClientOriginalName();
            $file->move('uploads/imgCover/', $uploadFile);
            $spaces->image = $uploadFile;
        }
        // Memasukkan nilai untuk masing-masing field pada tabel space berdasarkan inputan dari
        // form create
        $spaces->name = $request->input('name');
        $spaces->slug = Str::slug($request->category." ".$request->name, '-');
        $spaces->location = $request->input('location');
        $spaces->content = $request->input('content');
        $spaces->polygon = json_decode($request->polygon);
        $spaces->type = $request->input('type');
        $spaces->category = $request->input('category');

        // proses simpan data
        $spaces->save();

        return response()->json(['message' => 'success','data' => $spaces], 200);

        // redirect ke halaman index space
        if ($spaces) {
            return redirect()->route('space.index')->with('success', 'Data berhasil disimpan');
        } else {
            return redirect()->route('spaceI.index')->with('error', 'Data gagal disimpan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Space $space)
    {
        // mencari data space yang dipilih berdasarkan id
        // kemudian menampilkan data tersebut ke form edit space
        $space = Space::findOrFail($space->id);
        return view('space.edit', [
            'space' => $space
            ]);


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Space $space)
    {
        // return $request->all();
        // Menjalankan validasi
        $this->validate($request, [
            'name' => 'required',
            'image' => 'image|mimes:png,jpg,jpeg',
            'location' => 'required'
        ]);

        // Jika data yang akan diganti ada pada tabel space
        // cek terlebih dahulu apakah akan mengganti gambar atau tidak
        // jika gambar diganti hapus terlebuh dahulu gambar lama
        $space = Space::findOrFail($space->id);
        if ($request->hasFile('image')) {

            if (File::exists("uploads/imgCover/" . $space->image)) {
                File::delete("uploads/imgCover/" . $space->image);
            }

            $file = $request->file("image");
            //$uploadFile = StoreImage::replace($space->image,$file->getRealPath(),$file->getClientOriginalName());
            $uploadFile = time() . '_' . $file->getClientOriginalName();
            $file->move('uploads/imgCover/', $uploadFile);
            $space->image = $uploadFile;
        }

        // Lakukan Proses update data ke tabel space
        $space->update([
            'category'      => $request->category,
            'name'      => $request->name,
            'color'      => $request->color,
            'location'  => $request->location,
            'content'   => $request->content,
            'polygon'   => json_decode($request->polygon),
            'slug'      => Str::slug($request->name, '-'),
        ]);
        return response()->json(['message' => 'success','data' => $space], 200);

        // redirect ke halaman index space
        return response('success', 'Data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // hapus keseluruhan data pada tabel space begitu juga dengan gambar yang disimpan
        $space = Space::findOrFail($id);
        if (File::exists("uploads/imgCover/" . $space->image)) {
            File::delete("uploads/imgCover/" . $space->image);
        }
        $space->delete();
        return redirect()->route('space.index');
    }

    public function datatable(Request $request)
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
        $selectedColumm = ["id","name","category","slug","color","type"];
        if(empty($request->input('search.value')))
        {
            //QUERI CUSTOM
            $data = Space::select( $selectedColumm)->offset($start)->limit($limit)->orderBy($order,$dir)->get();
            $totalFiltered = $totalData;
        }
        else {
            $search = $request->input('search.value');
            //QUERI CUSTOM
            $data =  Space::select($selectedColumm)
                ->where('name','ILIKE',"%{$search}%")
                ->orWhere('category','ILIKE',"%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order,$dir)
                ->get();

            //QUERI CUSTOM
            $totalFiltered = Space::where('name','ILIKE',"%{$search}%")
            ->orWhere('category','ILIKE',"%{$search}%")->count();
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
