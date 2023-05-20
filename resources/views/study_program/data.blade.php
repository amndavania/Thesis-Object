<x-app-layout>
    <x-slot name="title">
        Program Studi
    </x-slot>
    <div class="card">
     <div class="card-header">
          <div class="d-flex justify-content-end">
               <button type="button" class="btn btn-sm btn-primary" onclick="window.location='{{ url('study_program/create') }}'">
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
                         <td>Fakultas</td>
                         <td>Aksi</td>
                    </tr>
               </thead>
               <tbody>
                    @foreach ($study_program as $row)
                         <tr>
                              <th>{{ $loop->iteration }}</th>
                              <td>{{ $row->name }}</td>
                              <td>{{ $row->faculty }}</td>
                              <td>
                                   <button type="button" class="btn btn-sm btn-outline-secondary" onclick="window.location='study_program/{{ $row->id }}/edit'">Edit</button>
                                   <form action="study_program/destroy/{{ $row->id }}" method="post" class="my-1">
                                        <button type="button" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?');">Hapus</button>
                                        {{-- <button type="button" class="btn btn-sm btn-danger">Hapus</button> --}}
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
