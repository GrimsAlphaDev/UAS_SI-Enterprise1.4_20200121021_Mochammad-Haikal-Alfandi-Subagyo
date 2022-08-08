<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AbsenController;
use App\Http\Controllers\API\JadwalController;
use App\Http\Controllers\API\SemesterController;
use App\Http\Controllers\API\MahasiswaController;
use App\Http\Controllers\API\MatakuliahController;
use App\Http\Controllers\API\KontrakMatakuliahController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('mahasiswa', MahasiswaController::class);

// resource group
Route::resources(
    [
        'mahasiswa' => MahasiswaController::class,
        'matakuliah' => MatakuliahController::class,
        'jadwal' => JadwalController::class,
        'semester' => SemesterController::class,
        'kontrak' => KontrakMatakuliahController::class,
        'absen' => AbsenController::class,
    ]
);