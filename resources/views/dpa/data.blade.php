<x-app-layout>
    <x-slot name="title">
        Dosen Pembimbing Akademik
    </x-slot>
    <div class="card">
     <div class="card-header">
          <div class="d-flex">
            @include('message.flash-message')
               <button type="button" class="btn btn-sm btn-primary ml-auto p-2" onclick="window.location='{{ url('dpa/create') }}'">
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
                         <td>Email</td>
                         <td>Program Studi</td>
                         <td>Aksi</td>
                    </tr>
               </thead>
               <tbody>
                @foreach ($dpa as $index => $row)
                @php
                    $number = ($dpa->currentPage() - 1) * $dpa->perPage() + $index + 1;
                @endphp
                    <tr style="cursor: pointer; background-color: #f5f5f5;" onmouseover="this.style.backgroundColor='#e9e9e9';" onmouseout="this.style.backgroundColor='#f5f5f5';" onclick="openNewPage('{{ url('daftar_mahasiswa') }}?dpa_id={{ $row->id }}')">
                        <th>{{ $number }}</th>
                        <td>{{ $row->name }}</td>
                        <td>{{ $row->email }}</td>
                        <td>{{ $row->studyprogram->name }}</td>
                        <td>
                            <div class="d-flex">
                                <button type="button" class="btn btn-sm btn-outline-dark m-1" onclick="window.location='{{ route('dpa.edit',$row->id) }}'">Edit</button>
                                <form action="{{ route('dpa.destroy',$row->id) }}" method="post" class="m-1" onsubmit="return confirm('Apakah ingin menghapus data tersebut?')">
                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="event.stopPropagation()">Hapus</button>
                                    @csrf
                                    @method('delete')
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>

            <script>
                function openNewPage(url) {
                    window.open(url, '_blank');
                }
            </script>

          </table>
          <div class="d-flex justify-content-center align-items-center text-center">
               {{ $dpa->links() }}
          </div>
     </div>
    </div>
</x-app-layout>
