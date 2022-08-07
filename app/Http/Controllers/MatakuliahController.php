<?php

namespace App\Http\Controllers;

use App\Models\Matakuliah;
use App\Http\Requests\StoreMatakuliahRequest;
use App\Http\Requests\UpdateMatakuliahRequest;

class MatakuliahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('matakuliah.index', [
            'matakuliahs' => Matakuliah::paginate(10),
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
     * @param  \App\Http\Requests\StoreMatakuliahRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMatakuliahRequest $request)
    {
        // validate Request
        $request->validate([
            'nama_matakuliah' => 'required|max:255|unique:matakuliahs',
            'sks' => 'required|numeric|max:20',
        ]);

        // create new Matakuliah
        try {
            $matakuliah = Matakuliah::create([
                'nama_matakuliah' => $request->nama_matakuliah,
                'sks' => $request->sks,
            ]);
         } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
         }

        // if success, redirect to index
        if($matakuliah) {
            return redirect()->route('matakuliah.index')->with('success', 'Matakuliah berhasil ditambahkan');
        } else {
            return redirect()->back()->with('error', 'Matakuliah gagal ditambahkan');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Matakuliah  $matakuliah
     * @return \Illuminate\Http\Response
     */
    public function show(Matakuliah $matakuliah)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Matakuliah  $matakuliah
     * @return \Illuminate\Http\Response
     */
    public function edit(Matakuliah $matakuliah)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMatakuliahRequest  $request
     * @param  \App\Models\Matakuliah  $matakuliah
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMatakuliahRequest $request, Matakuliah $matakuliah)
    {
        // validate Request
        $request->validate([
            'nama_matakuliah' => 'required|max:255|unique:matakuliahs,nama_matakuliah,'.$matakuliah->id,
            'sks' => 'required|numeric|max:20',
        ]);

        // update Matakuliah
        try {
            $matakuliah->update([
                'nama_matakuliah' => $request->nama_matakuliah,
                'sks' => $request->sks,
            ]);
         } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
         }

        // if success, redirect to index
        if($matakuliah) {
            return redirect()->route('matakuliah.index')->with('success', 'Matakuliah berhasil diubah');
        } else {
            return redirect()->back()->with('error', 'Matakuliah gagal diubah');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Matakuliah  $matakuliah
     * @return \Illuminate\Http\Response
     */
    public function destroy(Matakuliah $matakuliah)
    {
        // delete Matakuliah
        try {
            $matakuliah->delete();
         } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
         }

        // if success, redirect to index
        if($matakuliah) {
            return redirect()->route('matakuliah.index')->with('success', 'Matakuliah berhasil dihapus');
        } else {
            return redirect()->back()->with('error', 'Matakuliah gagal dihapus');
        }
    }
}
