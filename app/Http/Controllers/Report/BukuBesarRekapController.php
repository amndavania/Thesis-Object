<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Models\HistoryReport;
use App\Models\TransactionAccount;
use DateTime;
use Illuminate\Http\Request;

class BukuBesarRekapController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $currentMonthYear = date('Y-m');
        $datepicker = $request->input('datepicker');

        $date = $this->getDate($datepicker, $currentMonthYear);

        $data = $this->getData($date[0], $currentMonthYear);

        return view('report.bukubesarrekap')->with([
            'data' => $data,
            // 'history' => $data[1],
            'datepicker' => $date[1],
        ]);
    }

    public function export(Request $request)
    {
        $datepicker = $request->input('datepicker');
        $currentMonthYear = date('Y-m');

        $dateTime = DateTime::createFromFormat('F Y', $datepicker);
        $date = $dateTime->format('m-Y');

        $date = $this->getDate($date, $currentMonthYear);

        $data = $this->getData($date[0], $currentMonthYear);

        return view('report.printformat.bukubesarrekap')->with([
            'data' => $data[0],
            'history' => $data[1],
            'datepicker' => $date[1],
            'today' => date('d F Y', strtotime(date('Y-m-d'))),
            'title' => "Laporan Buku Besar",
        ]);

    }

    public function getDate($datepicker, $currentMonthYear)
    {
        if (!empty($datepicker)) {
            $parsedDate = \DateTime::createFromFormat('m-Y', $datepicker);
            $date = $parsedDate->format('Y-m');
            $formattedDate = $parsedDate->format('F Y');
        } else {
            $datepicker = $currentMonthYear;
            $date = date('Y-m');
            $formattedDate = date('F Y');
        }

        return [$date, $formattedDate];
    }

    public function getData($datepicker, $currentMonthYear)
    {
        $transactionAccount = TransactionAccount::all();

        if ($datepicker == $currentMonthYear) {
            $data = [];
            foreach ($transactionAccount as $item) {
                $history = HistoryReport::where('transaction_accounts_id', $item->id)->where('type', 'monthly')->whereRaw('DATE_FORMAT(created_at, "%Y-%m") = ?', $datepicker)->first('saldo');

                $balanceHistory = empty($history->saldo) ? 0 : $history->saldo;

                $currentDebit = $item->debit;
                $currentKredit = $item->kredit;

                if ($item->lajurLaporan == 'labaRugi') {
                    $balance = $balanceHistory + ($currentKredit - $currentDebit);
                } else {
                    $balance = $balanceHistory + ($currentDebit - $currentKredit);
                }

                if ($item->lajurSaldo == 'debit') {
                    $debit = $balance;
                    $kredit = 0;
                } elseif ($item->lajurSaldo == 'kredit') {
                    $debit = 0;
                    $kredit = $balance;
                }

                $data[$item->id] = [
                    'id' => $item->id,
                    'name' => $item->name,
                    'description' => $item->description,
                    'lajurSaldo' => $item->lajurSaldo,
                    'lajurLaporan' => $item->lajurLaporan,
                    'kredit' => $kredit,
                    'debit' => $debit,
                ];
            }
        } else {
            $monthAfter = date('Y-m', strtotime($datepicker . ' +1 month'));
            $data = [];
            foreach ($transactionAccount as $item) {
                $history = HistoryReport::where('transaction_accounts_id', $item->id)->where('type', 'monthly')->whereRaw('DATE_FORMAT(created_at, "%Y-%m") = ?', $monthAfter)->first('saldo');
                $balance = empty($history->saldo) ? 0 : $history->saldo;

                if ($item->lajurLaporan == 'labaRugi') {
                    $balance = -$balance;
                }

                if ($item->lajurSaldo == 'debit') {
                    $debit = $balance;
                    $kredit = 0;
                } elseif ($item->lajurSaldo == 'kredit') {
                    $debit = 0;
                    $kredit = $balance;
                }

                $data[$item->id] = [
                    'id' => $item->id,
                    'name' => $item->name,
                    'description' => $item->description,
                    'lajurSaldo' => $item->lajurSaldo,
                    'lajurLaporan' => $item->lajurLaporan,
                    'kredit' => $kredit,
                    'debit' => $debit,
                ];
            }
        }

        return $data;
    }
}
