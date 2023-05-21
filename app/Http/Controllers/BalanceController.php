<?php

namespace App\Http\Controllers;

use App\Models\Balance;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

// use App\Models\Balance;


class BalanceController extends Controller
{
    //
    public function index(): View
    {   
        $balance = DB::table('balance')
                        ->join('transaction_account','');

        return view('balance.data')->with([
            'balance' => Balance::All(),
        ]);
    }
}
