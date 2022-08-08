<?php

namespace App\Http\Controllers\API;

use App\Models\Semester;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SemesterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Semester::paginate(10);

        return response()->json([
            'code' => 200,
            'message' => 'success',
            'data' => $data
        ], 200);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'semester' => 'required|numeric|max:255',
        ]);

        // create new Semester
        $semester = Semester::create([
            'semester' => $request->semester,
        ]);

        if ($semester) {
            return response()->json([
                'code' => 200,
                'message' => 'success, Data Semester berhasil ditambahkan',
                'data' => $semester
            ], 200);
        } else {
            return response()->json([
                'code' => 500,
                'message' => 'error, Data Semester gagal ditambahkan',
                'data' => null
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // find Semester by id
        $data = Semester::find($id);
        if ($data) {
            return response()->json([
                'code' => 200,
                'message' => 'success, Data Ditemukan',
                'data' => $data
            ], 200);
        } else {
            return response()->json([
                'code' => 500,
                'message' => 'error',
                'data' => null
            ], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'semester' => 'required|numeric|max:255',
        ]);

        // find Semester by id
        $semester = Semester::find($id);
        if ($semester) {
            // update Semester
            $semester->semester = $request->semester;
            $semester->save();
            return response()->json([
                'code' => 200,
                'message' => 'success, Data Semester berhasil diubah',
                'data' => $semester
            ], 200);
        } else {
            return response()->json([
                'code' => 500,
                'message' => 'error, Data Semester gagal diubah',
                'data' => null
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // find Semester by id
        $semester = Semester::find($id);
        if ($semester) {
            // delete Semester
            $semester->delete();
            return response()->json([
                'code' => 200,
                'message' => 'success, Data Semester berhasil dihapus',
                'data' => $semester
            ], 200);
        } else {
            return response()->json([
                'code' => 500,
                'message' => 'error, Data Semester gagal dihapus',
                'data' => null
            ], 500);
        }
    }
}
