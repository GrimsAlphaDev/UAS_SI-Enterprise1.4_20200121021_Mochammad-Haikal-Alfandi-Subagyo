<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Kontrak_matakuliah;
use Illuminate\Http\Request;

class KontrakMatakuliahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Kontrak_matakuliah::paginate(10);

        return response()->json([
            'code' => 200,
            'message' => 'success',
            'data' => $data
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'mahasiswa_id' => 'required|numeric',
            'semester_id' => 'required|numeric',
        ]);

        // create new Kontrak_matakuliah
        $kontrak_matakuliah = Kontrak_matakuliah::create([
            'mahasiswa_id' => $request->mahasiswa_id,
            'semester_id' => $request->semester_id,
        ]);

        if ($kontrak_matakuliah) {
            return response()->json([
                'code' => 200,
                'message' => 'success, Data Kontrak Matakuliah berhasil ditambahkan',
                'data' => $kontrak_matakuliah
            ], 200);
        } else {
            return response()->json([
                'code' => 500,
                'message' => 'error, Data Kontrak Matakuliah gagal ditambahkan',
                'data' => $kontrak_matakuliah
            ], 500);
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
        // find Kontrak_matakuliah by id
        $data = Kontrak_matakuliah::find($id);

        if($data) {
            return response()->json([
                'code' => 200,
                'message' => 'success',
                'data' => $data
            ], 200);
        } else {
            return response()->json([
                'code' => 500,
                'message' => 'error, Data Kontrak Matakuliah tidak ditemukan',
                'data' => null
            ], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'mahasiswa_id' => 'required|numeric',
            'semester_id' => 'required|numeric',
        ]);
        
        // find Kontrak_matakuliah by id
        $kontrak_matakuliah = Kontrak_matakuliah::find($id);
        
        // update Kontrak_matakuliah
        $kontrak_matakuliah->mahasiswa_id = $request->mahasiswa_id;
        $kontrak_matakuliah->semester_id = $request->semester_id;
        $kontrak_matakuliah->save();
        
        if($kontrak_matakuliah) {
            return response()->json([
                'code' => 200,
                'message' => 'success, Data Kontrak Matakuliah berhasil diubah',
                'data' => $kontrak_matakuliah
            ], 200);
        } else {
            return response()->json([
                'code' => 500,
                'message' => 'error, Data Kontrak Matakuliah gagal diubah',
                'data' => $kontrak_matakuliah
            ], 500);
        }   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // find Kontrak_matakuliah by id
        $kontrak_matakuliah = Kontrak_matakuliah::find($id);
        
        // delete Kontrak_matakuliah
        $kontrak_matakuliah->delete();
        
        if($kontrak_matakuliah) {
            return response()->json([
                'code' => 200,
                'message' => 'success, Data Kontrak Matakuliah berhasil dihapus',
                'data' => $kontrak_matakuliah
            ], 200);
        } else {
            return response()->json([
                'code' => 500,
                'message' => 'error, Data Kontrak Matakuliah gagal dihapus',
                'data' => $kontrak_matakuliah
            ], 500);
        }
    }
}
