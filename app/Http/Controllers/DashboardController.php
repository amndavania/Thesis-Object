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

        $financeThisYear = $this->setTrendKeuangan('ThisYear');
        $financeLastYear = $this->setTrendKeuangan('LastYear');

        // dd($financeThisYear);

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

        $saldoAkhir = $this->setSaldoAkhir($cashflowController, $filter, $date, $cashflow_group);
        $saldoLabaRugi = $this->setLabaRugi($labarugiController, $filter, $date, $labarugi_group);

        $students = Student::all();
        $transactions = Transaction::latest()->take(5)->get();

        return view('dashboard')->with([
            'saldo' => $saldoAkhir,
            'labarugi' => $saldoLabaRugi,
            'students' => $students->count(),
            'trendKeuangan' => [$financeThisYear, $financeLastYear],
            'transactions' => $transactions
        ]);
    }

    public function setSaldoAkhir($cashflowController, $filter, $date, $cashflow_group) {
        $saldo = [];
        $cashflow = $cashflowController->setResults($filter, $date, $cashflow_group);
        foreach ($cashflow as $key => $value) {
            $saldo_item = 0;
            foreach ($value as $item) {
                if (isset($item["saldo"])) {
                    $saldo_item += $item["saldo"];
                }
            }
            $saldo[$key] = $saldo_item;
        }
        $arusKasMasuk = $saldo["arusKasMasuk"];
        $arusKasKeluar = $saldo["arusKasKeluar"];
        $penjualanAset = $saldo["penjualanAset"];
        $pembelianAset = $saldo["pembelianAset"];
        $penambahanDana = $saldo["penambahanDana"];
        $penguranganDana = $saldo["penguranganDana"];

        $selisihKas = $arusKasMasuk - $arusKasKeluar;
        $selisihAset = $penjualanAset - $pembelianAset;
        $selisihDana = $penambahanDana - $penguranganDana;

        $total_saldo = $selisihKas + $selisihAset + $selisihDana;
        $saldoAwal = $cashflowController->getSaldoAwal($filter, $date);
        $saldoAkhir = $total_saldo + $saldoAwal;

        return $saldoAkhir;
    }

    public function setLabaRugi($labarugiController, $filter, $date, $labarugi_group) {
        $labarugi = $labarugiController->setResults($filter, $date, $labarugi_group);
        $saldoLabaRugi = array_sum(array_map(function ($group) {
            return array_sum(array_column($group, 'saldo'));
        }, $labarugi));

        return $saldoLabaRugi;
    }

    public function setTrendKeuangan($type) {
        $currentYear = date('Y');
        if ($type == "LastYear") {
            $currentYear -= 1;
        }

        $jan = intval(HistoryReport::whereRaw('DATE_FORMAT(created_at, "%Y-%m") = ?', [$currentYear . '-02'])->where('type', 'monthly')->sum('saldo'));
        $feb = intval(HistoryReport::whereRaw('DATE_FORMAT(created_at, "%Y-%m") = ?', [$currentYear . '-03'])->where('type', 'monthly')->sum('saldo'));
        $mar = intval(HistoryReport::whereRaw('DATE_FORMAT(created_at, "%Y-%m") = ?', [$currentYear . '-04'])->where('type', 'monthly')->sum('saldo'));
        $apr = intval(HistoryReport::whereRaw('DATE_FORMAT(created_at, "%Y-%m") = ?', [$currentYear . '-05'])->where('type', 'monthly')->sum('saldo'));
        $may = intval(HistoryReport::whereRaw('DATE_FORMAT(created_at, "%Y-%m") = ?', [$currentYear . '-06'])->where('type', 'monthly')->sum('saldo'));
        $jun = intval(HistoryReport::whereRaw('DATE_FORMAT(created_at, "%Y-%m") = ?', [$currentYear . '-07'])->where('type', 'monthly')->sum('saldo'));
        $jul = intval(HistoryReport::whereRaw('DATE_FORMAT(created_at, "%Y-%m") = ?', [$currentYear . '-08'])->where('type', 'monthly')->sum('saldo'));
        $aug = intval(HistoryReport::whereRaw('DATE_FORMAT(created_at, "%Y-%m") = ?', [$currentYear . '-09'])->where('type', 'monthly')->sum('saldo'));
        $sep = intval(HistoryReport::whereRaw('DATE_FORMAT(created_at, "%Y-%m") = ?', [$currentYear . '-10'])->where('type', 'monthly')->sum('saldo'));
        $oct = intval(HistoryReport::whereRaw('DATE_FORMAT(created_at, "%Y-%m") = ?', [$currentYear . '-11'])->where('type', 'monthly')->sum('saldo'));
        $nov = intval(HistoryReport::whereRaw('DATE_FORMAT(created_at, "%Y-%m") = ?', [$currentYear . '-12'])->where('type', 'monthly')->sum('saldo'));
        $dec = intval(HistoryReport::whereRaw('DATE_FORMAT(created_at, "%Y-%m") = ?', [$currentYear . '-01'])->where('type', 'monthly')->sum('saldo'));

        return [$jan, $feb, $mar, $apr, $may, $jun, $jul, $aug, $sep, $oct, $nov, $dec];

    }



}
