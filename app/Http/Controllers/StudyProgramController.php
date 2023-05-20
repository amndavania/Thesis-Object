<?php

namespace App\Http\Controllers;

use App\Models\StudyProgram;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class StudyProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index():View
    {
        //
        return view('study_program.data')->with([
            'study_program' => DB::table('study_programs')
                            ->join('faculties','study_programs.id','=','faculties.id')
                            ->select('study_programs.*','faculties.name as faculty')
                            ->get(),
            // 'study_program' => StudyProgram::join('faculty','faculty_id','=','faculty.id')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create():View
    {
        //
        return view('study_program.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request):RedirectResponse
    {
        //
        $this->validate($request,[
            'name'=>'required|min:5',
        ]);

        // StudyProgram::create($request->all());
        StudyProgram::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);
        // DB::table('study_program')->insert($request->all());
        // DB::table('study_program')->insert(
        //     [
        //         'name' => $request->name,
        //     ]
        // );

        // $study_program = new StudyProgram;
        // $study_program->name=$request->name;
        // $study_program->save();

        return redirect()->route('study_program.index')->with(['success' => 'Data telah disimpan']);
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
        $study_program = StudyProgram::findOrFail($id);
        return view('study_program.edit',compact('study_program'));
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

        $study_program = StudyProgram::findOrFail($id);
        $study_program->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('study_program.index')->with(['success' => 'Data telah disimpan']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id):RedirectResponse
    {
        //
        $study_program = StudyProgram::findOrFail($id);
        $study_program->delete();

        return redirect()->route('study_program.index')->with(['success' => 'Data telah disimpan']);
    }
}
