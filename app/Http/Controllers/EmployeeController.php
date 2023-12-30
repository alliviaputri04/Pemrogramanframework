<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Exports\EmployeeExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;

class EmployeeController extends Controller
{
    public function index(Request $request){
        if($request->has('search')){
            $data = Employee::where('nama','LIKE','%' .$request->search.'%')->paginate(10);
        }else {
            $data = Employee::paginate(10);
            Session::put('halaman_url', request()->fullurl());
        }

        return view('datapegawai',compact('data'));
    }

    public function tambahpegawai(){
        return view('tambahdata');
    }

    public function insertdata(Request $request){
        // dd($request->all());
        $this->validate($request, [
            'nama' => 'required|min:7|max:25',
            'umur' => 'required|min:2',
            'notelpon' => 'required|min:11|max:13',
            'alamat' => 'required|min:4',
        ]);

        $data = Employee::create($request->all());
        if($request->hasfile('foto')){
            $request->file('foto')->move('fotopegawai/', $request->file('foto')->getClientOriginalName());
            $data->foto = $request->file('foto')->getClientOriginalName();
            $data->save();
        }
        return redirect()->route('pegawai')->with('success','Data Berhasil Di Tambahkan');
    }

    public function tampilkandata($id){

        $data = Employee::find($id);
        // dd($data);

        return view('tampildata', compact('data'));
    }

    public function updatedata(Request $request, $id){
        $data = Employee::find($id);
        $data->update($request->all());
        if(session('halaman_url')){
            return redirect(session('halaman_url'))->with('success','Data Berhasil Di Update');
        }
        return redirect()->route('pegawai')->with('success','Data Berhasil Di Update');
    }

    public function delete($id){
        $data = Employee::find($id);
        if (!$data) {
            return redirect()->route('pegawai')->with('error','Data Tidak Ditemukan');
        }
        $data->delete();

        return redirect()->route('pegawai')->with('success','Data Berhasil Di Hapus');
    }

    public function exportpdf(){
        $data = Employee::all();

        view()->share('data', $data);
        $pdf = PDF::loadview('datapegawai-pdf');
        return $pdf->download('datapegawai.pdf');
    }

    public function exportexcel(){
        return Excel::download(new EmployeeExport, 'datapegawai.xlsx');
    }
}
