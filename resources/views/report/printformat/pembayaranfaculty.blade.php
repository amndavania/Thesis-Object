@include('report.kop')
        <h2 class="title">
            Laporan Pembayaran UKT
        </h2>
        <table class="keterangan">
            <tr>
                <td>
                    Fakultas
                </td>
                <td>:</td>
                <td>{{ $faculty }}</td>
            </tr>
            <tr>
                <td>
                    Periode
                </td>
                <td>:</td>
                <td>{{ $month }}</td>
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
                    <th style="width: 10%;">Tanggal</th>
                    <th style="width: 20%;">Mahasiswa</th>
                    <th style="width: 10%;">Nominal</th>
                    <th style="width: 10%;">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ukt as $row)
                    <tr>
                        <th>{{ $loop->iteration }}</th>
                        <td style="text-align: center;">{{ $row->created_at->format('d-m-Y') }}</td>
                        <td>{{ $row->student_id->nim . " / " . $row->student_id->name }}</td>
                        <td style="text-align: right;">{{ 'Rp ' . number_format($row->amount, 2, ',', '.') }}</td>
                        <td style="text-align: center;">{{ $row->status }}</td>
                    </tr>
                @endforeach
        </tbody>
        <tfoot class="table-dark">
           <tr>
                   <td colspan="3">
                        <strong>Total Pembayaran UKT</strong>
                   </td>
                   <td style="text-align: right;">
                       <strong>{{ 'Rp ' . number_format($totalUkt, 2, ',', '.') }}</strong>
                   </td>
                   <td></td>
               </tr>
           </tfoot>
            </div>
        </table>

@include('report.signature')
