<x-app-layout>
    <x-slot name="title">
        UKT Mahasiswa
    </x-slot>
    <div class="card">
     <div class="card-header">
          <div class="d-flex">
            @include('message.flash-message')
               <button type="button" class="btn btn-sm btn-primary ml-auto p-2" onclick="window.location='{{ url('ukt/create') }}'">
                    <i class="fas fa-plus-circle"></i> Tambah Data
               </button>
          </div>
     </div>
     <div class="card-body">
          <table class="table table-striped ">
               <thead class="table-dark">
                    <tr>
                         <th>No</th>
                         <td>Mahasiswa</td>
                         <td>Semester</td>
                         <td>Nomor Referensi</td>
                         <td>Jumlah</td>
                         <td>Total</td>
                         <td>Status</td>
                         <td>Akun Transaksi</td>
                         <td>Aksi</td>
                    </tr>
               </thead>
               <tbody>
                    @foreach ($ukt as $index => $row)
                    @php
                        $number = ($ukt->currentPage() - 1) * $ukt->perPage() + $index + 1;
                    @endphp
                         <tr>
                              <th>{{ $number }}</th>
                              <td>{{ $row->student_id->name }} / {{ $row->student_id->nim }}</td>
                              <td>{{ $row->semester }}</td>
                              <td>{{ $row->reference_number ? $row->reference_number : '-' }}</td>
                              <td>{{ 'Rp ' . number_format($row->amount, 0, ',', '.') }}</td>
                              <td>{{ 'Rp ' . number_format($row->total, 0, ',', '.') }}</td>
                              <td>{{ $row->status }}</td>
                              <td>{{ $row->transactionaccount->name }}</td>
                              <td>
                                   <div class="d-flex">
                                        <button type="button" class="btn btn-sm btn-outline-dark m-1" onclick="window.location='{{ route('ukt.edit',$row->id) }}'">Edit</button>
                                        <form action="{{ route('ukt.destroy',$row->id) }}" method="post" class="m-1">
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
               {{ $ukt->links() }}
          </div>
     </div>
    </div>
</x-app-layout>
