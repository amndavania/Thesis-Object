<x-app-layout>
    <x-slot name="title">
        Lembar Bimbingan Studi
    </x-slot>
    <div class="card">
     <div class="card-header">
     <div class="d-flex align-items-center">
     <form class="form-inline" action="{{ url('daftar_mahasiswa') }}" method="GET">
        <input type="hidden" id="dpa_id" name="dpa_id" value="{{ $dpa->id }}">
                <input type="text" class="form-control mb-2 mr-2" id="dpatahunajaran" name="year" placeholder="Pilih Tahun Ajaran" readonly>
                <div class="mb-2 mr-sm-2">
                        <select class="form-control" id="semester" name="semester">
                            <option value="">Pilih Semester</option>
                            <option value="GASAL" {{ old('semester') == 'GASAL' ? 'selected' : '' }}>GASAL</option>
                            <option value="GENAP" {{ old('semester') == 'GENAP' ? 'selected' : '' }}>GENAP</option>
                        </select>
                </div>
              <button type="submit" class="btn btn-primary mb-2">Cari</button>
     </form>
              {{-- @if (!empty($data))
              <button onclick="window.open('{{ url('bukubesar/export') }}?search_account={{ $account->id }}&datepicker={{ $datepicker }}&filter={{ $filter }}', '_blank')" class="btn btn-sm btn-primary ml-auto p-2">
                <i class="fas fa-print"></i> Export PDF
            </button>
              @endif --}}
          </div>
     </div>
     <div class="card-body">
        <div class="d-flex justify-content-between">
        <h5>
            @if (!empty($dpa))
                <span class="badge bg-warning">{{ $dpa->name }}</span>
            @endif
        </h5>
        <h5>
            @if (!empty($tahunAjaran))
                <span class="badge bg-warning">{{ $tahunAjaran[0] . "/" . ($tahunAjaran[0]+1) . " | " . $tahunAjaran[1] }}</span>
            @endif
        </h5>
        </div>
          <table class="table table-striped ">
               <thead class="table-dark">
                    <tr>
                         <th>No</th>
                         <td>NIM</td>
                         <td>Nama Mahasiswa</td>
                         <td>Semester</td>
                         <td>Status</td>
                         <td>Aksi</td>
                    </tr>
               </thead>
               <tbody>
                    @foreach ($data as $index => $row)
                    {{-- @php
                        $number = ($data->currentPage() - 1) * $data->perPage() + $index + 1;
                    @endphp --}}
                         <tr>
                              <th>{{ $loop->iteration }}</th>
                              <td>{{ $row['nim'] }}</td>
                              <td>{{ $row['name'] }}</td>
                              <td>{{ $row['semester'] }}</td>
                              <td>{{ $row['status'] }}</td>
                              @if ($row['status'] == 'Tunda')
                                    <td>
                                        <button type="button" onclick="updateKrs('{{ $row['id'] }}')" class="btn btn-sm btn-outline-danger">Setujui KRS</button>
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
