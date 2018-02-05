<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Mahasiswa;
class mahasiswaController extends Controller
{
    public function getmahasiswa(Request $request)
    {
    	$cari = $request->cari;
        if ($request->cari != null) {

            $mahasiswa = DB::table('mahasiswa')->select('id','nim','nama','tanggal_lahir','jenis_kelamin')->where('nama', 'LIKE', "%$cari%")->orderBy('created_at', 'desc')->paginate(10);
        } else {

            $mahasiswa = DB::table('mahasiswa')->select('id','nim','nama','tanggal_lahir','jenis_kelamin')->orderBy('created_at', 'desc')->paginate(10);

        }
    	
    	return response()->json(['mahasiswa' => $mahasiswa] ); 
    }

    public function store(Request $request)
    {
        
        $this->validate($request, [
            'nim' => 'required|numeric',
            'nama' => 'required',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required'

        ]);

        $mahasiswa = new \App\Mahasiswa;
        $mahasiswa->nim = $request->nim;
        $mahasiswa->nama = $request->nama;
        $mahasiswa->tanggal_lahir = $request->tanggal_lahir;
        $mahasiswa->jenis_kelamin = $request->jenis_kelamin;
        $mahasiswa->save();

        return response()->json($mahasiswa);
    }


    public function show($id)
    {
        $mahasiswa = DB::table('mahasiswa')->where('id', $id)->first();
        return response()->json(['mahasiswa' => $mahasiswa] ); 
    }


    public function destroy($id)
    {
        $mahasiswa = DB::table('mahasiswa')->where('id', $id)->delete();
        return response()->json(['mahasiswa' => $mahasiswa] );
    }

    public function update($id, Request $request)
    {
        $this->validate($request, [
            'nim' => 'required|numeric',
            'nama' => 'required',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required'

        ]);


        $mahasiswa = Mahasiswa::findOrFail($id);
        $mahasiswa->nim = $request->nim;
        $mahasiswa->nama = $request->nama;
        $mahasiswa->tanggal_lahir = $request->tanggal_lahir;
        $mahasiswa->jenis_kelamin = $request->jenis_kelamin;
        $mahasiswa->save();

        return response()->json(['mahasiswa' => $mahasiswa] );
    }
}
