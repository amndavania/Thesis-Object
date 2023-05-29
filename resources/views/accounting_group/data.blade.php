<x-app-layout>
    <x-slot name="title">
        Akun Transaksi
    </x-slot>
    <div class="card">
     <div class="card-header">
          <div class="d-flex">
                @include('message.flash-message')
                <button type="button" class="btn btn-sm btn-primary ml-auto p-2" onclick="window.location='{{ url('accounting_group/create') }}'">
                    <i class="fas fa-plus-circle"></i> Tambah Data
                </button>
          </div>
     </div>
     <div class="card-body">
          <table class="table table-striped ">
               <thead class="table-dark">
                    <tr>
                         <th>No</th>
                         <th>ID Akun</th>
                         <td>Nama</td>
                         <td>Deskripsi</td>
                         <td>Aksi</td>
                    </tr>
               </thead>
               <tbody>
                    @foreach ($accounting_group as $row)
                         <tr>
                              <th>{{ $loop->iteration }}</th>
                              <th>{{ $row->id }}</th>
                              <td>{{ $row->name }}</td>
                              <td>{{ $row->description }}</td>
                              <td>
                                        <button type="button" class="btn btn-sm btn-outline-dark m-1" onclick="window.location='{{ route('accounting_group.edit',$row->id) }}'">Edit</button>
                                        <form action="{{ route('accounting_group.destroy',$row->id) }}" method="post" class="m-1">                                       
                                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm(&quot;Apakah ingin menghapus data tersebut?&quot;)">Hapus</button>
                                        @csrf
                                        @method('delete')
                                   </form>
                              </td>
                         </tr>
                    @endforeach
               </tbody>
          </table>
          <div class="d-flex justify-content-center align-items-center text-center">
               {{ $accounting_group->links() }}
          </div>

     </div>
    </div>
</x-app-layout>
