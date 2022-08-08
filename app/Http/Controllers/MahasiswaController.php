<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Http\Requests\StoreMahasiswaRequest;
use App\Http\Requests\UpdateMahasiswaRequest;

class MahasiswaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     
    public function index()
    {
        return view('mahasiswa.index', [
            'mahasiswas' => Mahasiswa::paginate(10),
        ]); 
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
     * @param  \App\Http\Requests\StoreMahasiswaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMahasiswaRequest $request)
    {
        // validate request
        $request->validate([
            'nama_mahasiswa' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'no_tlp' => 'required|numeric',
            'email' => 'required|string|email|max:255|unique:mahasiswas',
        ]);

        // create mahasiswa
        try {
            $mahasiswa = Mahasiswa::create([
            'nama_mahasiswa' => $request->nama_mahasiswa,
            'alamat' => $request->alamat,
            'no_tlp' => $request->no_tlp,
            'email' => $request->email,
        ]);
        } catch (\Exception $e) {
            return $e->getMessage();
        }

        // if success, redirect to mahasiswa index
        if($mahasiswa) {
            return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa berhasil ditambahkan');
        } else {
            return redirect()->back()->with('error', 'Mahasiswa gagal ditambahkan');
        }
       


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mahasiswa  $mahasiswa
     * @return \Illuminate\Http\Response
     */
    public function show(Mahasiswa $mahasiswa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mahasiswa  $mahasiswa
     * @return \Illuminate\Http\Response
     */
    public function edit(Mahasiswa $mahasiswa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMahasiswaRequest  $request
     * @param  \App\Models\Mahasiswa  $mahasiswa
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMahasiswaRequest $request, Mahasiswa $mahasiswa)
    {
        // validate request
        $request->validate([
            'nama_mahasiswa' => 'required|string|max:255|unique:mahasiswas,nama_mahasiswa,'.$mahasiswa->id,
            'alamat' => 'required|string|max:255',
            'no_tlp' => 'required|numeric',
            'email' => 'required|string|email|max:255',
        ]);

        // update mahasiswa
        try {
            $mahasiswa->update([
            'nama_mahasiswa' => $request->nama_mahasiswa,
            'alamat' => $request->alamat,
            'no_tlp' => $request->no_tlp,
            'email' => $request->email,
        ]);
        } catch (\Exception $e) {
            return $e->getMessage();
        }

        // if success, redirect to mahasiswa index
        if($mahasiswa) {
            return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa berhasil diubah');
        } else {
            return redirect()->back()->with('error', 'Mahasiswa gagal diubah');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mahasiswa  $mahasiswa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mahasiswa $mahasiswa)
    {
        // delete mahasiswa
        try {
            $mahasiswa->delete();
        } catch (\Exception $e) {
            return $e->getMessage();
        }

        // if success, redirect to mahasiswa index
        if($mahasiswa) {
            return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa berhasil dihapus');
        } else {
            return redirect()->back()->with('error', 'Mahasiswa gagal dihapus');
        }
    }
}
