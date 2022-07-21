<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/dashboarddosen', function () {
    return view('dashboard');
})->middleware(['dosen'])->name('dashboard');

Route::get('/dashboard', function(){
    return "afa iyah";
})->middleware('mahasiswa');

// delete session
Route::get('/logout', function(){
    Auth::logout();
    return redirect('/');
})->name('logout');

require __DIR__.'/auth.php';
