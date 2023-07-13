<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Report\CashFlowController;
use App\Http\Controllers\Report\LabaRugiController;
use App\Models\HistoryReport;
use App\Models\Student;
use App\Models\Transaction;
use App\Models\Ukt;
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

        $growPercentagePreviousMonth = $this->setPersen(intval(substr($date, 5, 2)), $financeThisYear);
        $growPercentagePreviousMonth2 = $this->setPersen(intval(substr($date, 5, 2))-1, $financeThisYear);

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

        $students = Student::all()->count();
        $transactions = Transaction::latest()->take(5)->get();

        $dataStudents = Student::all('id');
        $statusUKT = $this->setStatusUKT($dataStudents);

        $dataUkt = Ukt::latest()->first();

        if (empty($dataUkt)) {
            $year = date('Y');
            $semester = "GASAL";
        } else {
            $year = $dataUkt->year;
            $semester = $dataUkt->semester;
        }



        return view('dashboard')->with([
            'saldo' => $saldoAkhir,
            'labarugi' => $saldoLabaRugi,
            'students' => $students,
            'trendKeuangan' => [$financeThisYear, $financeLastYear],
            'transactions' => $transactions,
            'growPercentage' => [$growPercentagePreviousMonth, $growPercentagePreviousMonth2],
            'saldoBulanLalu' => $financeThisYear[intval(substr($date, 5, 2))-2],
            'statusUKT' => $statusUKT,
            'tahunAjaran' => [$year, $semester]
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

    public function setPersen($thisMonth, $finance) {
        $previousMonth = $thisMonth-1;
        if ($thisMonth == 0 || $previousMonth == 0) {
            $keuanganBulanLalu = 0;
            $keuanganBulanLaluLagi = 0;
        }else {
            $keuanganBulanLalu = $finance[$thisMonth-2];
            $keuanganBulanLaluLagi = $finance[$previousMonth-2];
        }

        $difference = $keuanganBulanLalu - $keuanganBulanLaluLagi;

        if ($difference != 0 && $keuanganBulanLaluLagi != 0) {
            $growthPercentage = ($difference / $keuanganBulanLaluLagi) * 100;
        }else {
            $growthPercentage = 0;
        }

        return $growthPercentage;
    }

    public function setStatusUKT($students) {

        $lastUkt = Ukt::latest()->first();

        $lunas = 0;
        $belumLunas = 0;
        $belumBayar = 0;

        if (!empty($lastUkt)){
            foreach ($students as $item) {
                $dataUkt = Ukt::where('type', 'UKT')
                    ->where('year', $lastUkt->year)
                    ->where('semester', $lastUkt->semester)
                    ->where('students_id', $item->id)
                    ->latest()
                    ->first('status');

                if (empty($dataUkt)) {
                    $belumBayar += 1;
                }elseif ($dataUkt->status == "Lunas") {
                    $lunas += 1;
                } elseif ($dataUkt->status == "Belum Lunas") {
                    $belumLunas += 1;
                }
            }
        }
        return [$lunas, $belumLunas, $belumBayar];
    }





}
