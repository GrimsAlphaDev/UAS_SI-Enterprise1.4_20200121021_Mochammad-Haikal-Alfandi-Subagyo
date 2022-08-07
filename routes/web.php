<?php

use LDAP\Result;
use App\Models\Absen;
use App\Models\Mahasiswa;
use App\Models\Matakuliah;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AbsenController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\SemesterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MahasiswaController;
use phpDocumentor\Reflection\Types\Resource_;
use App\Http\Controllers\MatakuliahController;
use App\Http\Controllers\KontrakMatakuliahController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcomepage');
});


// delete session
Route::get('/logout', function(){
    Auth::logout();
    return redirect('/');
})->name('logout');

Route::middleware('auth')->group(function () {
    // resouce route
    Route::resource('/dashboard', DashboardController::class);
    Route::resource('/mahasiswa', MahasiswaController::class);
    Route::resource('/matakuliah', MatakuliahController::class);
    Route::resource('/jadwal', JadwalController::class);
    Route::resource('/semester', SemesterController::class);
    Route::resource('/kontrak', KontrakMatakuliahController::class);
    Route::resource('/absen', AbsenController::class);
    
});

Route::get('/getabsen/{id}', function ($id) {
    $absens = Absen::where('matakuliah_id', $id)->paginate(10);
    $matakuliah = Matakuliah::where('id', $id)->first();
    // return mahasiswa thats hasn't absen
    $mahasiswas = Mahasiswa::whereNotIn('id', $absens->pluck('mahasiswa_id'))->get();
    return view('absen.show', compact('absens', 'matakuliah', 'mahasiswas'));
})->middleware('auth')->name('getabsen');


require __DIR__.'/auth.php';
