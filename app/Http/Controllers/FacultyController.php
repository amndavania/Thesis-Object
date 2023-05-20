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
    public function index()
    {
        //
        return view('faculty.data')->with([
            'faculty' => Faculty::All()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('faculty.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request):RedirectResponse
    {
        //
        $request->validate([
            'name'=>'required',
        ]);

        // Faculty::create($request->all());
        Faculty::create([
            'name' => $request->name,
        ]);
        // DB::table('faculty')->insert($request->all());
        // DB::table('faculty')->insert(
        //     [
        //         'name' => $request->name,
        //     ]
        // );

        // $faculty = new Faculty;
        // $faculty->name=$request->name;
        // $faculty->save();

        return redirect()->route('faculty.index')
                        ->with('message','Data telah ditambahkan');
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
    public function edit(string $id)
    {
        //
        return view('faculty.edit',compact('faculty'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'name'=>'required',
        ]);

        $faculty = Faculty::find($id);
        $faculty->name = $request->name;
        $faculty->save();

        // $faculty = new Faculty;
        // $faculty->name=$request->name;
        // $faculty->save();

        return redirect()->route('faculty.index')
                        ->with('message','Data telah disimpan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $faculty = Faculty::find($id);
        $faculty->delete();

        return redirect()->route('faculty.index')
                        ->with('message','Data telah disimpan');
    }
}
