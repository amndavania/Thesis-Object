<x-app-layout>
    <x-slot name="title">
        Pembayaran Mahasiswa
    </x-slot>
    <div class="card">
     <div class="card-header">
          <div class="d-flex">
            @include('message.flash-message')
               <button type="button" class="btn btn-sm btn-primary ml-auto p-2" onclick="window.location='{{ url('ukt/create') }}'">
                    <i class="fas fa-plus-circle"></i> Tambah Data
               </button>
          </div>
     </div>
     <div class="card-body">
          <table class="table table-striped ">
               <thead class="table-dark">
                    <tr>
                         <th>No</th>
                         <td>Tanggal</td>
                         <td>Mahasiswa</td>
                         <td>Tahun Ajaran</td>
                         <td>Semester</td>
                         <td>Jenis</td>
                         <td>Nominal</td>
                         <td>Status</td>
                         <td>Aksi</td>
                    </tr>
               </thead>
               <tbody>
                    @foreach ($ukt as $index => $row)
                    @php
                        $number = ($ukt->currentPage() - 1) * $ukt->perPage() + $index + 1;
                    @endphp
                         <tr>
                              <th>{{ $number }}</th>
                              <td>{{ $row->created_at->format('d-m-Y') }}</td>
                              <td>{{ $row->student_id->nim }} | {{ $row->student_id->name }}</td>
                              <td>{{ $row->year . "/" . ($row->year + 1) }}</td>
                              <td>{{ $row->semester }}</td>
                              <td>{{ $row->type }}</td>
                              <td>{{ 'Rp ' . number_format($row->amount, 2, ',', '.') }}</td>
                              <td>
                                @if ($row->status == "Lunas")
                                    <span class="badge bg-success">Lunas</span>
                                @elseif ($row->status == "Lunas UTS")
                                    <span class="badge bg-warning">Lunas UTS</span>
                                @elseif ($row->status == "Lunas KRS")
                                    <span class="badge bg-warning">Lunas KRS</span>
                                @elseif ($row->status == "Belum Lunas")
                                    <span class="badge bg-danger">Belum Lunas</span>
                                @else
                                    <span class="badge bg-danger">Lebih</span>
                                @endif
                              </td>
                              <td>
                                   <div class="d-flex">
                                        <form action="{{ route('ukt.destroy',$row->id) }}" method="post" class="m-1">
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
               {{ $ukt->links() }}
          </div>
     </div>
    </div>
</x-app-layout>
