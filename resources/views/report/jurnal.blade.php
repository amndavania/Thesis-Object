<x-app-layout>
    <x-slot name="title">
        Jurnal
    </x-slot>
    <div class="card">
        <div class="card-header">
            <div class="d-flex">
                <form class="form-inline" action="{{ route('jurnal.index') }}" method="GET">
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
                @if ($data->count() > 0)
                    <button onclick="window.open('{{ url('jurnal/export') }}?datepicker={{ $datepicker }}&filter={{ $filter }}', '_blank')" class="btn btn-sm btn-primary ml-auto p-2">
                        <i class="fas fa-print"></i> Export PDF
                    </button>
                @endif
            </div>
       </div>
     <div class="card-body">
        <h5>
            @if (!empty($datepicker))
                <span class="badge bg-warning">{{ $datepicker }}</span>
            @else
                '-'
            @endif
        </h5>
          <table class="table table-striped ">
               <thead class="table-dark">
                    <tr>
                         <th>No</th>
                         <td>Tanggal</td>
                         <td style="width: 30%">Uraian</td>
                         <td>ID</td>
                         <td>Nama Akun</td>
                         <td>Ref</td>
                         <td>Debit</td>
                         <td>Kredit</td>
                    </tr>
               </thead>
               <tbody>
                    @foreach ($data as $index => $row)
                    @php
                        $number = ($data->currentPage() - 1) * $data->perPage() + $index + 1;
                    @endphp
                         <tr>
                              <th>{{ $number }}</th>
                              <td>{{ $row->created_at->format('d-m-Y') }}</td>
                              <td>{{ $row->description }}</td>
                              <td>{{ $row->transactionaccount->id }}</td>
                              <td>{{ $row->transactionaccount->name }}</td>
                              <td>{{ $row->reference_number }}</td>
                              <td>{{ $row->type == 'debit' ? 'Rp ' . number_format($row->amount, 2, ',', '.') : '-' }}</td>
                              <td>{{ $row->type == 'kredit' ? 'Rp ' . number_format($row->amount, 2, ',', '.') : '-' }}</td>
                         </tr>
                    @endforeach
               </tbody>

                {{-- <tfoot class="table-dark">
                    <tr>
                        <td colspan="6">
                            <strong>Total</strong>
                        </td>
                        <td>{{ 'Rp ' . number_format($totalDebit, 2, ',', '.') }}</td>
                        <td>{{ 'Rp ' . number_format($totalKredit, 2, ',', '.') }}</td>
                    </tr>
                </tfoot> --}}
          </table>
          <div class="d-flex justify-content-center align-items-center text-center">
               {{ $data->links() }}
          </div>
     </div>
    </div>
</x-app-layout>
