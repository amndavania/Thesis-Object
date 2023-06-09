@include('report.kop')
        <h2 class="title">
            Laporan Buku Besar
        </h2>
        <table class="keterangan">
            <tr>
                <td>
                    Periode
                </td>
                <td>:</td>
                <td>Mei 2023</td>
            </tr>
            <tr>
                <td>
                    Tanggal Dicetak
                </td>
                <td>:</td>
                <td>25 Mei 2023</td>
            </tr>
        </table>
        <table class="content">
            <thead>
                <tr>
                    <th style="width: 5%;">No</th>
                    <th style="width: 15%;">Nama Akun</th>
                    <th style="width: 5%;">ID Akun</th>
                    <th style="width: 30%;">Keterangan</th>
                    <th style="width: 15%;">Debit</th>
                    <th style="width: 15%;">Kredit</th>
                    <th style="width: 15%;">Saldo</th>
                </tr>
            </thead>
            <tbody>
            @php
               $totalKredit = 0;
               $totalDebit = 0;
               $totalSaldo = 0;
            @endphp
            @foreach ($data as $row)
                         <tr>
                              <td>{{ $loop->iteration }}</td>
                              <td>{{ $row->name }}</td>
                              <td>{{ $row->id }}</td>
                              <td>{{ $row->description }}</td>
                              <td class="currency">{{'Rp ' . number_format($row->ammount_debit, 0, ',', '.') }}</td>
                              <td class="currency">{{'Rp ' . number_format($row->ammount_kredit, 0, ',', '.') }}</td>
                              <td class="currency">{{'Rp ' . number_format($row->ammount_debit - $row->ammount_kredit, 0, ',', '.') }}</td>
                         </tr>
                         @php
                         $totalKredit += $row->ammount_kredit;
                         $totalDebit += $row->ammount_debit;
                         $totalSaldo += ($row->ammount_debit - $row->ammount_kredit);
                         @endphp
                    @endforeach
            </tbody>
            <tfoot class = "total">
            <tr>
                    <td colspan="4">
                         <strong>Total</strong>
                    </td>
                    <td class="currency">{{ 'Rp ' . number_format($totalDebit, 0, ',', '.') }}</td>
                    <td class="currency">{{ 'Rp ' . number_format($totalKredit, 0, ',', '.') }}</td>
                    <td class="currency">{{ 'Rp ' . number_format($totalSaldo, 0, ',', '.') }}</td>
                </tr>
            </tfoot>
            </div>
        </table>
        @include('report.signature')
