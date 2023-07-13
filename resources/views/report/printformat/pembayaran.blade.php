@include('report.kop')
        <h2 class="title">
            Laporan Pembayaran Mahasiswa
        </h2>
        <table class="keterangan">
            <tr>
                <td>
                    Nama
                </td>
                <td>:</td>
                <td>{{ $name }}</td>
            </tr>
            <tr>
                <td>
                    NIM
                </td>
                <td>:</td>
                <td>{{ $nim }}</td>
            </tr>
            <tr>
                <td>
                    Tanggal Dicetak
                </td>
                <td>:</td>
                <td>{{ $today }}</td>
            </tr>
        </table>
        <table class="content">
            <thead>
                <tr>
                    <th style="width: 3%;">No</th>
                    <th style="width: 12%;">Tanggal</th>
                    <th style="width: 12%;">Tahun Ajaran</th>
                    <th style="width: 5%;">Semester</th>
                    <th style="width: 12%;">Jenis Tagihan</th>
                    <th style="width: 20%;">Nominal</th>
                    <th style="width: 15%;">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ukt as $row)
                     <tr>
                        <th style="text-align: center;">{{ $loop->iteration }}</th>
                        <td style="text-align: center;">{{ $row->created_at->format('d-m-Y') }}</td>
                        <td style="text-align: center;">{{ $row->year . "/" . ($row->year + 1) }}</td>
                          <td style="text-align: center;">{{ $row->semester }}</td>
                          <td style="text-align: center;">{{ $row->type }}</td>
                          <td style="text-align: right;">{{ 'Rp ' . number_format($row->amount, 2, ',', '.') }}</td>
                          <td style="text-align: center;">{{ $row->status }}</td>
                     </tr>
                @endforeach
           </tbody>
            <tfoot>
                <tr>
                    <th colspan="5">
                         <strong>Total</strong>
                    </th>
                    <th style="text-align: right;">Rp {{ number_format(($totalUkt), 2, ',', '.') }}</th>
                    <th></th>
                </tr>
            </tfoot>
            </div>
        </table>

@include('report.signature')
