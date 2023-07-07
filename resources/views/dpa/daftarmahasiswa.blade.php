<x-app-layout>
    <x-slot name="title">
        Transaksi
    </x-slot>
    <div class="card">
     <div class="card-header">
     <div class="d-flex align-items-center">
          <form class="form-inline" action="{{ route('bukubesar.index') }}" method="GET">
    <div class="mb-2 mr-sm-2">
        <select class="form-control selectpicker" name="search_account" id="search_account" data-live-search="true">
            <option value="">Pilih Tahun Ajaran</option>
            @foreach ($selects as $id => $name)
                <option value="{{ $id }}">{{ $name }}</option>
            @endforeach
        </select>
    </div>
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
          <table class="table table-striped ">
               <thead class="table-dark">
                    <tr>
                         <th>No</th>
                         <td>Nama Mahasiswa</td>
                         <td>NIM</td>
                         <td>Angkatan</td>
                         <td>Semester</td>
                         <td>Status</td>
                         <td>Aksi</td>
                    </tr>
               </thead>
               <tbody>
                    @foreach ($transaction as $index => $row)
                    @php
                        $number = ($transaction->currentPage() - 1) * $transaction->perPage() + $index + 1;
                    @endphp
                         <tr>
                              <th>{{ $number }}</th>
                              <td>{{ $row->name }}</td>
                              <td>{{ $row->description }}</td>
                              <td>{{ 'Rp ' . number_format($row->amount, 2, ',', '.') }}</td>
                              <td>{{ $row->type }}</td>
                              <td>{{ $row->transactionaccount->name }}</td>
                              <td>
                                   <div class="d-flex">
                                        <button type="button" class="btn btn-sm btn-outline-dark m-1" onclick="window.location='{{ route('transaction.edit',$row->id) }}'">Edit</button>
                                        <form action="{{ route('transaction.destroy',$row->id) }}" method="post" class="m-1">
                                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm(&quot;Apakah ingin menghapus data tersebut?&quot;)">Hapus</button>
                                        @csrf
                                        @method('delete')
                                        </form>
                                   </div>

                              </td>
                         </tr>
                    @endforeach
               </tbody>
          </table>
          <div class="d-flex justify-content-center align-items-center text-center">
               {{ $transaction->links() }}
          </div>
     </div>
    </div>
</x-app-layout>
