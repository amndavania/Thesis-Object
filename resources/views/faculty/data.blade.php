<x-app-layout>
    <x-slot name="title">
        Fakultas
    </x-slot>
    <div class="card">
     <div class="card-header">
          <div class="d-flex">
                @include('message.flash-message')
                <button type="button" class="btn btn-sm btn-primary ml-auto p-2" onclick="window.location='{{ url('faculty/create') }}'">
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
                         <td>Aksi</td>
                    </tr>
               </thead>
               <tbody>
                    @foreach ($faculty as $index => $row)
                    @php
                        $number = ($faculty->currentPage() - 1) * $faculty->perPage() + $index + 1;
                    @endphp
                         <tr>
                              <th>{{ $number }}</th>
                              <td>{{ $row->name }}</td>
                              <td>
                                <div class="d-flex">
                                   <button type="button" class="btn btn-sm btn-outline-dark m-1" onclick="window.location='{{ route('faculty.edit', $row->id) }}'">Edit</button>
                                   <form action="{{ route('faculty.destroy',$row->id) }}" method="post" class="my-1">
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
               {{ $faculty->links() }}
          </div>

     </div>
    </div>
</x-app-layout>
