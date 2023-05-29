<x-app-layout>
    <x-slot name="title">
        Beasiswa/Status Mahasiswa
    </x-slot>
    <div class="card">
     <div class="card-header">
          <div class="d-flex justify-content-end">
               <button type="button" class="btn btn-sm btn-primary" onclick="window.location='{{ url('student_type/create') }}'">
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
                         <td>DPP</td>
                         <td>KRS</td>
                         <td>UTS</td>
                         <td>UAS</td>
                         <td>Wisuda</td>
                         <td>Aksi</td>
                    </tr>
               </thead>
               <tbody>
                    @foreach ($student_type as $row)
                         <tr>
                              <th>{{ $loop->iteration }}</th>
                              <td>{{ $row->type }}</td>
                              <td>{{ $row->dpp }}</td>
                              <td>{{ $row->krs }}</td>
                              <td>{{ $row->uts }}</td>
                              <td>{{ $row->uas }}</td>
                              <td>{{ $row->wisuda }}</td>
                              <td>
                                    <div class="d-flex justify-content-center align-items-center text-center">
                                        <button type="button" class="btn btn-sm btn-outline-dark m-1" onclick="window.location='{{ route('student_type.edit',$row->id) }}'">Edit</button>
                                        <form action="{{ route('student_type.destroy',$row->id) }}" method="post" class="m-1">                                       
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
               {{ $student_type->links() }}
          </div>

     </div>
    </div>
</x-app-layout>
