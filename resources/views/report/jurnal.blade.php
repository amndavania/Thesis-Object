<x-app-layout>
    <x-slot name="title">
        Jurnal
    </x-slot>
    <div class="card">
        <div class="card-header">
            <div class="d-flex">
                <form class="form-inline" action="{{ route('jurnal.index') }}" method="GET">
                    <input type="text" class="form-control mb-2 mr-sm-2" id="datepicker" name="datepicker" placeholder="Pilih Bulan" readonly>
                    <button type="submit" class="btn btn-primary mb-2">Cari</button>
                </form>

                <button onclick="window.open('{{ url('jurnal/export') }}', '_blank')" class="btn btn-sm btn-primary ml-auto p-2">Export PDF</button>
            </div>
       </div>
     <div class="card-body">
        <h5>Periode : {{ !empty($datepicker) ? $datepicker : '-' }}</h5>
          <table class="table table-striped ">
               <thead class="table-dark">
                    <tr>
                         <th>No</th>
                         <td>Tanggal</td>
                         <td>Uraian</td>
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
                              <td class="currency">{{ $row->type == 'debit' ? 'Rp ' . number_format($row->amount, 0, ',', '.') : '-' }}</td>
                              <td class="currency">{{ $row->type == 'kredit' ? 'Rp ' . number_format($row->amount, 0, ',', '.') : '-' }}</td>
                         </tr>
                    @endforeach
               </tbody>
          </table>
          <div class="d-flex justify-content-center align-items-center text-center">
               {{ $data->links() }}
          </div>
     </div>
    </div>
</x-app-layout>
