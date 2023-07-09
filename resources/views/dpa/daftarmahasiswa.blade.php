<x-app-layout>
    <x-slot name="title">
        Transaksi
    </x-slot>
    <div class="card">
     <div class="card-header">
     <div class="d-flex align-items-center">
          <form class="form-inline" action="{{ route('bukubesar.index') }}" method="GET">
    <div class="mb-2 mr-sm-2">
    <select class="form-control selectpicker" name="search_account" id="search_account" data-live-search="true">
          <option value="">Pilih Tahun Ajaran</option>
          @foreach ($years as $year)
               <option value="{{ $year->year }}">{{ $year->year }}</option>
          @endforeach
     </select>
    </div>
    <button type="submit" class="btn btn-primary mb-2">Cari</button>
</form>


              @if (!empty($account) && $data->count() > 0)
              <button onclick="window.open('{{ url('bukubesar/export') }}?search_account={{ $account->id }}&datepicker={{ $datepicker }}&filter={{ $filter }}', '_blank')" class="btn btn-sm btn-primary ml-auto p-2">
                <i class="fas fa-print"></i> Export PDF
            </button>
              @endif
          </div>
     </div>
     <div class="card-body">
          <table class="table table-striped ">
               <thead class="table-dark">
                    <tr>
                         <th>No</th>
                         <td>Nama Mahasiswa</td>
                         <td>NIM</td>
                         <td>Angkatan</td>
                         <td>Semester</td>
                         <td>Status</td>
                         <td>Aksi</td>
                    </tr>
               </thead>
               <tbody>
                    @foreach ($data as $index => $row)
                    @php
                        $number = ($data->currentPage() - 1) * $data->perPage() + $index + 1;
                    @endphp
                         <tr>
                              <th>{{ $number }}</th>
                              <td>{{ $row->student->name }}</td>
                              <td>{{ $row->student->nim }}</td>
                              <td>{{ $row->year }}</td>
                              <td>{{ $row->semester }}</td>
                              <td>{{ $row->status }}</td>
                              @if ($row->status == 'Tunda')
                                    <td>
                                        <button type="button" onclick="updateKrs('{{ $row->id }}')" class="btn btn-sm btn-outline-danger">Setujui KRS</button>
                                    </td>
                                @else
                                <td></td>
                                @endif
                              {{-- <td>
                                   <div class="d-flex">
                                        <button type="button" class="btn btn-sm btn-outline-dark m-1" onclick="window.location='{{ route('dpa.setujuKrs',$row->id) }}'">Setujui KRS</button>
                                   </div>

                              </td> --}}
                         </tr>
                    @endforeach
               </tbody>
          </table>
     </div>
    </div>
</x-app-layout>
