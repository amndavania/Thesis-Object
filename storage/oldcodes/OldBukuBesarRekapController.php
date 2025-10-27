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
            'data' => $data,
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
        $transactionAccount = TransactionAccount::where('name', '!=', 'labaDitahan')->get();

        if ($datepicker == $currentMonthYear) { //S32
            $data = []; //S33
            foreach ($transactionAccount as $item) { //S34
                $history = HistoryReport::where('transaction_accounts_id', $item->id)->where('type', 'monthly')->whereRaw('DATE_FORMAT(created_at, "%Y-%m") = ?', $datepicker)->first('saldo'); //S34

                $balanceHistory = empty($history->saldo) ? 0 : $history->saldo; //S35

                $currentDebit = $item->debit; //S36
                $currentKredit = $item->kredit; //S37

                if ($item->lajurLaporan == 'labaRugi') { //S38
                    $balance = $balanceHistory + ($currentKredit - $currentDebit); //S39
                } else {
                    $balance = $balanceHistory + ($currentDebit - $currentKredit); //S40
                }

                if ($item->lajurSaldo == 'debit') { //S41
                    $debit = $balance; //S42
                    $kredit = 0; //S43
                } elseif ($item->lajurSaldo == 'kredit') { //S44
                    $debit = 0; //S45
                    $kredit = $balance; //S46
                }

                $data[$item->id] = [ //S47
                    'id' => $item->id, //S48
                    'name' => $item->name, //S49
                    'description' => $item->description, //S50
                    'lajurSaldo' => $item->lajurSaldo, //S51
                    'lajurLaporan' => $item->lajurLaporan, //S52
                    'kredit' => $kredit, //S53
                    'debit' => $debit, //S54
                ];
            }
        } else {
            $monthAfter = date('Y-m', strtotime($datepicker . ' +1 month')); //S55
            $data = []; //S56
            foreach ($transactionAccount as $item) { 
                $history = HistoryReport::where('transaction_accounts_id', $item->id)->where('type', 'monthly')->whereRaw('DATE_FORMAT(created_at, "%Y-%m") = ?', $monthAfter)->first('saldo'); //S57
                $balance = empty($history->saldo) ? 0 : $history->saldo; //S58

                if ($item->lajurLaporan == 'labaRugi') {//S59
                    $balance = -$balance; //S60
                }

                if ($item->lajurSaldo == 'debit') { //S61
                    $debit = $balance; //S62
                    $kredit = 0; //S63
                } elseif ($item->lajurSaldo == 'kredit') { //S64
                    $debit = 0; //S65
                    $kredit = $balance; //S66
                }

                $data[$item->id] = [ //S67
                    'id' => $item->id, //S68
                    'name' => $item->name, //S69
                    'description' => $item->description, //S70
                    'lajurSaldo' => $item->lajurSaldo, //S71
                    'lajurLaporan' => $item->lajurLaporan, //S72
                    'kredit' => $kredit, //S73
                    'debit' => $debit, //S74
                ];
            }
        }
        return $data; //S75
    }
}
