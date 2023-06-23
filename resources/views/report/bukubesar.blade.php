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
                <input type="text" class="form-control mb-2 mr-sm-2" id="datepicker" name="datepicker" placeholder="Pilih Bulan" readonly>

                <button type="submit" class="btn btn-primary mb-2">Cari</button>
              </form>

              @if (!empty($account))
              <button onclick="window.open('{{ url('bukubesar/export') }}?search_account={{ $account->id }}&datepicker={{ $datepicker }}', '_blank')" class="btn btn-sm btn-primary ml-auto p-2">
                <i class="fas fa-print"></i> Export PDF
            </button>
              @endif
          </div>
     </div>
         <div class="card-body">
          {{-- <a href="" @click.prevent="printme" target="_blank" class="btn btn-info btn-md mb-3 ">Download Buku Besar</a> --}}
          <div class="d-flex align-items-center">
            <h5>Akun : {{ !empty($account) ? $account->name : '-' }}</h5>
            <h5 class="ml-auto p-2">Periode : {{ !empty($datepicker) ? $datepicker : '-' }}</h5>
          </div>
          <table class="table table-striped ">
               <thead class="table-dark">
                    <tr>
                         <th>No</th>
                         <td>Tanggal</td>
                         <td>Uraian</td>
                         <td>Debit</td>
                         <td>Kredit</td>
                         <td>Saldo</td>
                    </tr>
               </thead>
               <tbody>
                    @php
                        $totalKredit = 0;
                        $totalDebit = 0;
                        $totalSaldo = 0;
                    @endphp
                    @foreach ($data as $index => $row)
                    @php
                        $number = ($data->currentPage() - 1) * $data->perPage() + $index + 1;
                    @endphp
                         <tr>
                              <th>{{ $number }}</th>
                              <td>{{ $row->created_at->format('d-m-Y') }}</td>
                              <td>{{ $row->description }}</td>
                              <td>{{ $row->type == 'debit' ? 'Rp ' . number_format($row->amount, 2, ',', '.') : '-' }}</td>
                              <td>{{ $row->type == 'kredit' ? 'Rp ' . number_format($row->amount, 2, ',', '.') : '-' }}</td>
                              @php
                                $debit = 0;
                                $kredit = 0;
                                    if ($row->type == 'debit') {
                                        $debit = $row->amount;
                                        $totalDebit += $debit;
                                    } elseif ($row->type == 'kredit') {
                                        $kredit = $row->amount;
                                        $totalKredit += $kredit;
                                    }
                                    $totalSaldo += ($debit - $kredit);
                                @endphp
                                <td>
                                    @if ($totalSaldo < 0)
                                        (Rp {{ number_format(abs($totalSaldo), 2, ',', '.') }})
                                    @elseif ($totalSaldo > 0)
                                        Rp {{ number_format($totalSaldo, 2, ',', '.') }}
                                    @else
                                        -
                                    @endif
                                </td>
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
                        <td>
                            @if ($totalSaldo < 0)
                                (Rp {{ number_format(abs($totalSaldo), 2, ',', '.') }})
                            @elseif ($totalSaldo > 0)
                                Rp {{ number_format($totalSaldo, 2, ',', '.') }}
                            @else
                                -
                            @endif
                        </td>
                    </tr>
                </tfoot>
          </table>
          <div class="d-flex justify-content-center align-items-center text-center">
            {{ $data->links() }}
        </div>
     </div>
    </div>
</x-app-layout>
