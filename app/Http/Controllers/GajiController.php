<?php

namespace App\Http\Controllers;

use App\Models\Gaji;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;

class GajiController extends Controller
{
    public function index(Request $request){
        if($request->has('search')){
            $data = Gaji::where('nama','LIKE','%' .$request->search.'%')->paginate(10);
        }else {
            $data = Gaji::paginate(10);
            Session::put('halaman_url', request()->fullurl());
        }

        return view('datagaji',compact('data'));
    }

    public function tambahgaji(){
        return view('tambahgaji');
    }

    public function insertgaji(Request $request){
        // dd($request->all());
        $this->validate($request, [
            'nama' => 'required|min:7|max:25',
            'gaji' => 'required|min:4|max:25',
            'tunjangan' => 'required|min:4|max:25',
            'bulan' => 'required|min:4|max:25',
            'tahun' => 'required|min:4|max:25',
        ]);

        $data = Gaji::create($request->all());
        if($request->hasfile('foto')){
            $request->file('foto')->move('fotogaji/', $request->file('foto')->getClientOriginalName());
            $data->foto = $request->file('foto')->getClientOriginalName();
            $data->save();
        }
        return redirect()->route('gaji')->with('success','Data Berhasil Di Tambahkan');
    }

    public function tampilkangaji($id){

        $data = Gaji::find($id);
        // dd($data);

        return view('tampilgaji', compact('data'));
    }

    public function updategaji(Request $request, $id){
        $data = Gaji::find($id);
        $data->update($request->all());
        if(session('halaman_url')){
            return redirect(session('halaman_url'))->with('success','Data Berhasil Di Update');
        }
        return redirect()->route('gaji')->with('success','Data Berhasil Di Update');
    }

    public function delete($id){
        $data = Gaji::find($id);
        $data->delete();
        return redirect()->route('gaji')->with('success','Data Berhasil Di Hapus');
    }


}
