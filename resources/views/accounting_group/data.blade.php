<x-app-layout>
    <x-slot name="title">
        Akun Akuntansi
    </x-slot>
    <div class="card">
     <div class="card-header">
          <div class="d-flex justify-content-end">
               <button type="button" class="btn btn-sm btn-primary" onclick="window.location='{{ url('accounting_group/create') }}'">
                    <i class="fas fa-plus-circle"></i> Tambah Data
               </button>
          </div>
     </div>
     <div class="card-body">
          <table class="table table-striped ">
               <thead class="table-dark">
                    <tr>
                         <th>No</th>
                         <td>Nama</td>
                         <td>Deskripsi</td>
                         <td>Aksi</td>
                    </tr>
               </thead>
               <tbody>
                    @foreach ($accounting_group as $row)
                         <tr>
                              <th>{{ $loop->iteration }}</th>
                              <td>{{ $row->name }}</td>
                              <td>{{ $row->description }}</td>
                              <td>
                                   <button type="button" class="btn btn-sm btn-outline-secondary" onclick="window.location='accounting_group/{{ $row->id }}/edit'">Edit</button>
                                   <form action="accounting_group/destroy/{{ $row->id }}" method="post" class="my-1">
                                        {{-- <button type="button" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?');">Hapus</button> --}}
                                        <button type="button" class="btn btn-sm btn-danger">Hapus</button>
                                        @csrf
                                        @method('delete')
                                   </form>
                              </td>   
                         </tr>
                    @endforeach
               </tbody>
          </table>

     </div>
    </div>
</x-app-layout>
