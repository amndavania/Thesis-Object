<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\StudentType;
use App\Models\StudyProgram;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Student\StudentCreateRequest;
use App\Http\Requests\Student\StudentUpdateRequest;
use App\Models\Dpa;
use App\Models\Ukt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $student_search = DB::table('students')
            ->select('students.id', 'students.name', 'students.nim')
            ->get();
        $prodi = DB::table('study_programs')
            ->select('study_programs.id','study_programs.name')
            ->get();
        $angkatan = DB::table('students')
            ->select('force')
            ->distinct()
            ->orderBy('force', 'desc')
            ->get();
        
        if (!empty($request['students_id'])) {
            $student =  $student = DB::table('students')
            ->where('students.id','=',$request['students_id'])
            ->leftJoin('ukts', 'students.id', '=', 'ukts.students_id')
            ->leftJoin('student_types', 'students.student_types_id', '=', 'student_types.id')
            ->leftJoin('study_programs', 'students.study_program_id', '=', 'study_programs.id')
            ->leftJoin('dpas', 'students.dpa_id', '=', 'dpas.id')
            ->select('students.id', 'students.name', 'students.nim', 'students.force', 'dpas.name AS dpas_name', 'student_types.type AS student_type', 'study_programs.name AS study_program_name', DB::raw('MAX(ukts.status) AS status'))
            ->groupBy('students.id', 'students.name', 'students.nim', 'students.force', 'dpas_name', 'student_type', 'study_program_name')
            ->paginate(20);

        } elseif (!empty($request['prodi_search_id']) && !empty($request['angkatan_search_id'])) {
            $student = DB::table('students')
            ->where('students.force', '=', $request['angkatan_search_id'])
            ->where('students.study_program_id', '=', $request['prodi_search_id'])
            ->leftJoin('ukts', 'students.id', '=', 'ukts.students_id')
            ->leftJoin('student_types', 'students.student_types_id', '=', 'student_types.id')
            ->leftJoin('study_programs', 'students.study_program_id', '=', 'study_programs.id')
            ->leftJoin('dpas', 'students.dpa_id', '=', 'dpas.id')
            ->select('students.id', 'students.name', 'students.nim', 'students.force', 'dpas.name AS dpas_name', 'student_types.type AS student_type', 'study_programs.name AS study_program_name', DB::raw('MAX(ukts.status) AS status'))
            ->groupBy('students.id', 'students.name', 'students.nim', 'students.force', 'dpas_name', 'student_type', 'study_program_name')
            ->paginate(20);

        } elseif (!empty($request['prodi_search_id'])) {
            $student = DB::table('students')
            ->where('students.study_program_id', '=', $request['prodi_search_id'])
            ->leftJoin('ukts', 'students.id', '=', 'ukts.students_id')
            ->leftJoin('student_types', 'students.student_types_id', '=', 'student_types.id')
            ->leftJoin('study_programs', 'students.study_program_id', '=', 'study_programs.id')
            ->leftJoin('dpas', 'students.dpa_id', '=', 'dpas.id')
            ->select('students.id', 'students.name', 'students.nim', 'students.force', 'dpas.name AS dpas_name', 'student_types.type AS student_type', 'study_programs.name AS study_program_name', DB::raw('MAX(ukts.status) AS status'))
            ->groupBy('students.id', 'students.name', 'students.nim', 'students.force', 'dpas_name', 'student_type', 'study_program_name')
            ->paginate(20);

        } elseif (!empty($request['angkatan_search_id'])) {
            $student = DB::table('students')
            ->where('students.force', '=', $request['angkatan_search_id'])
            ->leftJoin('ukts', 'students.id', '=', 'ukts.students_id')
            ->leftJoin('student_types', 'students.student_types_id', '=', 'student_types.id')
            ->leftJoin('study_programs', 'students.study_program_id', '=', 'study_programs.id')
            ->leftJoin('dpas', 'students.dpa_id', '=', 'dpas.id')
            ->select('students.id', 'students.name', 'students.nim', 'students.force', 'dpas.name AS dpas_name', 'student_types.type AS student_type', 'study_programs.name AS study_program_name', DB::raw('MAX(ukts.status) AS status'))
            ->groupBy('students.id', 'students.name', 'students.nim', 'students.force', 'dpas_name', 'student_type', 'study_program_name')
            ->paginate(20);
        }
        else {
            $student = DB::table('students')
            ->leftJoin('ukts', 'students.id', '=', 'ukts.students_id')
            ->leftJoin('student_types', 'students.student_types_id', '=', 'student_types.id')
            ->leftJoin('study_programs', 'students.study_program_id', '=', 'study_programs.id')
            ->leftJoin('dpas', 'students.dpa_id', '=', 'dpas.id')
            ->select('students.id', 'students.name', 'students.nim', 'students.force', 'dpas.name AS dpas_name', 'student_types.type AS student_type', 'study_programs.name AS study_program_name', DB::raw('MAX(ukts.status) AS status'))
            ->groupBy('students.id', 'students.name', 'students.nim', 'students.force', 'dpas_name', 'student_type', 'study_program_name')
            ->paginate(20);
        }
            
        return view('student.data')->with([
            'student' => $student,
            'student_search' => $student_search,
            'prodi_search' => $prodi,
            'angkatan_search' => $angkatan,
        ]);
    }

    public function create():View
    {
        $study_program = StudyProgram::all();
        $student_type = StudentType::all();
        $dpa = Dpa::all();
        return view('student.create', compact('study_program', 'student_type', 'dpa'));
    }

    public function store(StudentCreateRequest $request):RedirectResponse
    {

        Student::create($request->all());
        return redirect()->route('student.index')->with(['success' => 'Data berhasil disimpan']);
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id):View
    {
        //
        return view('student.edit')->with([
            'student' => Student::findOrFail($id),
            "study_program" => StudyProgram::all(),
            "student_type" => StudentType::all(),
           "dpa" => Dpa::all()
        ]);
    }

    public function update(StudentUpdateRequest $request, string $id):RedirectResponse
    {

        $student = Student::findOrFail($id);
        $student->update($request->all());
        return redirect()->route('student.index')->with(['success' => 'Data berhasil diupdate']);
    }

    public function destroy($id):RedirectResponse
    {
        $ukt = Ukt::where('students_id', $id)->exists();

        if (!$ukt) {
            $student = Student::findOrFail($id);
            $student->delete();
            return redirect()->route('student.index')->with(['success' => 'Data berhasil dihapus']);
        } else {
            return redirect()->route('student.index')->with(['warning' => 'Mahasiswa masih terhubung dengan Pembayaran Mahasiswa']);
        }
    }
}
