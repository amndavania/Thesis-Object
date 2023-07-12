<?php

namespace App\Http\Controllers;

use App\Models\Dpa;
use App\Models\User;
use App\Models\BimbinganStudy;
use Illuminate\Http\Request;
use App\Models\StudentType;
use App\Models\StudyProgram;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\dpa\DpaCreateRequest;
use App\Http\Requests\dpa\DpaUpdateRequest;
use App\Models\Student;
use App\Models\Ukt;
use Illuminate\Support\Facades\Auth;

class DpaController extends Controller
{
    public function index():View
    {
        return view('dpa.data')->with([
            'dpa' => Dpa::latest()->paginate(30),
        ]);
    }

    public function create():View
    {
        $study_program = StudyProgram::all();
        return view('dpa.create',  compact('study_program'));
    }

    public function store(DpaCreateRequest $request):RedirectResponse
    {

        // Simpan akun user DPA
        $name = $request->name;
        $email = $request->email;
        $study_program = $request->study_program_id;
        $password = bcrypt('admin');
        $role = 'DPA';
        $this->addUser($name, $email, $password, $role);

        // Simpan data DPA
        $user_id = User::where('name', $name)->first();
        Dpa::create([
            'name' => $name,
            'email' => $email,
            'study_program_id' => $study_program,
            'user_id' => $user_id['id'],
        ]);

        return redirect()->route('dpa.index')->with(['success' => 'Data berhasil disimpan']);
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
        return view('dpa.edit')->with([
            'dpa' => Dpa::findOrFail($id),
            "study_program" => StudyProgram::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DpaUpdateRequest $request, string $id):RedirectResponse
    {
        $dpa = Dpa::findOrFail($id);
        $dpa->update($request->all());

        $name = $request->name;
        $email = $request->email;

        $user_id = $dpa['user_id'];
        $user = User::findOrFail($user_id);
        $user->update([
            'name' => $name,
            'email' => $email,
        ]);

        return redirect()->route('dpa.index')->with(['success' => 'Data berhasil diupdate']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $dpa = Dpa::findOrFail($id);
        $student = Student::where('dpa_id', $id)->exists();

        if (!$student) {
            $user_id = $dpa['user_id'];
            $user = User::findOrFail($user_id);
            $dpa->delete();
            $user->delete();
        } else{
            return redirect()->route('dpa.index')->with(['warning' => 'Data DPA masih terhubung dengan data Mahasiswa']);
        }
        return view('dpa.data')->with([
            'dpa' => Dpa::latest()->paginate(30),
        ]);
    }

    public function addUser($name, $email, $password, $role)
    {
        User::create([
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'role' => $role,
        ]);
    }

    public function getMahasiswa(Request $request): View
    {
        $dpa_id = $request->dpa_id;
        $tahunAjaran = $request->year;
        $semester = $request->semester;
        $lbs_id = $request->input('id');

        if (empty($dpa_id)) {
            $user_id = Auth::user()->id;
            $dpa = Dpa::where('user_id', $user_id)->first();
            $dpa_id = $dpa->id;
        }

        if (empty($tahunAjaran) || empty($semester)) {
            $tahunAjaran = date('Y');
            $semester = "GASAL";
        }

        // if (empty($dpa_id)) {
        //     $dpa_id = Dpa::first()->id;
        // }

        $dpa = Dpa::where('id', $dpa_id)->first();
        $students = Student::where('dpa_id', $dpa_id)->get();

        if (!empty($lbs_id)) {
            $this->setujuKrs($lbs_id);
        }

        $data = $this->getBimbinganStudi($students, $tahunAjaran, $semester);

        return view('dpa.daftarmahasiswa')->with([
            'data' => $data,
            'tahunAjaran' => [$tahunAjaran, $semester],
            'dpa' => $dpa,

        ]);
    }

    public function export(Request $request)
    {
        $dpa_id = $request->dpa_id;
        $tahunAjaran = $request->year;
        $semester = $request->semester;

        if (empty($tahunAjaran) || empty($semester)) {
            $tahunAjaran = date('Y');
            $semester = "GASAL";
        }

        if (empty($dpa_id)) {
            $user_id = Auth::user()->id;
            $dpa = Dpa::where('user_id', $user_id)->first();
            $dpa_id = $dpa->id;
        }

        $dpa = Dpa::where('id', $dpa_id)->first();
        $students = Student::where('dpa_id', $dpa_id)->get();

        $data = $this->getBimbinganStudi($students, $tahunAjaran, $semester);

        return view('report.printformat.daftarmahasiswa')->with([
            'data' => $data,
            'tahunAjaran' => [$tahunAjaran, $semester],
            'dpa' => $dpa,
            'title' => "Lembar Bimbingan Studi",
            'today' => date('d F Y', strtotime(date('Y-m-d'))),
        ]);
    }

    public function setujuKrs($id)
    {
        $uktController = new UktController;

        $bimbinganStudy = BimbinganStudy::where('id', $id)->first();
        $bimbinganStudy->status = "Aktif";
        $bimbinganStudy->save();

        $payment = Ukt::where('lbs_id', $id)->first();
        if ($payment->keterangan == "UTS") {
            $payment->exam_uts_id = $uktController->createExamCard($payment->students_id, "UTS", $payment->semester, $payment->year);
        } elseif ($payment->keterangan == "UAS") {
            $payment->exam_uts_id = $uktController->createExamCard($payment->students_id, "UTS", $payment->semester, $payment->year);
            $payment->exam_uas_id = $uktController->createExamCard($payment->students_id, "UAS", $payment->semester, $payment->year);
        }
        $payment->save();
    }

    public function getBimbinganStudi($students, $tahunAjaran, $semester)
    {
        $data = [];
        foreach ($students as $item) {
            $bimbinganStudy = BimbinganStudy::where('students_id', $item->id)->where('year', $tahunAjaran)->where('semester', $semester)->first();
            if (empty($bimbinganStudy)) {
                $status = "Tidak Aktif";
                $lbs_id = null;
            } else {
                $lbs_id = $bimbinganStudy->id;
                $status = $bimbinganStudy->status;
            }

            if ($semester == "GASAL") {
                $semesterStudent = (($tahunAjaran - $item->force) * 2) + 1;
            } elseif ($semester == "GENAP") {
                $semesterStudent = (($tahunAjaran - $item->force) * 2);
            }

            if ($semesterStudent >= 1) {
                $data[$item->id] = [
                    'id' => $item->id,
                    'nim' => $item->nim,
                    'name' => $item->name,
                    'semester' => $semesterStudent,
                    'lbs_id' => $lbs_id,
                    'status' => $status
                ];
            }
        }

        return $data;
    }

    public function getDetailDpa(Request $request, string $id):RedirectResponse
    {
        $dpa = Dpa::findOrFail($id);
        $dpa->update($request->all());

        $user_id = $dpa['user_id'];
        $user = User::findOrFail($user_id);
        $user->update([
            'status' => 'Aktif',
        ]);

        return redirect()->route('dpa.index')->with(['success' => 'Data berhasil diupdate']);
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
}
