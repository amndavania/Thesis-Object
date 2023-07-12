<x-app-layout>
    <x-slot name="title">
        Lembar Bimbingan Studi
    </x-slot>
    <div class="card">
     <div class="card-header">
          <div class="d-flex">
            @include('message.flash-message')
          </div>
     </div>
     <div class="card-body">
          <table class="table table-striped ">
               <thead class="table-dark">
                    <tr>
                         <th>No</th>
                         <td>Mahasiswa</td>
                         <td>Tahun Ajaran</td>
                         <td>Semester</td>
                         <td>Status</td>
                         <td>Aksi</td>
                    </tr>
               </thead>
               <tbody>
                    @foreach ($bimbinganstudi as $index => $row)
                    @php
                        $number = ($bimbinganstudi->currentPage() - 1) * $bimbinganstudi->perPage() + $index + 1;
                        $tahunMasuk = $row->student->force;
                        $tahunAjaran = $row->year;
                        if ($row->semester == "GASAL") {
                            $semester = ($tahunAjaran - $tahunMasuk) + 1;
                        } elseif ($row->semester == "GENAP") {
                            $semester = ($tahunAjaran - $tahunMasuk);
                        }
                    @endphp
                         <tr>
                              <th>{{ $number }}</th>
                              <td>{{ $row->student->nim }} | {{ $row->student->name }}</td>
                              <td>{{ $row->year . "/" . ($row->year + 1)}}</td>
                              <td> {{ $semester == 0 ? 'GENAP':'GASAL'}}</td>
                              <td>{{ $row->status }}</td>
                              <td>
                                   <div class="d-flex">
                                        <button type="button" class="btn btn-sm btn-outline-dark m-1" onclick="window.open('{{ url('bimbinganstudi/export') }}?id={{ $row->id }}','_blank')" >Cetak</button>
                                   </div>
                              </td>
                         </tr>
                    @endforeach
               </tbody>
          </table>
          <div class="d-flex justify-content-center align-items-center text-center">
               {{ $bimbinganstudi->links() }}
          </div>
     </div>
    </div>
</x-app-layout>
