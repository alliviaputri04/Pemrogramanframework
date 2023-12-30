<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DepartmentController extends Controller
{
    public function index(Request $request){
        if($request->has('search')){
            $data = Department::where('nama','LIKE','%' .$request->search.'%')->paginate(10);
        }else {
            $data = Department::paginate(10);
            Session::put('halaman_url', request()->fullurl());
        }

        return view('datadepartment',compact('data'));
    }

    public function tambahdepartment(){
        return view('tambahdepartment');
    }

    public function insertdepartment(Request $request){
        // dd($request->all());
        $this->validate($request, [
            'nama' => 'required|min:4',
            'deskripsi' => 'required|min:5',
        ]);

        return redirect()->route('department')->with('success','Data Berhasil Di Tambahkan');
    }

    public function tampilkandepartment($id){

        $data = Department::find($id);
        // dd($data);

        return view('tampildepartment', compact('data'));
    }

    public function updatedepartment(Request $request, $id){
        $data = Department::find($id);
        $data->update($request->all());
        if(session('halaman_url')){
            return redirect(session('halaman_url'))->with('success','Data Berhasil Di Update');
        }
        return redirect()->route('department')->with('success','Data Berhasil Di Update');
    }

    public function delete($id){
        $data = Department::find($id);
        $data->delete();
        return redirect()->route('department')->with('success','Data Berhasil Di Hapus');
    }

}
