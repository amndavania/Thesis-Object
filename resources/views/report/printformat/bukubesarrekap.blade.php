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
                    <th style="width: 15%;">Kode Akun</th>
                    <th style="width: 20%;">Nama</th>
                    <th style="width: 20%;">Deskripsi</th>
                    <th style="width: 20%;">Debit</th>
                    <th style="width: 20%;">Kredit</th>
                </tr>
            </thead>
            <tbody>
                   @php
                $totalDebit = 0;
                $totalKredit = 0;
                @endphp

                @foreach ($data as $row)
                <tr onclick="window.open('{{ route('bukubesar.index') }}?search_account={{ $row['id'] }}&datepicker={{ $datepicker }}', '_blank')"
                        style="cursor: pointer; background-color: #f5f5f5;" onmouseover="this.style.backgroundColor='#e9e9e9';" onmouseout="this.style.backgroundColor='#f5f5f5';">
                    <th>{{ $loop->iteration }}</th>
                    <td>{{ $row['id'] }}</td>
                    <td>{{ $row['name'] }}</td>
                    <td>{{ $row['description'] }}</td>
                    <td style="@if ($row['debit'] < 0) color: red; @endif; width:20%">
                        @if ($row['debit'] < 0)
                            (Rp {{ number_format(abs($row['debit']), 2, ',', '.') }})
                        @elseif ($row['debit'] > 0)
                            Rp {{ number_format($row['debit'], 2, ',', '.') }}
                        @else
                            -
                        @endif
                    </td>
                    <td style="@if ($row['kredit'] < 0) color: red; @endif; width:20%">
                        @if ($row['kredit'] < 0)
                            (Rp {{ number_format(abs($row['kredit']), 2, ',', '.') }})
                        @elseif ($row['kredit'] > 0)
                            Rp {{ number_format($row['kredit'], 2, ',', '.') }}
                        @else
                            -
                        @endif
                    </td>
                </tr>
                @php
                $totalDebit += $row['debit'];
                $totalKredit += $row['kredit'];
                @endphp
            @endforeach
               </tbody>
               <tfoot class="table-dark">
                <tr>
                        <td colspan="4">
                             <strong>Total</strong>
                        </td>
                        <td style="@if (($totalDebit) < 0) color: red; @endif;">
                            @if (($totalDebit) < 0)
                                (Rp {{ number_format(abs(($totalDebit)), 2, ',', '.') }})
                            @elseif (($totalDebit) > 0 || ($totalDebit) == 0)
                                Rp {{ number_format(($totalDebit), 2, ',', '.') }}
                            @else
                                -
                            @endif
                        </td>
                        <td style="@if (($totalKredit) < 0) color: red; @endif;">
                            @if (($totalKredit) < 0)
                                (Rp {{ number_format(abs(($totalKredit)), 2, ',', '.') }})
                            @elseif (($totalKredit) > 0 || ($totalKredit) == 0)
                                Rp {{ number_format(($totalKredit), 2, ',', '.') }}
                            @else
                                -
                            @endif
                        </td>
                    </tr>
                </tfoot>
            </div>
        </table>
        @include('report.signature')
