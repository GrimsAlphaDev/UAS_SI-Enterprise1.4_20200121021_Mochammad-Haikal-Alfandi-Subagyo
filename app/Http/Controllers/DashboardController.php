<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Mahasiswa;
use App\Models\Matakuliah;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get last updated from Mahasiswa
        $mahasiswa = Mahasiswa::orderBy('updated_at', 'desc')->first();
        // get last updated from Matakuliah
        $matakuliah = Matakuliah::orderBy('updated_at', 'desc')->first();
        // get last updated from Jadwal
        $jadwal = Jadwal::orderBy('updated_at', 'desc')->first();

        return view('dashboard' , compact('mahasiswa', 'matakuliah', 'jadwal'));
    }
}
