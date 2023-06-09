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
                <td>{{ $datepicker }}</td>
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
                    <th style="width: 5%;">No</th>
                    <th style="width: 12%;">Tanggal</th>
                    <th style="width: 20%;">Uraian</th>
                    <th style="width: 8%;">ID</th>
                    <th style="width: 20%;">Nama Akun</th>
                    {{-- <th style="width: 8%;">Ref</th> --}}
                    <th style="width: 15%;">Debit</th>
                    <th style="width: 15%;">Kredit</th>
                </tr>
            </thead>
            <tbody>
            @php
               $totalKredit = 0;
               $totalDebit = 0;
            @endphp

            @foreach ($data as $row)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $row->created_at->format('d-m-Y') }}</td>
                    <td>{{ $row->description }}</td>
                    <td>{{ $row->transactionaccount->id }}</td>
                    <td>{{ $row->transactionaccount->name }}</td>
                    {{-- <td>{{ $row->reference_number }}</td> --}}
                    <td>{{ $row->type == 'debit' ? 'Rp ' . number_format($row->amount, 2, ',', '.') : '-' }}</td>
                    <td>{{ $row->type == 'kredit' ? 'Rp ' . number_format($row->amount, 2, ',', '.') : '-' }}</td>
                </tr>
                @php
                    if ($row->type == 'debit') {
                        $totalDebit += $row->amount;
                    } elseif ($row->type == 'kredit') {
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
                    <td>{{ 'Rp ' . number_format($totalDebit, 2, ',', '.') }}</td>
                    <td>{{ 'Rp ' . number_format($totalKredit, 2, ',', '.') }}</td>
                </tr>
            </tfoot>
            </div>
        </table>

@include('report.signature')
