<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;

class AuthenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function storeMhs(Request $request){
        // Validate the request...
        $request->validate([
            'name' => 'required|max:255|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
            'kelas' => 'required|integer',
            'jenis_kelamin' => 'required|string',
            'role' => 'required',
        ]);

        // make nim that start with 2020010100 and increment by 1
        // if empty, then set nim to 2020010101
        $mahasiswa = new \App\Models\User;
        if(empty($mahasiswa->nim)){
            $mahasiswa->nim = '2020010101';
        }else{
            $mahasiswa->nim = $mahasiswa->nim + 1;
        }
        $mahasiswa->name = $request->name;
        $mahasiswa->email = $request->email;
        $mahasiswa->password = Hash::make($request->password);
        $mahasiswa->kelas_id = $request->kelas;
        $mahasiswa->jenis_kelamin = $request->jenis_kelamin;
        $mahasiswa->role = $request->role;
        $mahasiswa->save();
        return redirect(RouteServiceProvider::HOME);
    }
    

}
