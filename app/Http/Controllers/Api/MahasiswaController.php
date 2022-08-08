<?php

namespace App\Http\Controllers\API;

use App\Models\Mahasiswa;
use App\Helper\ApiFormatter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Mahasiswa::paginate(10);

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
            'nama_mahasiswa' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'no_tlp' => 'required|numeric',
            'email' => 'required|string|email|max:255|unique:mahasiswas',
        ]);

        $mahasiswa = Mahasiswa::create([
            'nama_mahasiswa' => $request->nama_mahasiswa,
            'alamat' => $request->alamat,
            'no_tlp' => $request->no_tlp,
            'email' => $request->email,
        ]);

        if($mahasiswa) {
            return response()->json([
                'code' => 200,
                'message' => 'success, Data Mahasiswa Berhasil Ditambah',
                'data' => $mahasiswa
            ], 200);
        } else {
            return response()->json([
                'code' => 500,
                'message' => 'error, Data Mahasiswa Gagal Ditambah',
                'data' => null
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
        $mahasiswa = Mahasiswa::find($id);
        if($mahasiswa) {
            return response()->json([
                'code' => 200,
                'message' => 'success, Data Mahasiswa Berhasil Ditemukan',
                'data' => $mahasiswa
            ], 200);
        } else {
            return response()->json([
                'code' => 500,
                'message' => 'error, Data Mahasiswa Gagal Ditemukan',
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
        $mahasiswa = Mahasiswa::find($id)->update([
            'nama_mahasiswa' => $request->nama_mahasiswa,
            'alamat' => $request->alamat,
            'no_tlp' => $request->no_tlp,
            'email' => $request->email,
        ]);

        if($mahasiswa) {
            return response()->json([
                'code' => 200,
                'message' => 'success, Data Mahasiswa Diedit',
                'data' => $mahasiswa
            ], 200);
        } else {
            return response()->json([
                'code' => 500,
                'message' => 'error, Data Mahasiswa Gagal Diedit',
                'data' => null
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
        $mahasiswa = Mahasiswa::find($id)->delete();
        if($mahasiswa) {
            return response()->json([
                'code' => 200,
                'message' => 'success, Data Mahasiswa Berhasil Dihapus',
                'data' => $mahasiswa
            ], 200);
        } else {
            return response()->json([
                'code' => 500,
                'message' => 'error, Data Mahasiswa Gagal Dihapus',
                'data' => null
            ], 500);
        }
    }
}
