@include('report.kop')
        <h2 class="title">
            Laporan Buku Besar
        </h2>
        <table class="keterangan">
            <tr>
                <td>
                    Kode Akun
                </td>
                <td>:</td>
                <td>{{ $account->id }}</td>
            </tr>
            <tr>
                <td>
                    Nama Akun
                </td>
                <td>:</td>
                <td>{{ $account->name }}</td>
            </tr>
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
                    <th style="width: 25%;">Uraian</th>
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
                      <td style="text-align: center;">{{ $loop->iteration }}</td>
                      <td style="text-align: center;">{{ $row->created_at->format('d-m-Y') }}</td>
                      <td>{{ $row->description }}</td>
                      <td style="text-align: right;">{{ $row->type == 'debit' ? 'Rp ' . number_format($row->amount, 2, ',', '.') : '-' }}</td>
                      <td style="text-align: right;">{{ $row->type == 'kredit' ? 'Rp ' . number_format($row->amount, 2, ',', '.') : '-' }}</td>
                        @php
                        $debit = 0;
                        $kredit = 0;
                            if ($row->type == 'debit') {
                                $debit = $row->amount;
                                $totalDebit += $debit;
                            } elseif ($row->type == 'kredit') {
                                $kredit = $row->amount;
                                $totalKredit += $kredit;
                            }
                            $totalSaldo += ($debit - $kredit);
                        @endphp
                        <td style="text-align: right;">
                            @if ($totalSaldo < 0)
                                (Rp {{ number_format(abs($totalSaldo), 2, ',', '.') }})
                            @elseif ($totalSaldo > 0)
                                Rp {{ number_format($totalSaldo, 2, ',', '.') }}
                            @else
                                -
                            @endif
                        </td>
                      {{-- <td class="currency">{{ $totalSaldo ? 'Rp ' . number_format($totalSaldo, 0, ',', '.') : '-'}}</td> --}}
                 </tr>
            @endforeach
            </tbody>
            <tfoot class = "total">
            <tr>
                    <td colspan="3">
                         <strong>Total</strong>
                    </td>
                    <td style="text-align: right;">{{ 'Rp ' . number_format($totalDebit, 2, ',', '.') }}</td>
                    <td style="text-align: right;">{{ 'Rp ' . number_format($totalKredit, 2, ',', '.') }}</td>
                    <td style="text-align: right;">
                        @if ($totalSaldo < 0)
                            (Rp {{ number_format(abs($totalSaldo), 2, ',', '.') }})
                        @elseif ($totalSaldo > 0)
                            Rp {{ number_format($totalSaldo, 2, ',', '.') }}
                        @else
                            -
                        @endif
                    </td>
                </tr>
            </tfoot>
            </div>
        </table>
        @include('report.signature')
