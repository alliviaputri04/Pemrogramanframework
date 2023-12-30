<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;

class CompanyController extends Controller
{
    public function index(Request $request){
        if($request->has('search')){
            $data = Company::where('nama','LIKE','%' .$request->search.'%')->paginate(10);
        }else {
            $data = Company::paginate(10);
            Session::put('halaman_url', request()->fullurl());
        }

        return view('dataperusahaan',compact('data'));
    }

    public function tambahperusahaan(){
        return view('tambahperusahaan');
    }

    public function insertperusahaan(Request $request){
        // dd($request->all());
        $this->validate($request, [
            'nama' => 'required|min:7',
            'industri' => 'required|min:2|max:25',
            'lokasi' => 'required|min:4',
            'email' => 'required|email'
        ]);

        $data = Company::create($request->all());
        if($request->hasfile('foto')){
            $request->file('foto')->move('fotoperusahaan/', $request->file('foto')->getClientOriginalName());
            $data->foto = $request->file('foto')->getClientOriginalName();
            $data->save();
        }
        return redirect()->route('perusahaan')->with('success','Data Berhasil Di Tambahkan');
    }

    public function tampilkanperusahaan($id){

        $data = Company::find($id);
        // dd($data);

        return view('tampilperusahaan', compact('data'));
    }

    public function updateperusahaan(Request $request, $id){
        $data = Company::find($id);
        $data->update($request->all());
        if(session('halaman_url')){
            return redirect(session('halaman_url'))->with('success','Data Berhasil Di Update');
        }
        return redirect()->route('perusahaan')->with('success','Data Berhasil Di Update');
    }

    public function delete($id){
        $data = Company::find($id);
        $data->delete();
        return redirect()->route('perusahaan')->with('success','Data Berhasil Di Hapus');
    }

    

    
}
