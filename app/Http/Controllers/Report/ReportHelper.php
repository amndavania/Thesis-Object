<?php

namespace App\Http\Controllers\Report;

use App\Models\Transaction;
use App\Models\TransactionAccount;
use App\Models\HistoryReport;
use DateTime;

trait ReportHelper
{
    public function getDate($datepicker, $filter)
    {
        if (empty($datepicker) || empty($filter)) {
            $date = date('Y-m');
            $dateTime = new DateTime($date);
            $formattedDate = $dateTime->format('F Y');
            $filter = 'month';
        } else {
            if ($filter == 'month') {
                $parsedDate = DateTime::createFromFormat('m-Y', $datepicker);
                $formattedDate = $parsedDate->format('F Y');
                $date = $parsedDate->format('Y-m');
            } elseif ($filter == 'year') {
                $parsedDate = DateTime::createFromFormat('Y', $datepicker);
                $formattedDate = $parsedDate->format('Y');
                $date = $parsedDate->format('Y');
            }
        }
        return [$date, $formattedDate, $filter];
    }

    public function getTransaction($date, $filter, $accounting_group_id)
    {
        return Transaction::whereHas('transactionaccount.accountinggroup', function ($query) use ($accounting_group_id) {
            $query->where('accounting_groups.id', $accounting_group_id);
        })
        ->when($filter == 'month', fn($q) => $q->whereRaw('DATE_FORMAT(created_at, "%Y-%m") = ?', $date))
        ->when($filter == 'year', fn($q) => $q->whereRaw('DATE_FORMAT(created_at, "%Y") = ?', $date))
        ->get();
    }

    public function getHistory($filter, $transaction_account, $date)
    {
        return HistoryReport::where('transaction_accounts_id', $transaction_account)
            ->when($filter == 'year', fn($q) => $q->where('type', 'annual')->whereRaw('DATE_FORMAT(created_at, "%Y") = ?', $date))
            ->when($filter != 'year', fn($q) => $q->where('type', 'monthly')->whereRaw('DATE_FORMAT(created_at, "%Y-%m") = ?', $date))
            ->first();
    }
}
