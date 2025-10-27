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
use App\Repositories\StudentRepositoryInterface;

class StudentController extends Controller
{
    protected $studentRepo;

    public function __construct(StudentRepositoryInterface $studentRepo)
    {
        $this->studentRepo = $studentRepo;
    }

    public function index(Request $request)
    {
        $filters = [
            'students_id' => $request['students_id'] ?? null, 
            'prodi_search_id' => $request['prodi_search_id'] ?? null,
            'angkatan_search_id' => $request['angkatan_search_id'] ?? null,
        ];

        $student = $this->studentRepo->getAll($filters);
        $student_search = \DB::table('students')->select('id','name','nim')->get(); 
        $prodi = \DB::table('study_programs')->select('id','name')->get();
        $angkatan = \DB::table('students')->select('force')->distinct()->orderBy('force','desc')->get();

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
        //ini maksudnya store
        $this->studentRepo->create($request->all());
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
            'student' => $this->studentRepo->findById($id),
            "study_program" => StudyProgram::all(),
            "student_type" => StudentType::all(),
           "dpa" => Dpa::all()
        ]);
    }

    public function update(StudentUpdateRequest $request, string $id):RedirectResponse
    {

        $this->studentRepo->update($id, $request->all());
        return redirect()->route('student.index')->with(['success' => 'Data berhasil diupdate']);
    }

    public function destroy($id): RedirectResponse
    {
        if (!$this->studentRepo->hasUkt($id)) {
            $this->studentRepo->delete($id);
            return redirect()->route('student.index')->with(['success' => 'Data berhasil dihapus']);
        } else {
            return redirect()->route('student.index')->with(['warning' => 'Mahasiswa masih terhubung dengan Pembayaran Mahasiswa']);
        }
    }
}
