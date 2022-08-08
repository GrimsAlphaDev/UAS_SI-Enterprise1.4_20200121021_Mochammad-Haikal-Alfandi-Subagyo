<?php

namespace App\Http\Controllers\API;

use App\Models\Jadwal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Jadwal::paginate(10);

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
            'jadwal' => 'required|string|max:255',
            'matakuliah_id' => 'required|numeric',

        ]);

        // create new Jadwal
        $jadwal = Jadwal::create([
            'jadwal' => $request->jadwal,
            'matakuliah_id' => $request->matakuliah_id,
        ]);

        if ($jadwal) {
            return response()->json([
                'code' => 200,
                'message' => 'success, Data Jadwal berhasil ditambahkan',
                'data' => $jadwal
            ], 200);
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
        $data = Jadwal::find($id);
        if ($data) {
            return response()->json([
                'code' => 200,
                'message' => 'success, Data Ditemukan',
                'data' => $data
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
            'jadwal' => 'required|string|max:255',
            'matakuliah_id' => 'required|numeric',

        ]);

        // update Jadwal
        $jadwal = Jadwal::find($id);
        $jadwal->jadwal = $request->jadwal;
        $jadwal->matakuliah_id = $request->matakuliah_id;
        $jadwal->save();

        if ($jadwal) {
            return response()->json([
                'code' => 200,
                'message' => 'success, Data Jadwal berhasil diubah',
                'data' => $jadwal
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jadwal = Jadwal::find($id);
        $jadwal->delete();

        if ($jadwal) {
            return response()->json([
                'code' => 200,
                'message' => 'success, Data Jadwal berhasil dihapus',
                'data' => $jadwal
            ], 200);
        } else {
            return response()->json([
                'code' => 500,
                'message' => 'error',
                'data' => 'Data tidak ditemukan'
            ], 500);
        }
    }
}
