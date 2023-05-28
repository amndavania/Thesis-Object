<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Faculty;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class FacultyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index():View
    {
        //
        return view('faculty.data')->with([
            'faculty' => Faculty::paginate(20)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create():View
    {
        //
        return view('faculty.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $input = $request->validate([
            'name'=>'required',
        ]);

        Faculty::create($input);

        return redirect()->route('faculty.index')->with(['success' => 'Data telah disimpan']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id):View
    {
        //
        $faculty = Faculty::findOrFail($id);
        return view('faculty.edit',compact('faculty'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $this->validate($request,[
            'name'=>'required|min:5',
        ]);

        $faculty = Faculty::findOrFail($id);
        $faculty->update([
            'name' => $request->name,
        ]);

        return redirect()->route('faculty.index')->with(['success' => 'Data telah disimpan']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id):RedirectResponse
    {
        //
        $faculty = Faculty::findOrFail($id);
        $faculty->delete();

        return redirect()->route('faculty.index')->with(['success' => 'Data telah disimpan']);
    }
}
