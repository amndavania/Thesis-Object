<?php

namespace App\Http\Controllers;

use App\Models\ExamCard;
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
}
