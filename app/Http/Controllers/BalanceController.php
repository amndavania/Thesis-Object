<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Http\Response;
use App\Models\Balance;


class BalanceController extends Controller
{
    //
    public function index(): View
    {
        return view('balance.data')->with([
            'balance' => Balance::All()
        ]);
    }
}
