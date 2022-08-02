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
            'role' => 'required',
        ]);

        $mahasiswa = new \App\Models\User;
        $mahasiswa->name = $request->name;
        $mahasiswa->email = $request->email;
        $mahasiswa->password = Hash::make($request->password);
        $mahasiswa->role = $request->role;
        $mahasiswa->save();
        return redirect(RouteServiceProvider::HOME);
    }
    

}
