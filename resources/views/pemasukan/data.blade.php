<x-app-layout>
    <x-slot name="title">
        Pemasukan
    </x-slot>
    <div class="card">
     <div class="card-header">
          <div class="d-flex">
            @include('message.flash-message')
               <button type="button" class="btn btn-sm btn-primary ml-auto p-2" onclick="window.location='{{ url('pemasukan/create') }}'">
                    <i class="fas fa-plus-circle"></i> Tambah Data
               </button>
          </div>
     </div>
     <div class="card-body">
          <table class="table table-striped ">
               <thead class="table-dark">
                    <tr>
                         <th>No</th>
                         <td>Admin</td>
                         <td>Deskripsi</td>
                         <td>Nomor Referensi</td>
                         <td>Jumlah</td>
                         <td>Akun Transaksi</td>
                         <td>Aksi</td>
                    </tr>
               </thead>
               <tbody>
                    @foreach ($pemasukan as $row)
                         <tr>
                              <th>{{ $loop->iteration }}</th>
                              <td>{{ $row->user->name }}</td>
                              <td>{{ $row->description }}</td>
                              <td>{{ $row->reference_number ? $row->reference_number : '-' }}</td>
                              <td>{{ 'Rp ' . number_format($row->amount, 0, ',', '.') }}</td>
                              <td>{{ $row->transactionaccount->name }}</td>
                              <td>
                                   <div class="d-flex">
                                        <button type="button" class="btn btn-sm btn-outline-dark m-1" onclick="window.location='{{ route('pemasukan.edit',$row->id) }}'">Edit</button>
                                        <form action="{{ route('pemasukan.destroy',$row->id) }}" method="post" class="m-1">
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
               {{ $pemasukan->links() }}
          </div>
     </div>
    </div>
</x-app-layout>
