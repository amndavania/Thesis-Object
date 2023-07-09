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

class DpaController extends Controller
{
    public function index():View
    {
        return view('dpa.data')->with([
            'dpa' => Dpa::paginate(30),
        ]);
    }

    public function create():View
    {
        return view('dpa.create');
    }

    public function store(DpaCreateRequest $request):RedirectResponse
    {
        
        // Simpan akun user DPA
        $name = $request->name;
        $email = $request->email;
        $password = bcrypt('admin');
        $role = 'DPA';
        $this->addUser($name, $email, $password, $role);

        // Simpan data DPA
        $user_id = User::where('name', $name)->first();
        Dpa::create([
            'name' => $name,
            'email' => $email,
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
        $user_id = $dpa['user_id'];
        $user = User::findOrFail($user_id);
        $dpa->delete();
        $user->delete();
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
        $id = $request->input('id');
        $years = BimbinganStudy::select('year')
            ->distinct()
            ->get();
        
        if (!empty($id)) {
            $this->setujuKrs($id);
        }
    
        return view('dpa.daftarmahasiswa')->with([
            'data' => BimbinganStudy::paginate(30),
            'years' => $years,

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
