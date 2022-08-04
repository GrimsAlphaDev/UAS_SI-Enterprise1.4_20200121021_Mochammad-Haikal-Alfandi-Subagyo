<?php

use App\Http\Controllers\DashboardController;
use LDAP\Result;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\KontrakMatakuliahController;
use App\Http\Controllers\SemesterController;
use App\Http\Controllers\MahasiswaController;
use phpDocumentor\Reflection\Types\Resource_;
use App\Http\Controllers\MatakuliahController;

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
    
});

require __DIR__.'/auth.php';
