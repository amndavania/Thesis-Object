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
                    <th style="width: 15%;">Tanggal</th>
                    <th style="width: 40%;">Uraian</th>
                    <th style="width: 20%;">Debit</th>
                    <th style="width: 20%;">Kredit</th>
                </tr>
            </thead>
            <tbody>
                    @php
                    $totalKredit = 0;
                    $totalDebit = 0;
                    $totalSaldo = 0;
                    if (!empty($history)) {
                        $saldoSebelumnya = $history->saldo;
                    } else {
                        $saldoSebelumnya = 0;
                    }
                    @endphp
                    @if (!empty($history))
                    <tr>
                        <td colspan="4">
                            @if ($history->type == 'monthly')
                                <strong>Saldo Akhir Bulan Sebelumnya</strong>
                            @elseif ($history->type == 'annual')
                                <strong>Saldo Akhir Tahun Sebelumnya</strong>
                            @endif
                        </td>
                        <td style="@if ($saldoSebelumnya < 0) color: red; @endif">
                            @if ($saldoSebelumnya < 0)
                                <strong>(Rp {{ number_format(abs($saldoSebelumnya), 2, ',', '.') }})</strong>
                            @elseif ($saldoSebelumnya > 0 || $saldoSebelumnya == 0)
                                <strong>Rp {{ number_format($saldoSebelumnya, 2, ',', '.') }}</strong>
                            @else
                                <strong>-</strong>
                            @endif
                        </td>
                    </tr>
                    @endif
                    @foreach ($data as $row)
                         <tr>
                              <th>{{ $loop->iteration }}</th>
                              <td>{{ $row->created_at->format('d-m-Y') }}</td>
                              <td>{{ $row->description }}</td>
                              <td>{{ $row->type == 'debit' ? 'Rp ' . number_format($row->amount, 2, ',', '.') : '-' }}</td>
                              <td>{{ $row->type == 'kredit' ? 'Rp ' . number_format($row->amount, 2, ',', '.') : '-' }}</td>
                              @php
                                $saldo = 0;
                                    if ($row->type == 'debit') {
                                        $totalDebit += $row->amount;
                                        $saldo = $row->amount;

                                    } elseif ($row->type == 'kredit') {
                                        $totalKredit += $row->amount;
                                    }
                                @endphp
                         </tr>
                    @endforeach
               </tbody>
               <tfoot class="table-dark">
                <tr>
                        <td colspan="3">
                             <strong>Total</strong>
                        </td>
                        <td>{{ 'Rp ' . number_format($totalDebit, 2, ',', '.') }}</td>
                        <td>{{ 'Rp ' . number_format($totalKredit, 2, ',', '.') }}</td>
                    </tr>
                <tr>
                        <td colspan="3">
                             <strong>Total Saldo</strong>
                        </td>
                        <td style="@if (($totalDebit - $totalKredit) < 0) color: red; @endif; text-align: center;" colspan="2">
                            @if (($totalDebit - $totalKredit) < 0)
                                (Rp {{ number_format(abs(($totalDebit - $totalKredit)), 2, ',', '.') }})
                            @elseif (($totalDebit - $totalKredit) > 0 || ($totalDebit - $totalKredit) == 0)
                                Rp {{ number_format(($totalDebit - $totalKredit), 2, ',', '.') }}
                            @else
                                -
                            @endif
                        </td>
                    </tr>
                </tfoot>
            </div>
        </table>
        @include('report.signature')
