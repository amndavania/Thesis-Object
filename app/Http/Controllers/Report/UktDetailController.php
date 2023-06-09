<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Ukt;
use Illuminate\Http\Request;

class UktDetailController extends Controller
{
    public function index(Request $request)
    {

        $student_id = $request->input('student_id');
        if (empty($student_id)) {
            return view('report.ukt')->with([
                'ukt' => Ukt::where('students_id', 1)->get(),
                'students' => Student::select('name', 'id', 'nim')->get(),
            ]);
        }else {
            return view('report.ukt')->with([
            'ukt' => Ukt::where('students_id', $student_id)->get(),
            'students' => Student::select('name', 'id', 'nim')->get(),
        ]);
        }
    }

    // public function export()
    // {
    //     $data = TransactionAccount::all();
    //     $pdf = PDF::loadView('report.printformat.bukubesar', compact('data'));
    //     $pdf->setOption('enable-local-file-access', true);
    //     Session::flash('title', 'Laporan Buku Besar');
    //     return $pdf->stream('Laporan Buku Besar.pdf');

    // }
}
