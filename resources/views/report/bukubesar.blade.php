<x-app-layout>
    <x-slot name="title">
      Buku Besar
    </x-slot>
    <div class="card">
     <div class="card-header">
          <div class="d-flex align-items-center">
          <form class="form-inline" action="{{ route('bukubesar.index') }}" method="GET">
    <div class="mb-2 mr-sm-2">
        <select class="form-control selectpicker" name="search_account" id="search_account" data-live-search="true">
            <option value="">Pilih Akun Transaksi</option>
            @foreach ($selects as $id => $name)
                <option value="{{ $id }}">{{ $name }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-2 mr-sm-2">
        <select class="form-control selectpicker" name="filter" id="filter" data-live-search="true" onchange="handleFilterChange()">
            <option value="month">Filter by</option>
            <option value="month">Bulan</option>
            <option value="year">Tahun</option>
        </select>
    </div>
    <input type="text" class="form-control mb-2 mr-sm-2" id="datepicker" name="datepicker" placeholder="Pilih Bulan" readonly>
    <button type="submit" class="btn btn-primary mb-2">Cari</button>
</form>


              @if (!empty($account) && $data->count() > 0)
              <button onclick="window.open('{{ url('bukubesar/export') }}?search_account={{ $account->id }}&datepicker={{ $datepicker }}&filter={{ $filter }}', '_blank')" class="btn btn-sm btn-primary ml-auto p-2">
                <i class="fas fa-print"></i> Export PDF
            </button>
              @endif
          </div>
     </div>
         <div class="card-body">
            <h5>
                @if (empty($account))
                    <span class="badge bg-warning">{{ $datepicker . ' | Tidak ada akun transaksi'  }}</span>
                @elseif (empty($datepicker))
                <span class="badge bg-warning">{{ 'Tidak ada tanggal | ' . $account->name }}</span>
                @else
                <span class="badge bg-warning">{{ $datepicker . ' | ' . $account->name }}</span>
                @endif
            </h5>
          <table class="table table-striped ">
               <thead class="table-dark">
                    <tr>
                         <th>No</th>
                         <td>Tanggal</td>
                         <td>Uraian</td>
                         <td>Debit</td>
                         <td>Kredit</td>
                    </tr>
               </thead>
               <tbody>
                    @php
                    $totalKredit = 0;
                    $totalDebit = 0;
                    $totalSaldo = 0;
                    if (!empty($history)) {
                        $saldoSebelumnya = $history->saldo;
                    } else {
                        $saldoSebelumnya = 0;
                    }
                    @endphp
                    @if (!empty($history))
                    <tr>
                        <td colspan="5">
                            @if ($history->type == 'monthly')
                                <strong>Saldo Akhir Bulan Sebelumnya</strong>
                            @elseif ($history->type == 'annual')
                                <strong>Saldo Akhir Tahun Sebelumnya</strong>
                            @endif
                        </td>
                        <td style="@if ($saldoSebelumnya < 0) color: red; @endif">
                            @if ($saldoSebelumnya < 0)
                                <strong>(Rp {{ number_format(abs($saldoSebelumnya), 2, ',', '.') }})</strong>
                            @elseif ($saldoSebelumnya > 0 || $saldoSebelumnya == 0)
                                <strong>Rp {{ number_format($saldoSebelumnya, 2, ',', '.') }}</strong>
                            @else
                                <strong>-</strong>
                            @endif
                        </td>
                    </tr>
                    @endif
                    @foreach ($data as $row)
                         <tr>
                              <th>{{ $loop->iteration }}</th>
                              <td>{{ $row->created_at->format('d-m-Y') }}</td>
                              <td>{{ $row->description }}</td>
                              <td>{{ $row->type == 'debit' ? 'Rp ' . number_format($row->amount, 2, ',', '.') : '-' }}</td>
                              <td>{{ $row->type == 'kredit' ? 'Rp ' . number_format($row->amount, 2, ',', '.') : '-' }}</td>
                              @php
                                $saldo = 0;
                                    if ($row->type == 'debit') {
                                        $totalDebit += $row->amount;
                                        $saldo = $row->amount;

                                    } elseif ($row->type == 'kredit') {
                                        $totalKredit += $row->amount;
                                    }
                                @endphp
                         </tr>
                    @endforeach
               </tbody>
               <tfoot class="table-dark">
                <tr>
                        <td colspan="3">
                             <strong>Total</strong>
                        </td>
                        <td>{{ 'Rp ' . number_format($totalDebit, 2, ',', '.') }}</td>
                        <td>{{ 'Rp ' . number_format($totalKredit, 2, ',', '.') }}</td>
                    </tr>
                </tfoot>
          </table>
     </div>
    </div>
</x-app-layout>
