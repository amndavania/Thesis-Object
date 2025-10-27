<?php

namespace App\Http\Controllers;

use App\Models\Dpa;
use App\Models\User;
use App\Models\Student;
use App\Models\BimbinganStudy;
use App\Models\StudyProgram;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Dpa\DpaCreateRequest;
use App\Http\Requests\Dpa\DpaUpdateRequest;

class DpaController extends Controller
{
    // ==============================
    // SECTION: VIEW HANDLING
    // ==============================

    public function index(): View
    {
        return view('dpa.data')->with([
            'dpa' => Dpa::latest()->paginate(30),
        ]);
    }

    public function create(): View
    {
        $study_program = StudyProgram::all();
        return view('dpa.create', compact('study_program'));
    }

    public function edit(string $id): View
    {
        return view('dpa.edit')->with([
            'dpa' => Dpa::findOrFail($id),
            'study_program' => StudyProgram::all(),
        ]);
    }

    public function show(string $id)
    {
        // Belum digunakan
    }

    public function getData($datepicker, $filter)
    {
        $date = date('Y-m');
        $formattedDate = date('F Y');

        if (!empty($datepicker)) {
            if ($filter == 'month') {
                $parsedDate = \DateTime::createFromFormat('m-Y', $datepicker);
                $date = $parsedDate->format('Y-m');
                $formattedDate = $parsedDate->format('F Y');
            } elseif ($filter == 'year') {
                $parsedDate = \DateTime::createFromFormat('Y', $datepicker);
                $date = $parsedDate->format('Y');
                $formattedDate = $parsedDate->format('Y');
            }
        }

        return [$date, $formattedDate];
    }

    // ==============================
    // SECTION: CREATE / UPDATE / DELETE
    // ==============================

    public function store(DpaCreateRequest $request): RedirectResponse
    {
        $name = $request->name;
        $email = $request->email;
        $study_program = $request->study_program_id;
        $password = bcrypt('admin');
        $role = 'DPA';

        $user = $this->addUser($name, $email, $password, $role);

        // $user_id = User::where('name', $name)->first();
        Dpa::create([
            'name' => $name,
            'email' => $email,
            'study_program_id' => $study_program,
            'user_id' => $user->id,
        ]);

        return redirect()->route('dpa.index')->with(['success' => 'Data berhasil disimpan']);
    }

    public function update(DpaUpdateRequest $request, string $id): RedirectResponse
    {
        $dpa = Dpa::findOrFail($id);
        $dpa->update($request->all());

        $user = User::findOrFail($dpa->user_id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->route('dpa.index')->with(['success' => 'Data berhasil diupdate']);
    }

    public function destroy($id): View|RedirectResponse
    {
        $dpa = Dpa::findOrFail($id);
        $studentExists = Student::where('dpa_id', $id)->exists();

        if (!$studentExists) {
            $user = User::findOrFail($dpa->user_id);
            $dpa->delete();
            $user->delete();
        } else {
            return redirect()->route('dpa.index')->with(['warning' => 'Data DPA masih terhubung dengan data Mahasiswa']);
        }

        return view('dpa.data')->with([
            'dpa' => Dpa::latest()->paginate(30),
        ]);
    }

    public function getDetailDpa(Request $request, string $id): RedirectResponse //ini method yang kayanya uda dihapus
    {
        // $dpa = Dpa::findOrFail($id);
        // $dpa->update($request->all());

        // $user = User::findOrFail($dpa->user_id);
        // $user->update([
        //     'status' => 'Aktif',
        // ]);

        // return redirect()->route('dpa.index')->with(['success' => 'Data berhasil diupdate']);
    }

    // ==============================
    // SECTION: HELPER
    // ==============================

    private function addUser($name, $email, $password, $role)
    {
        return User::create([
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'role' => $role,
        ]);
    }
}

