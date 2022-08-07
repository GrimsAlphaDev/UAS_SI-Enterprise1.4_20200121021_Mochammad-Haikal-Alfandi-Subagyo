<?php

namespace App\Http\Controllers;

use App\Models\Semester;
use App\Models\Mahasiswa;
use App\Models\Kontrak_matakuliah;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreKontrak_matakuliahRequest;
use App\Http\Requests\UpdateKontrak_matakuliahRequest;
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
        $kontrak_matakuliahs = Kontrak_matakuliah::paginate(10);
        $mahasiswas = Mahasiswa::all();
        $semesters = Semester::all();
        $mahasiswafresh = Mahasiswa::whereNotIn('id', function ($query) {
            $query->select('mahasiswa_id')->from('kontrak_matakuliahs');
        })->get();


        return view('kontrak.index', compact('kontrak_matakuliahs', 'mahasiswas', 'semesters', 'mahasiswafresh'));
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
     * @param  \App\Http\Requests\StoreKontrak_matakuliahRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreKontrak_matakuliahRequest $request)
    {
        // validate request
        $request->validate([
            'mahasiswa_id' => 'required|unique:kontrak_matakuliahs',
            'semester_id' => 'required',
        ]);

        // create new kontrak_matakuliah

        try {
            $kontrak = Kontrak_matakuliah::create([
                'mahasiswa_id' => $request->mahasiswa_id,
                'semester_id' => $request->semester_id,
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

        if($kontrak) {
            return redirect()->route('kontrak.index')->with('success', 'Kontrak matakuliah berhasil ditambahkan');
        } else {
            return redirect()->back()->with('error', 'Kontrak matakuliah gagal ditambahkan');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kontrak_matakuliah  $kontrak_matakuliah
     * @return \Illuminate\Http\Response
     */
    public function show(Kontrak_matakuliah $kontrak_matakuliah)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kontrak_matakuliah  $kontrak_matakuliah
     * @return \Illuminate\Http\Response
     */
    public function edit(Kontrak_matakuliah $kontrak_matakuliah)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateKontrak_matakuliahRequest  $request
     * @param  \App\Models\Kontrak_matakuliah  $kontrak_matakuliah
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateKontrak_matakuliahRequest $request, Kontrak_matakuliah $kontrak_matakuliah)
    {
        
        try {
        $edit = Kontrak_matakuliah::find($request->id)->
            update([
                'mahasiswa_id' => $request->mahasiswa_id,
                'semester_id' => $request->semester_id,
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
        

        if($edit) {
            return redirect()->route('kontrak.index')->with('success', 'Kontrak matakuliah berhasil diubah');
        } else {
            return redirect()->back()->with('error', 'Kontrak matakuliah gagal diubah');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kontrak_matakuliah  $kontrak_matakuliah
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kontrak_matakuliah $kontrak_matakuliah, Request $request )
    {

        // delete kontrak_matakuliah
        try {
            $kontrak_matakuliah = Kontrak_matakuliah::find($request->id)->delete();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

        if($kontrak_matakuliah) {
            return redirect()->route('kontrak.index')->with('success', 'Kontrak matakuliah berhasil dihapus');
        } else {
            return redirect()->back()->with('error', 'Kontrak matakuliah gagal dihapus');
        }
    }
}
