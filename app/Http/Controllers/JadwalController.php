<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Http\Requests\StoreJadwalRequest;
use App\Http\Requests\UpdateJadwalRequest;
use App\Models\Matakuliah;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('jadwal.index', [

            'jadwals' => Jadwal::paginate(10),
            // select matakuliah that dont have jadwal
            'matakuliahs' => Matakuliah::all()->whereNotIn('id', Jadwal::pluck('matakuliah_id')),
            'matkulselected' => Matakuliah::all(),
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
     * @param  \App\Http\Requests\StoreJadwalRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreJadwalRequest $request)
    {
        // validate the request
        $request->validate([
            'hari' => 'required|string',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'matakuliah_id' => 'required',
        ]);

        // unite jadwal from hari, jam_mulai - jam_selesai
        $jadwal = $request->hari . ', ' . $request->jam_mulai . ' - ' . $request->jam_selesai;

        // create the jadwal
        try {
            $newjadwal = Jadwal::create([
                'jadwal' => $jadwal,
                'matakuliah_id' => $request->matakuliah_id,
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

        if ($newjadwal){
            return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil ditambahkan');
        } else {
            return redirect()->back()->with('error', 'Jadwal gagal ditambahkan');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function show(Jadwal $jadwal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function edit(Jadwal $jadwal)
    {
       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateJadwalRequest  $request
     * @param  \App\Models\Jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateJadwalRequest $request, Jadwal $jadwal)
    {
         // Validate request
         $request->validate([
            'hari' => 'required|string',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'matakuliah_id' => 'required',
        ]);

        // unite jadwal from hari, jam_mulai - jam_selesai
        $newjadwal = $request->hari . ', ' . $request->jam_mulai . ' - ' . $request->jam_selesai;

        // update the jadwal
        try {
            $jadwal->update([
                'jadwal' => $newjadwal,
                'matakuliah_id' => $request->matakuliah_id,
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

        if ($jadwal){
            return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil diubah');
        } else {
            return redirect()->back()->with('error', 'Jadwal gagal diubah');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Jadwal $jadwal)
    {
        // delete the jadwal
        try {
            $jadwal->delete();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

        if ($jadwal){
            return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil dihapus');
        } else {
            return redirect()->back()->with('error', 'Jadwal gagal dihapus');
        }
    }
}
