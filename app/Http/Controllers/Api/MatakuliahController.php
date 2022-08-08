<?php

namespace App\Http\Controllers\API;

use App\Models\Matakuliah;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MatakuliahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Matakuliah::paginate(10);

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
            'nama_matakuliah' => 'required|max:255|unique:matakuliahs',
            'sks' => 'required|numeric|max:20',
        ]);

        // create new Matakuliah
        $matakuliah = Matakuliah::create([
            'nama_matakuliah' => $request->nama_matakuliah,
            'sks' => $request->sks,
        ]);

        if($matakuliah) {
            return response()->json([
                'code' => 200,
                'message' => 'success, Data Matakuliah berhasil ditambahkan',
                'data' => $matakuliah
            ], 200);
        } else {
            return response()->json([
                'code' => 500,
                'message' => 'error, Data Matakuliah gagal ditambahkan',
                'data' => 'Gagal menambahkan data'
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
        // get Matakuliah by id
        $matakuliah = Matakuliah::find($id);

        if($matakuliah) {
            return response()->json([
                'code' => 200,
                'message' => 'success',
                'data' => $matakuliah
            ], 200);
        } else {
            return response()->json([
                'code' => 500,
                'message' => 'error',
                'data' => 'Data tidak ditemukan'
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
        //
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
            'nama_matakuliah' => 'required|max:255',
            'sks' => 'required|numeric|max:20',
        ]);

        // get Matakuliah by id
        $matakuliah = Matakuliah::find($id);
        if($matakuliah) {
            // update Matakuliah
            $matakuliah->update([
                'nama_matakuliah' => $request->nama_matakuliah,
                'sks' => $request->sks,
            ]);

            return response()->json([
                'code' => 200,
                'message' => 'success, Data Matakuliah berhasil diubah',
                'data' => $matakuliah
            ], 200);
        } else {
            return response()->json([
                'code' => 500,
                'message' => 'error, Data Matakuliah gagal diubah',
                'data' => 'null'
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
        // get Matakuliah by id
        $matakuliah = Matakuliah::find($id);
        if($matakuliah) {
            // delete Matakuliah
            $matakuliah->delete();

            return response()->json([
                'code' => 200,
                'message' => 'success, Data Matakuliah berhasil dihapus',
                'data' => $matakuliah
            ], 200);
        } else {
            return response()->json([
                'code' => 500,
                'message' => 'error, Data Matakuliah gagal dihapus',
                'data' => 'null'
            ], 500);
        }
    }
}
