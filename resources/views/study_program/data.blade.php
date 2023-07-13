<x-app-layout>
    <x-slot name="title">
        Program Studi
    </x-slot>
    <div class="card">
     <div class="card-header">
          <div class="d-flex">
                @include('message.flash-message')
                <button type="button" class="btn btn-sm btn-primary ml-auto p-2" onclick="window.location='{{ url('study_program/create') }}'">
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
                         <td>Kaprodi</td>
                         <td>Fakultas</td>
                         <td>Aksi</td>
                    </tr>
               </thead>
               <tbody>
                    @foreach ($study_program as $index => $row)
                    @php
                        $number = ($study_program->currentPage() - 1) * $study_program->perPage() + $index + 1;
                    @endphp
                         <tr>
                              <th>{{ $number }}</th>
                              <td>{{ $row->name }}</td>
                              <td>{{ $row->kaprodi_name }}</td>
                              <td>{{ $row->faculty->name }}</td>
                              <td>
                                <div class="d-flex">
                                   <button type="button" class="btn btn-sm btn-outline-dark m-1" onclick="window.location='{{ route('study_program.edit',$row->id) }}'">Edit</button>
                                   <form action="{{ route('study_program.destroy',$row->id) }}" method="post" class="my-1">
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
               {{ $study_program->links() }}
          </div>

     </div>
    </div>
</x-app-layout>
