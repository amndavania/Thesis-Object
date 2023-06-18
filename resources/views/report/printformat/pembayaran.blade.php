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
                    <th style="width: 5%;">Semester</th>
                    <th style="width: 12%;">Jenis Tagihan</th>
                    <th style="width: 20%;">Nominal</th>
                    <th style="width: 15%;">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ukt as $row)
                     <tr>
                        <th>{{ $loop->iteration }}</th>
                        <td>{{ $row['tanggal']->format('d-m-Y') }}</td>
                          <td>{{ $row['semester'] }}</td>
                          <td>{{ $row['jenis'] }}</td>
                          <td>{{ 'Rp ' . number_format($row['total'], 0, ',', '.') }}</td>
                          <td>{{ $row['status'] }}</td>
                     </tr>
                @endforeach
           </tbody>
            <tfoot class="total">
            
            </tfoot>
            </div>
        </table>

@include('report.signature')
