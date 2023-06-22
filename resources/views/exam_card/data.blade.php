<x-app-layout>
    <x-slot name="title">
        Kartu Ujian Mahasiswa
    </x-slot>
    <div class="card">
     <div class="card-header">
          <div class="d-flex">
            @include('message.flash-message')
               {{-- <button type="button" class="btn btn-sm btn-primary ml-auto p-2" onclick="window.location='{{ url('ukt/create') }}'">
                    <i class="fas fa-plus-circle"></i> Tambah Data
               </button> --}}
          </div>
     </div>
     <div class="card-body">
          <table class="table table-striped ">
               <thead class="table-dark">
                    <tr>
                         <th>No</th>
                         <td>Mahasiswa</td>
                         <td>Jenis Ujian</td>
                         <td>Semester</td>
                         <td>Tahun</td>
                         <td>Aksi</td>
                    </tr>
               </thead>
               <tbody>
                    @foreach ($examcard as $index => $row)
                    @php
                        $number = ($examcard->currentPage() - 1) * $examcard->perPage() + $index + 1;
                    @endphp
                         <tr>
                              <th>{{ $number }}</th>
                              <td>{{ $row->student->nim }} | {{ $row->student->name }}</td>
                              <td>{{ $row->type }}</td>
                              <td>{{ $row->semester }}</td>
                              <td>{{ $row->year }}</td>
                              <td>
                                   <div class="d-flex">
                                        <button type="button" class="btn btn-sm btn-outline-dark m-1" onclick="window.location='{{ url('examcard/show') }}?id={{ $row->id }}'" >Cetak</button>
                                   </div>
                              </td>
                         </tr>
                    @endforeach
               </tbody>
          </table>
          <div class="d-flex justify-content-center align-items-center text-center">
               {{ $examcard->links() }}
          </div>
     </div>
    </div>
</x-app-layout>
