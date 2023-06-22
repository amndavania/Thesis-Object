<x-app-layout>
    <x-slot name="title">
        Detail Pembayaran Mahasiswa
    </x-slot>
    <div class="card">
     <div class="card-header">
          <div class="d-flex">
            <form class="form-inline" action="{{ route('uktdetail.index') }}" method="GET">
                <div class="mb-2 mr-sm-2">
                    <select class="form-control selectpicker" name="students_id" id="students_id" data-live-search="true">
                        <option value="">Pilih Mahasiswa</option>
                        @foreach ($students as $student)
                            <option value="{{ $student->id }}">{{ $student->nim . ' / ' . $student->name }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-primary mb-2">Cari</button>
              </form>
            <button onclick="window.open('{{ url('uktdetail/export') }}?student={{ $choice->id}}', '_blank')" class="btn btn-sm btn-primary ml-auto p-2">Export PDF</button>
          </div>
     </div>
     <div class="card-body">
        <h5>Mahasiswa: {{ $choice->nim . ' | ' . $choice->name }}</h5>
          <table class="table table-striped ">
               <thead class="table-dark">
                    <tr>
                         <th>No</th>
                         <td>Tanggal</td>
                         <td>Semester</td>
                         <td>Jenis Tagihan</td>
                         <td>Nominal</td>
                         <td>Status</td>
                         <td>Keterangan</td>
                         <td>Aksi</td>
                    </tr>
               </thead>
               <tbody>
                    @foreach ($ukt as $row)
                         <tr>
                            <th>{{ $loop->iteration }}</th>
                            <td>{{ $row->created_at->format('d-m-Y') }}</td>
                              <td>{{ $row->semester }}</td>
                              <td>{{ $row->type }}</td>
                              <td>{{ 'Rp ' . number_format($row->amount, 2, ',', '.') }}</td>
                              <td>{{ $row->status }}</td>
                              <td>{{ $row->keterangan }}</td>
                              @if ($row->keterangan == 'Menunggu Dispensasi UTS' || $row->keterangan == 'Menunggu Dispensasi UAS')
                                    <td>
                                        <button type="button" onclick="updateData('{{ $row->id }}', '{{ $row->keterangan }}', '{{ $choice->id }}')" class="btn btn-sm btn-outline-danger">Dispensasi</button>
                                    </td>
                                @else
                                <td></td>
                                @endif
                         </tr>
                    @endforeach
               </tbody>
          </table>
     </div>
    </div>
</x-app-layout>
