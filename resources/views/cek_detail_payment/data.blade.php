<x-guest-layout>
    <x-slot name="title">
        Detail Pembayaran Mahasiswa
    </x-slot>
    <div class="card mt-4">
     <div class="card-header">
        <div class="d-flex text-center">
            <div class="text-center">
                <h4 class="text-center">
                    Data Pembayaran Mahasiswa
                </h4>
            </div>
        </div>
     </div>
     <div class="card-body">
        <h5>
            @if (!empty($choice))
                <span class="badge bg-dark">{{ $choice->nim . ' - ' . $choice->name }}</span>
            @else
            <span class="badge bg-warning">Tidak ada mahasiswa</span>
            @endif
        </h5>
        <h5>
            @if ($isValid==False)
            <span class="badge bg-warning">Data yang anda input kemungkinan tidak cocok</span>
            @endif
        </h5>
          <table class="table table-striped text-center my-2">
               <thead class="table-dark">
                    <tr>
                         <th>No</th>
                         <td>Tanggal</td>
                         <td>Semester</td>
                         <td>Jenis Tagihan</td>
                         <td>Nominal</td>
                         <td>Status</td>
                         <td>Keterangan</td>
                         <td>Cetak</td>
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
                              <td>
                                @if (!is_null($row->lbs_id) && !is_null($row->exam_uts_id) && !is_null($row->exam_uas_id))
                                    <button type="button" class="btn btn-sm btn-outline-dark m-1" onclick="window.location='{{ url('databayar/exportLBS') }}?id={{ $row->lbs_id }}'">KRS</button>
                                    <button type="button" class="btn btn-sm btn-outline-dark m-1" onclick="window.location='{{ url('databayar/lihatKartu') }}?id={{ $row->exam_uts_id }}'">UTS</button>
                                    <button type="button" class="btn btn-sm btn-outline-dark m-1" onclick="window.location='{{ url('databayar/lihatKartu') }}?id={{ $row->exam_uas_id }}'">UAS</button>
                                @elseif (!is_null($row->lbs_id) && !is_null($row->exam_uts_id))
                                    <button type="button" class="btn btn-sm btn-outline-dark m-1" onclick="window.location='{{ url('databayar/exportLBS') }}?id={{ $row->lbs_id }}'">KRS</button>
                                    <button type="button" class="btn btn-sm btn-outline-dark m-1" onclick="window.location='{{ url('databayar/lihatKartu') }}?id={{ $row->exam_uts_id }}'">UTS</button>
                                @elseif (!is_null($row->lbs_id))
                                    <button type="button" class="btn btn-sm btn-outline-dark m-1" onclick="window.location='{{ url('databayar/exportLBS') }}?id={{ $row->lbs_id }}'">KRS</button>
                                @elseif (!is_null($row->exam_uts_id))
                                    <button type="button" class="btn btn-sm btn-outline-dark m-1" onclick="window.location='{{ url('databayar/lihatKartu') }}?id={{ $row->exam_uts_id }}'">UTS</button>
                                @elseif (!is_null($row->exam_uas_id))
                                    <button type="button" class="btn btn-sm btn-outline-dark m-1" onclick="window.location='{{ url('databayar/lihatKartu') }}?id={{ $row->exam_uas_id }}'">UAS</button>
                                @endif

                                {{-- @if ($row->status == 'Belum Lunas')
                                    @if (!is_null($row->lbs_id))
                                        <button type="button" class="btn btn-sm btn-outline-dark m-1" onclick="window.location='{{ url('databayar/exportLBS') }}?id={{ $row->lbs_id }}'">KRS</button>
                                    @endif
                                @elseif ($row->status == 'Lunas KRS')
                                    <button type="button" class="btn btn-sm btn-outline-dark m-1" onclick="window.location='{{ url('databayar/exportLBS') }}?id={{ $row->lbs_id }}'">KRS</button>
                                @elseif ($row->status == 'Lunas UTS')
                                    <button type="button" class="btn btn-sm btn-outline-dark m-1" onclick="window.location='{{ url('databayar/lihatKartu') }}?id={{ $row->exam_uts_id }}'">UTS</button>
                                @elseif ($row->status == 'Lunas')
                                    @if (is_null($row->lbs_id) && is_null($row->exam_uts_id) && !is_null($row->exam_uas_id))
                                        <button type="button" class="btn btn-sm btn-outline-dark m-1" onclick="window.location='{{ url('databayar/lihatKartu') }}?id={{ $row->exam_uas_id }}'">UAS</button>
                                    @elseif (!is_null($row->lbs_id) && is_null($row->exam_uts_id) && is_null($row->exam_uas_id))
                                        <button type="button" class="btn btn-sm btn-outline-dark m-1" onclick="window.location='{{ url('databayar/exportLBS') }}?id={{ $row->lbs_id }}'">KRS</button>
                                    @elseif (!is_null($row->lbs_id) && !is_null($row->exam_uts_id) && !is_null($row->exam_uas_id))
                                        <button type="button" class="btn btn-sm btn-outline-dark m-1" onclick="window.location='{{ url('databayar/exportLBS') }}?id={{ $row->lbs_id }}'">KRS</button>
                                        <button type="button" class="btn btn-sm btn-outline-dark m-1" onclick="window.location='{{ url('databayar/lihatKartu') }}?id={{ $row->exam_uts_id }}'">UTS</button>
                                        <button type="button" class="btn btn-sm btn-outline-dark m-1" onclick="window.location='{{ url('databayar/lihatKartu') }}?id={{ $row->exam_uas_id }}'">UAS</button>
                                    @endif

                                @endif --}}
                              </td>
                         </tr>
                    @endforeach
               </tbody>
          </table>
          @if (!empty($choice))
          <button onclick="window.open('{{ url('databayar/export') }}?student={{ $choice->id}}', '_blank')" class="btn btn-block btn-primary ml-auto p-2">Export PDF</button>
            @endif
        </div>
    </div>

</x-guest-layout>
