<?php

namespace App\Http\Controllers\API;

use App\Models\Absen;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AbsenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Absen::paginate(10);
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
            'waktu_absen' => 'required|max:255',
            'mahasiswa_id' => 'required|numeric',
            'matakuliah_id' => 'required|numeric',
            'keterangan' => 'required|max:255'
        ]);

        // create new Absen
        $absen = Absen::create([
            'waktu_absen' => $request->waktu_absen,
            'mahasiswa_id' => $request->mahasiswa_id,
            'matakuliah_id' => $request->matakuliah_id,
            'keterangan' => $request->keterangan
        ]);

        if ($absen) {
            return response()->json([
                'code' => 200,
                'message' => 'success, Data Absen berhasil ditambahkan',
                'data' => $absen
            ], 200);
        } else {
            return response()->json([
                'code' => 500,
                'message' => 'error, Data Absen gagal ditambahkan'
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
        // find Absen by id
        $data = Absen::find($id);
        
        if($data) {
            return response()->json([
                'code' => 200,
                'message' => 'success, Data Absen Berhasil Ditemukan',
                'data' => $data
            ], 200);
        } else {
            return response()->json([
                'code' => 500,
                'message' => 'error, Data Absen tidak ditemukan'
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
