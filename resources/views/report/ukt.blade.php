<x-app-layout>
    <x-slot name="title">
        Pembayaran Mahasiswa
    </x-slot>
    <div class="card">
     <div class="card-header">
          <div class="d-flex">
            <form class="form-inline" action="{{ route('uktdetail.index') }}" method="GET">
                <div class="mb-2 mr-sm-2">
                    <select class="form-control selectpicker" name="student_id" id="student_id" data-live-search="true">
                        <option value="">Pilih Mahasiswa</option>
                        @foreach ($students as $student)
                            <option value="{{ $student->id }}">{{ $student->nim . ' / ' . $student->name }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary mb-2">Cari</button>
              </form>
            <button onclick="window.open('{{ url('jurnal/export') }}', '_blank')" class="btn btn-sm btn-primary ml-auto p-2">Export PDF</button>
          </div>
     </div>
     <div class="card-body">
          <table class="table table-striped ">
               <thead class="table-dark">
                    <tr>
                         <th>No</th>
                         <td>Tanggal</td>
                         <td>Semester</td>
                         <td>Jenis Tagihan</td>
                         <td>Nominal</td>
                         <td>Status</td>
                    </tr>
               </thead>
               <tbody>
                    @foreach ($ukt as $row)
                         <tr>
                            <th>{{ $loop->iteration }}</th>
                            <td>{{ $row->created_at->format('d-m-Y') }}</td>
                              <td>{{ $row->semester }}</td>
                              <td>{{ $row->type }}</td>
                              <td>{{ 'Rp ' . number_format($row->amount, 0, ',', '.') }}</td>
                              <td>{{ $row->status }}</td>
                         </tr>
                    @endforeach
               </tbody>
          </table>
     </div>
    </div>
</x-app-layout>
