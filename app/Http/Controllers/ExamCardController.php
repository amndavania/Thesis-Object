<?php

namespace App\Http\Controllers;

use App\Models\ExamCard;
use App\Models\Student;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ExamCardController extends Controller
{

    public function index():View
    {
        //
        return view('exam_card.data')->with([
            'examcard' => ExamCard::paginate(20)
        ]);
    }

    public function show(Request $request):View
    {
        $card = ExamCard::where('id', $request->id)->first();
        $student = Student::where('id', $card->students_id)->first();

        return view('report.printformat.examcard')->with([
            'examcard' => $card,
            'student' => $student
        ]);
    }
}
