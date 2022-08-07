<?php

namespace App\Http\Controllers;

use App\Models\Semester;
use App\Http\Requests\StoreSemesterRequest;
use App\Http\Requests\UpdateSemesterRequest;

class SemesterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $semesters = Semester::paginate(10);
        return view('semester.index', compact('semesters'));
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
     * @param  \App\Http\Requests\StoreSemesterRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSemesterRequest $request)
    {
        // validate the request
        $request->validate([
            'semester' => 'required|unique:semesters|integer|min:1|max:12',
        ]);

        // create the semester
        try {
            $semester = Semester::create([
                'semester' => $request->semester,
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

        if($semester) {
            return redirect()->route('semester.index')->with('success', 'Semester berhasil ditambahkan');
        } else {
            return redirect()->back()->withErrors(['error' => 'Semester gagal ditambahkan']);
        }

        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Semester  $semester
     * @return \Illuminate\Http\Response
     */
    public function show(Semester $semester)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Semester  $semester
     * @return \Illuminate\Http\Response
     */
    public function edit(Semester $semester)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSemesterRequest  $request
     * @param  \App\Models\Semester  $semester
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSemesterRequest $request, Semester $semester)
    {
        // validate the request
        $request->validate([
            'semester' => 'required|unique:semesters|integer|min:1|max:12',
        ]);

        // update the semester
        try {
            $semester->update([
                'semester' => $request->semester,
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

        if($semester) {
            return redirect()->route('semester.index')->with('success', 'Semester berhasil diubah');
        } else {
            return redirect()->back()->withErrors(['error' => 'Semester gagal diubah']);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Semester  $semester
     * @return \Illuminate\Http\Response
     */
    public function destroy(Semester $semester)
    {   
        // delete the semester
        try {
            $semester->delete();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

        if($semester) {
            return redirect()->route('semester.index')->with('success', 'Semester berhasil dihapus');
        } else {
            return redirect()->back()->withErrors(['error' => 'Semester gagal dihapus']);
        }
    }
}
