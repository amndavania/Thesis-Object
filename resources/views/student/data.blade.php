<x-app-layout>
    <x-slot name="title">
        Mahasiswa
    </x-slot>
    <div class="card">
     <div class="card-header">
          <div class="d-flex">
            @include('message.flash-message')
               <button type="button" class="btn btn-sm btn-primary ml-auto p-2" onclick="window.location='{{ url('student/create') }}'">
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
                         <td>NIM</td>
                         <td>Tahun Masuk</td>
                         <td>Prodi</td>
                         <td>Tipe</td>
                         <td>Aksi</td>
                    </tr>
               </thead>
               <tbody>
                    @foreach ($student as $row)
                         <tr>
                              <th>{{ $loop->iteration }}</th>
                              <td>{{ $row->name }}</td>
                              <td>{{ $row->nim }}</td>
                              <td>{{ $row->force }}</td>
                              <td>{{ $row->studyprogram->name }}</td>
                              <td>{{ $row->studenttype->type }}</td>
                              <td>
                                   <div class="d-flex justify-content-center align-items-center text-center">
                                        <button type="button" class="btn btn-sm btn-outline-dark m-1" onclick="window.location='{{ route('student.edit',$row->id) }}'">Edit</button>
                                        <form action="{{ route('student.destroy',$row->id) }}" method="post" class="m-1">
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
               {{ $student->links() }}
          </div>
     </div>
    </div>
</x-app-layout>
