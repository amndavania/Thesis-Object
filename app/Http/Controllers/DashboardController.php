<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Report\LabaRugiController;
use App\Http\Controllers\Report\NeracaController;
use App\Models\HistoryReport;
use App\Models\Student;
use App\Models\Transaction;
use App\Models\TransactionAccount;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index():View
    {
        $neracaController = new NeracaController;
        $labarugiController = new LabaRugiController;

        $date = date('Y-m');
        $filter = 'month';

        $neraca_group = [
            'aktivaLancar' => 6,
            'aktivaTetap' => 7,
            'hutangLancar' => 8,
            'hutangJangkaPanjang' => 9,
            'modal' => 10,
        ];

        $labarugi_group = [
            'pendapatan' => 1,
            'pengeluaran' => 2,
            'penyusutanAmortisasi' => 3,
            'bungaPajak' => 4,
            'pendapatanPengeluaranLain' => 5,
        ];

        $neraca = $neracaController->setResults($filter, $date, $neraca_group);
        $saldoNeraca = array_sum(array_map(function ($group) {
            return array_sum(array_column($group, 'saldo'));
        }, $neraca));

        $labarugi = $labarugiController->setResults($filter, $date, $labarugi_group);
        $saldoLabaRugi = array_sum(array_map(function ($group) {
            return array_sum(array_column($group, 'saldo'));
        }, $labarugi));

        $students = Student::all();

        return view('dashboard')->with([
            'saldo' => $saldoNeraca,
            'labarugi' => $saldoLabaRugi,
            'students' => $students->count(),
        ]);
    }

}
