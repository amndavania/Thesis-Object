@include('report.kop')
        <h2 class="title">
            Jurnal Umum
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
                    <th style="width: 15%;">Tanggal</th>
                    <th style="width: 20%;">Nama Akun</th>
                    <th style="width: 10%;">ID Akun</th>
                    <th style="width: 10%;">Ref</th>
                    <th style="width: 20%;">Debit</th>
                    <th style="width: 20%;">Kredit</th>
                </tr>
            </thead>
            <tbody>
            @php
               $totalKredit = 0;
               $totalDebit = 0;
            @endphp
            @foreach ($transaction as $row)
                         <tr>
                              <td>{{ $loop->iteration }}</td>
                              <td>{{ $row->created_at->format('d-m-Y') }}</td>
                              <td>{{ $row->transactionaccount->name }}</td>
                              <td>{{ $row->id }}</td>
                              <td>{{ $row->reference_number }}</td>
                              <td class="currency">{{ $row->type == 'Debit' ? 'Rp ' . number_format($row->amount, 0, ',', '.') : null }}</td>
                              <td class="currency">{{ $row->type == 'Kredit' ? 'Rp ' . number_format($row->amount, 0, ',', '.') : null }}</td>
                         </tr>
                         @php
        if ($row->type == 'Debit') {
            $totalDebit += $row->amount;
        } elseif ($row->type == 'Kredit') {
            $totalKredit += $row->amount;
        }
    @endphp
                    @endforeach
            </tbody>
            <tfoot class="total">
            <tr>
                    <td colspan="5">
                         <strong>Total</strong>
                    </td>
                    <td class="currency">{{ 'Rp ' . number_format($totalDebit, 0, ',', '.') }}</td>
                    <td class="currency">{{ 'Rp ' . number_format($totalKredit, 0, ',', '.') }}</td>
                </tr>
            </tfoot>
            </div>
        </table>

@include('report.signature')
