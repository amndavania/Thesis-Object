<x-app-layout>
    <x-slot name="title">
        Detail Pembayaran Mahasiswa
    </x-slot>
    <div class="card">
     <div class="card-header">
          <div class="d-flex">
            <form class="form-inline" action="{{ route('uktdetail.index') }}" method="GET">
                <div class="mb-2 mr-sm-2">
                    <select class="form-control selectpicker" name="filterUkt" id="filterUkt" data-live-search="true" onchange="handleFilterUktChange()">
                        <option value="student">Filter by</option>
                        <option value="student">Mahasiswa</option>
                        <option value="faculty">Fakultas</option>
                    </select>
                </div>
                <div class="mb-2 mr-sm-2" id="mahasiswaContainer">
                    <select class="form-control selectpicker" name="students_id" id="students_id" data-live-search="true">
                        <option value="">Pilih Mahasiswa</option>
                        @foreach ($students as $student)
                            <option value="{{ $student->id }}">{{ $student->nim . ' / ' . $student->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-2 mr-sm-2" id="fakultasContainer" style="display: none">
                    <select class="form-control" id="faculty_id" name="faculty_id">
                        <option value="">Pilih Fakultas</option>
                            @foreach ($faculty as $item)
                                 <option value="{{ $item->id }}" {{ old('faculty_id') == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                            @endforeach
                       </select>
                </div>
                <div class="mb-2 mr-sm-2" id="datepickerContainer" style="display: none">
                    <input type="text" class="form-control" id="datepicker" name="datepicker" placeholder="Pilih Bulan" readonly>
                </div>

                <button type="submit" class="btn btn-primary mb-2">Cari</button>
              </form>
              @if (!empty($choice) && $ukt->count() != 0)
                @if ($filter == "student")
                    <button onclick="window.open('{{ url('uktdetail/export') }}?filter={{ $filter }}&student={{ $choice->id}}', '_blank')" class="btn btn-sm btn-primary ml-auto p-2">Export PDF</button>
                @elseif ($filter == "faculty")
                    <button onclick="window.open('{{ url('uktdetail/export') }}?filter={{ $filter }}&faculty={{ $choice->id}}&datepicker={{ $datepicker }}', '_blank')" class="btn btn-sm btn-primary ml-auto p-2">Export PDF</button>
                @endif
              @endif
            </div>
     </div>
     <div class="card-body">
        @if ($filter == "student")
            <h5>
                @if (!empty($choice))
                    <span class="badge bg-warning">{{ $choice->nim . ' | ' . $choice->name }}</span>
                @else
                    <span class="badge bg-warning">Tidak ada mahasiswa</span>
                @endif
            </h5>
            <table class="table table-striped ">
                <thead class="table-dark">
                     <tr>
                          <th>No</th>
                          <td>Tanggal</td>
                          <td>Tahun Ajaran</td>
                          <td>Semester</td>
                          <td>Jenis Tagihan</td>
                          <td>Nominal</td>
                          <td>Status</td>
                          <td>Keterangan</td>
                          <td>Aksi</td>
                     </tr>
                </thead>
                @if (!is_null($ukt))
                 <tbody>
                     @foreach ($ukt as $row)
                         <tr>
                             <th>{{ $loop->iteration }}</th>
                             <td>{{ $row->created_at->format('d-m-Y') }}</td>
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
                             <td>{{ $row->keterangan }}</td>
                             @if ($row->keterangan == 'Menunggu Dispensasi UTS' || $row->keterangan == 'Menunggu Dispensasi UAS' || $row->keterangan == 'Menunggu Dispensasi KRS')
                                     <td>
                                         <button type="button" onclick="updateData('{{ $row->id }}', '{{ $row->keterangan }}', '{{ $choice->id }}')" class="btn btn-sm btn-outline-danger">Dispensasi</button>
                                     </td>
                                 @else
                                 <td></td>
                                 @endif
                         </tr>
                     @endforeach
             </tbody>
                 @endif
           </table>
        @elseif ($filter == "faculty")
            <h5>
                @if (empty($choice))
                    <span class="badge bg-warning">{{ $datepicker . ' | Tidak ada fakultas'  }}</span>
                @elseif (empty($datepicker))
                    <span class="badge bg-warning">{{ 'Tidak ada tanggal | ' . $choice->name }}</span>
                @else
                    <span class="badge bg-warning">{{ $datepicker . ' | ' . $choice->name }}</span>
                @endif
            </h5>
            <table class="table table-striped ">
                <thead class="table-dark">
                     <tr>
                          <th>No</th>
                          <th>Tanggal</th>
                          <td>Mahasiswa</td>
                          <td>Nominal</td>
                          <td>Status</td>
                     </tr>
                </thead>
                @if (!is_null($ukt))
                 <tbody>
                     @foreach ($ukt as $row)
                         <tr>
                             <th>{{ $loop->iteration }}</th>
                             <td>{{ $row->created_at->format('d-m-Y') }}</td>
                             <td>{{$row->student_id->nim . " / " . $row->student_id->name }}</td>
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
                         </tr>
                     @endforeach
             </tbody>
             <tfoot class="table-dark">
                <tr>
                        <td colspan="3">
                             <strong>Total Pembayaran UKT</strong>
                        </td>
                        <td>
                            <strong>{{ 'Rp ' . number_format($totalUkt, 2, ',', '.') }}</strong>
                        </td>
                        <td></td>
                    </tr>
                </tfoot>
                 @endif
           </table>
        @endif
     </div>
    </div>
</x-app-layout>
