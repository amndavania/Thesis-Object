<x-app-layout>
    <x-slot name="title">
        Akun Transaksi
    </x-slot>
    <div class="card">
     <div class="card-header">
          <div class="d-flex">
                @include('message.flash-message')
                <button type="button" class="btn btn-sm btn-primary ml-auto p-2" onclick="window.location='{{ url('transaction_account/create') }}'">
                    <i class="fas fa-plus-circle"></i> Tambah Data
                </button>
          </div>
     </div>
     <div class="card-body">
          <table class="table table-striped ">
               <thead class="table-dark">
                    <tr>
                         <th>No</th>
                         <td>ID Akun</td>
                         <td style="width: 20%">Nama</td>
                         <td style="width: 20%">Deskripsi</td>
                         <td style="width: 30%">Grup</td>
                         {{-- <td style="width: 20%">Debit</td>
                         <td style="width: 20%">Kredit</td> --}}
                         <td>Aksi</td>
                    </tr>
               </thead>
               <tbody>
                    @foreach ($transaction_account as $index => $row)
                    @php
                        $number = ($transaction_account->currentPage() - 1) * $transaction_account->perPage() + $index + 1;
                    @endphp
                         <tr>
                              <th>{{ $number }}</th>
                              <th>{{ $row->id }}</th>
                              <td>{{ $row->name }}</td>
                              <td>{{ $row->description ? $row->description : '-' }}</td>
                              <td>{{ $row->accountinggroup->pluck('name')->implode(', ') }}</td>
                              {{-- <td>{{ 'Rp ' . number_format($row->ammount_debit, 2, ',', '.') }}</td>
                              <td>{{ 'Rp ' . number_format($row->ammount_kredit, 2, ',', '.') }}</td> --}}
                              <td>
                                <div class="d-flex">
                                        <button type="button" class="btn btn-sm btn-outline-dark m-1" onclick="window.location='{{ route('transaction_account.edit',$row->id) }}'">Edit</button>
                                        <form action="{{ route('transaction_account.destroy',$row->id) }}" method="post" class="m-1">
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
               {{ $transaction_account->links() }}
          </div>

     </div>
    </div>
</x-app-layout>
