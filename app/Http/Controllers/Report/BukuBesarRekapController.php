<?php

//One of the refactoring : Extract Method 
// The testing file is : BukuBesarRekapControllerTest
// Refactored method : getData()

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
        $isCurrentMonth = ($datepicker == $currentMonthYear);
        $targetMonth = $isCurrentMonth ? $datepicker : date('Y-m', strtotime($datepicker . ' +1 month'));
    
        $data = [];
        foreach ($transactionAccount as $item) {
            $data[$item->id] = $this->processTransactionAccount($item, $targetMonth, $isCurrentMonth);
        }
    
        return $data; //S75
    }
    
    private function processTransactionAccount($item, $targetMonth, $isCurrentMonth)
    {
        // Ambil saldo dari history
        $history = HistoryReport::where('transaction_accounts_id', $item->id)
            ->where('type', 'monthly')
            ->whereRaw('DATE_FORMAT(created_at, "%Y-%m") = ?', $targetMonth)
            ->first('saldo');
        $balanceHistory = empty($history->saldo) ? 0 : $history->saldo;
    
        // Hitung balance
        if ($isCurrentMonth) {
            $balance = $this->calculateCurrentMonthBalance($item, $balanceHistory);
        } else {
            $balance = $this->calculateOtherMonthBalance($item, $balanceHistory);
        }
    
        // Pecah ke debit / kredit
        [$debit, $kredit] = $this->splitBalance($item->lajurSaldo, $balance);
    
        // Mapping data item
        return [
            'id' => $item->id,
            'name' => $item->name,
            'description' => $item->description,
            'lajurSaldo' => $item->lajurSaldo,
            'lajurLaporan' => $item->lajurLaporan,
            'kredit' => $kredit,
            'debit' => $debit,
        ];
    }
    
    private function calculateCurrentMonthBalance($item, $balanceHistory)
    {
        $currentDebit = $item->debit; 
        $currentKredit = $item->kredit;
    
        if ($item->lajurLaporan == 'labaRugi') {
            return $balanceHistory + ($currentKredit - $currentDebit);
        }
        return $balanceHistory + ($currentDebit - $currentKredit);
    }
    
    private function calculateOtherMonthBalance($item, $balanceHistory)
    {
        if ($item->lajurLaporan == 'labaRugi') {
            return -$balanceHistory;
        }
        return $balanceHistory;
    }
    
    private function splitBalance($lajurSaldo, $balance)
    {
        if ($lajurSaldo == 'debit') {
            return [$balance, 0];
        } elseif ($lajurSaldo == 'kredit') {
            return [0, $balance];
        }
        return [0, 0];
    }    
}
