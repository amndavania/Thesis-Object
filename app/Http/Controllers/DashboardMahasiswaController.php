<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardMahasiswaController extends Controller
{
public function index():View
    {
        // $cashflowController = new CashFlowController;
        // $labarugiController = new LabaRugiController;

        // $date = date('Y-m');
        // $filter = 'month';

        // $financeThisYear = $this->setTrendKeuangan('ThisYear');
        // $financeLastYear = $this->setTrendKeuangan('LastYear');

        // $growPercentagePreviousMonth = $this->setPersen(intval(substr($date, 5, 2)), $financeThisYear);
        // $growPercentagePreviousMonth2 = $this->setPersen(intval(substr($date, 5, 2))-1, $financeThisYear);

        // $cashflow_group = [
        //     'arusKasMasuk' => 11,
        //     'arusKasKeluar' => 12,
        //     'penjualanAset' => 13,
        //     'pembelianAset' => 14,
        //     'penambahanDana' => 15,
        //     'penguranganDana' => 16,
        // ];

        // $labarugi_group = [
        //     'pendapatan' => 1,
        //     'pengeluaran' => 2,
        //     'penyusutanAmortisasi' => 3,
        //     'bungaPajak' => 4,
        //     'pendapatanPengeluaranLain' => 5,
        // ];

        // $saldoAkhir = $this->setSaldoAkhir($cashflowController, $filter, $date, $cashflow_group);
        // $saldoLabaRugi = $this->setLabaRugi($labarugiController, $filter, $date, $labarugi_group);

        $students = Student::all();
        $transactions = Transaction::latest()->take(5)->get();

        return view('dashboard')->with([
            // 'saldo' => $saldoAkhir,
            // 'labarugi' => $saldoLabaRugi,
            // 'students' => $students->count(),
            // 'trendKeuangan' => [$financeThisYear, $financeLastYear],
            // 'transactions' => $transactions,
            // 'growPercentage' => [$growPercentagePreviousMonth, $growPercentagePreviousMonth2],
            // 'saldoBulanLalu' => $financeThisYear[intval(substr($date, 5, 2))-2],
            // 'statusUKT' => [200, 100, 50]
        ]);
    }
}
