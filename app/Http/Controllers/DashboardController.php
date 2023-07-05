<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Report\CashFlowController;
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
        $cashflowController = new CashFlowController;
        $labarugiController = new LabaRugiController;

        $date = date('Y-m');
        $filter = 'month';

        $cashflow_group = [
            'arusKasMasuk' => 11,
            'arusKasKeluar' => 12,
            'penjualanAset' => 13,
            'pembelianAset' => 14,
            'penambahanDana' => 15,
            'penguranganDana' => 16,
        ];

        $labarugi_group = [
            'pendapatan' => 1,
            'pengeluaran' => 2,
            'penyusutanAmortisasi' => 3,
            'bungaPajak' => 4,
            'pendapatanPengeluaranLain' => 5,
        ];

        $cashflow = $cashflowController->setResults($filter, $date, $cashflow_group);
        $saldoAwal = $cashflowController->getSaldoAwal($filter, $date);
        $saldoAkhir = array_sum(array_map(function ($group) {
            return array_sum(array_column($group, 'saldo'));
        }, $cashflow)) + $saldoAwal;

        $labarugi = $labarugiController->setResults($filter, $date, $labarugi_group);
        $saldoLabaRugi = array_sum(array_map(function ($group) {
            return array_sum(array_column($group, 'saldo'));
        }, $labarugi));

        $students = Student::all();

        return view('dashboard')->with([
            'saldo' => $saldoAkhir,
            'labarugi' => $saldoLabaRugi,
            'students' => $students->count(),
        ]);
    }

}
