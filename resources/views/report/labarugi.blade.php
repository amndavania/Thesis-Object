<x-app-layout>
    <x-slot name="title">
      Laba Rugi
    </x-slot>
    <div class="card">
        <div class="card-header">
            <div class="d-flex">
                <form class="form-inline" action="{{ route('labarugi.index') }}" method="GET">
                    <div class="mb-2 mr-sm-2">
                        <select class="form-control selectpicker" name="filter" id="filter" data-live-search="true" onchange="handleFilterChange()">
                            <option value="month">Filter by</option>
                            <option value="month">Bulan</option>
                            <option value="year">Tahun</option>
                        </select>
                    </div>
                    <input type="text" class="form-control mb-2 mr-sm-2" id="datepicker" name="datepicker" placeholder="Pilih Bulan" readonly>
                    <button type="submit" class="btn btn-primary mb-2">Cari</button>
                </form>

                @if (!empty($pendapatan) || !empty($pengeluaran) || !empty($penyusutanAmortisasi) || !empty($bungaPajak) || !empty($pendapatanPengeluaranLain))
                    <button onclick="window.open('{{ url('labarugi/export') }}?datepicker={{ $datepicker }}&filter={{ $filter }}', '_blank')" class="btn btn-sm btn-primary ml-auto p-2">
                        <i class="fas fa-print"></i> Export PDF
                    </button>
                @endif
            </div>
       </div>
         <div class="card-body">
            <h5>
                @if (!empty($datepicker))
                    <span class="badge bg-warning">{{ $datepicker }}</span>
                @endif
            </h5>
            <table class="table table-striped ">
               <thead class="table-dark">
                    <tr>
                         <td style="text-align: center;">Kode Akun</td>
                         <td>Nama Akun</td>
                         <td>Debit</td>
                         <td>Kredit</td>
                         <td>Saldo</td>
                    </tr>
               </thead>
               <tbody>
                <tr>
                    <td></td>
                    <td colspan="4">
                        <strong>PENDAPATAN</strong>
                    </td>
                </tr>
           @php
           $totalPendapatanDebit = 0;
           $totalPendapatanKredit = 0;
           $totalPendapatan = 0;
           @endphp
                @foreach ($pendapatan as $accountId => $row)
                     <tr>
                          <td style="text-align: center;">{{ $accountId }}</td>
                          <td>{{ $row['name'] }}</td>
                        @if ($row['lajurSaldo'] == 'debit')
                        <td style="@if (($row['saldo']) < 0) color: red; @endif; width:20%">
                            @if (($row['saldo']) < 0)
                                (Rp {{ number_format(abs(($row['saldo'])), 2, ',', '.') }})
                            @elseif (($row['saldo']) > 0 || ($row['saldo']) == 0)
                                Rp {{ number_format(($row['saldo']), 2, ',', '.') }}
                            @else
                                -
                            @endif
                        </td>
                        <td>-</td>
                        @else
                        <td>-</td>
                        <td style="@if (($row['saldo']) < 0) color: red; @endif; width:20%">
                            @if (($row['saldo']) < 0)
                                (Rp {{ number_format(abs(($row['saldo'])), 2, ',', '.') }})
                            @elseif (($row['saldo']) > 0 || ($row['saldo']) == 0)
                                Rp {{ number_format(($row['saldo']), 2, ',', '.') }}
                            @else
                                -
                            @endif
                        </td>
                        @endif
                        <td></td>
                     </tr>
                     @php
                     if ($row['lajurSaldo'] == 'debit') {
                        $totalPendapatanDebit += $row['saldo'];
                     } elseif ($row['lajurSaldo'] == 'kredit'){
                        $totalPendapatanKredit += $row['saldo'];
                     }
                     $totalPendapatan += ($totalPendapatanKredit - $totalPendapatanDebit);
                    @endphp
                @endforeach
           <tr>
            <td></td>
                <td colspan="1">
                     <strong>Total Pendapatan</strong>
                </td>
                <td style=" @if ($totalPendapatanDebit < 0) color: red; @endif">
                    @if ($totalPendapatanDebit < 0)
                        (Rp {{ number_format(abs($totalPendapatanDebit), 2, ',', '.') }})
                    @elseif ($totalPendapatanDebit > 0 || $totalPendapatanDebit == 0)
                        Rp {{ number_format($totalPendapatanDebit, 2, ',', '.') }}
                    @else
                        -
                    @endif
                </td>
                <td style=" @if ($totalPendapatanKredit < 0) color: red; @endif">
                    @if ($totalPendapatanKredit < 0)
                        (Rp {{ number_format(abs($totalPendapatanKredit), 2, ',', '.') }})
                    @elseif ($totalPendapatanKredit > 0 || $totalPendapatanKredit == 0)
                        Rp {{ number_format($totalPendapatanKredit, 2, ',', '.') }}
                    @else
                        -
                    @endif
                </td>
                <td style=" @if (($totalPendapatan) < 0) color: red; @endif">
                    @if (($totalPendapatan) < 0)
                        (Rp {{ number_format(abs(($totalPendapatan)), 2, ',', '.') }})
                    @elseif (($totalPendapatan) > 0 || ($totalPendapatan) == 0)
                        Rp {{ number_format(($totalPendapatan), 2, ',', '.') }}
                    @else
                        -
                    @endif
                </td>
            </tr>

           <tr>
            <td></td>
                <td colspan="4">
                <strong>PENGELUARAN</strong>
                </td>
            </tr>
           @php
           $totalPengeluaranDebit = 0;
           $totalPengeluaranKredit = 0;
           $totalPengeluaran = 0;
           @endphp
                @foreach ($pengeluaran as $accountId => $row)
                     <tr>
                          <td style="text-align: center;">{{ $accountId }}</td>
                          <td>{{ $row['name'] }}</td>
                          @if ($row['lajurSaldo'] == 'debit')
                        <td style="@if (($row['saldo']) < 0) color: red; @endif; width:20%">
                            @if (($row['saldo']) < 0)
                                (Rp {{ number_format(abs(($row['saldo'])), 2, ',', '.') }})
                            @elseif (($row['saldo']) > 0 || ($row['saldo']) == 0)
                                Rp {{ number_format(($row['saldo']), 2, ',', '.') }}
                            @else
                                -
                            @endif
                        </td>
                        <td>-</td>
                        @else
                        <td>-</td>
                        <td style="@if (($row['saldo']) < 0) color: red; @endif; width:20%">
                            @if (($row['saldo']) < 0)
                                (Rp {{ number_format(abs(($row['saldo'])), 2, ',', '.') }})
                            @elseif (($row['saldo']) > 0 || ($row['saldo']) == 0)
                                Rp {{ number_format(($row['saldo']), 2, ',', '.') }}
                            @else
                                -
                            @endif
                        </td>
                        @endif
                        <td></td>
                     </tr>
                     @php
                     if ($row['lajurSaldo'] == 'debit') {
                        $totalPengeluaranDebit += $row['saldo'];
                     } elseif ($row['lajurSaldo'] == 'kredit'){
                        $totalPengeluaranKredit += $row['saldo'];
                     }
                     $totalPengeluaran += ($totalPengeluaranKredit - $totalPengeluaranDebit);
                    @endphp
                @endforeach
           <tr>
            <td></td>
                <td colspan="1">
                     <strong>Total Pengeluaran</strong>
                </td>
                <td style=" @if ($totalPengeluaranDebit < 0) color: red; @endif">
                    @if ($totalPengeluaranDebit < 0)
                        (Rp {{ number_format(abs($totalPengeluaranDebit), 2, ',', '.') }})
                    @elseif ($totalPengeluaranDebit > 0 || $totalPengeluaranDebit == 0)
                        Rp {{ number_format($totalPengeluaranDebit, 2, ',', '.') }}
                    @else
                        -
                    @endif
                </td>
                <td style=" @if ($totalPengeluaranKredit < 0) color: red; @endif">
                    @if ($totalPengeluaranKredit < 0)
                        (Rp {{ number_format(abs($totalPengeluaranKredit), 2, ',', '.') }})
                    @elseif ($totalPengeluaranKredit > 0 || $totalPengeluaranKredit == 0)
                        Rp {{ number_format($totalPengeluaranKredit, 2, ',', '.') }}
                    @else
                        -
                    @endif
                </td>
                <td style=" @if ($totalPengeluaran < 0) color: red; @endif">
                    @if ($totalPengeluaran < 0)
                        (Rp {{ number_format(abs($totalPengeluaran), 2, ',', '.') }})
                    @elseif ($totalPengeluaran > 0 || $totalPengeluaran == 0)
                        Rp {{ number_format($totalPengeluaran, 2, ',', '.') }}
                    @else
                        -
                    @endif
                </td>
            </tr>
           <tr>
            <td></td>
                <td colspan="3">
                     <strong>Laba / Rugi Kotor</strong>
                </td>
                @php
                $labaRugiKotor = $totalPendapatan + $totalPengeluaran;
                @endphp
                <td style=" @if ($labaRugiKotor < 0) color: red; @endif">
                    @if ($labaRugiKotor < 0)
                        (Rp {{ number_format(abs($labaRugiKotor), 2, ',', '.') }})
                    @elseif ($labaRugiKotor > 0 || $labaRugiKotor == 0)
                        Rp {{ number_format($labaRugiKotor, 2, ',', '.') }}
                    @else
                        -
                    @endif
                </td>
            </tr>
           <tr>
            <td></td>
                <td colspan="4">
                <strong>PENYUSUTAN / AMORTISASI</strong>
                </td>
            </tr>
           @php
           $totalPenyusutanDebit = 0;
           $totalPenyusutanKredit = 0;
           $totalPenyusutan = 0;
           @endphp
                @foreach ($penyusutanAmortisasi as $accountId => $row)
                     <tr>
                          <td style="text-align: center;">{{ $accountId }}</td>
                          <td>{{ $row['name'] }}</td>
                          @if ($row['lajurSaldo'] == 'debit')
                        <td style="@if (($row['saldo']) < 0) color: red; @endif; width:20%">
                            @if (($row['saldo']) < 0)
                                (Rp {{ number_format(abs(($row['saldo'])), 2, ',', '.') }})
                            @elseif (($row['saldo']) > 0 || ($row['saldo']) == 0)
                                Rp {{ number_format(($row['saldo']), 2, ',', '.') }}
                            @else
                                -
                            @endif
                        </td>
                        <td>-</td>
                        @else
                        <td>-</td>
                        <td style="@if (($row['saldo']) < 0) color: red; @endif; width:20%">
                            @if (($row['saldo']) < 0)
                                (Rp {{ number_format(abs(($row['saldo'])), 2, ',', '.') }})
                            @elseif (($row['saldo']) > 0 || ($row['saldo']) == 0)
                                Rp {{ number_format(($row['saldo']), 2, ',', '.') }}
                            @else
                                -
                            @endif
                        </td>
                        @endif
                        <td></td>
                     </tr>
                     @php
                     if ($row['lajurSaldo'] == 'debit') {
                        $totalPenyusutanDebit += $row['saldo'];
                     } elseif ($row['lajurSaldo'] == 'kredit'){
                        $totalPenyusutanKredit += $row['saldo'];
                     }
                     $totalPenyusutan += ($totalPenyusutanKredit - $totalPenyusutanDebit);
                     @endphp
                @endforeach
           <tr>
            <td></td>
                <td colspan="1">
                     <strong>Total Penyusutan dan Amortisasi</strong>
                </td>
                <td style=" @if ($totalPenyusutanDebit < 0) color: red; @endif">
                    @if ($totalPenyusutanDebit < 0)
                        (Rp {{ number_format(abs($totalPenyusutanDebit), 2, ',', '.') }})
                    @elseif ($totalPenyusutanDebit > 0 || $totalPenyusutanDebit == 0)
                        Rp {{ number_format($totalPenyusutanDebit, 2, ',', '.') }}
                    @else
                        -
                    @endif
                </td>
                <td style=" @if ($totalPenyusutanKredit < 0) color: red; @endif">
                    @if ($totalPenyusutanKredit < 0)
                        (Rp {{ number_format(abs($totalPenyusutanKredit), 2, ',', '.') }})
                    @elseif ($totalPenyusutanKredit > 0 || $totalPenyusutanKredit == 0)
                        Rp {{ number_format($totalPenyusutanKredit, 2, ',', '.') }}
                    @else
                        -
                    @endif
                </td>
                <td style=" @if ($totalPenyusutan < 0) color: red; @endif">
                    @if ($totalPenyusutan < 0)
                        (Rp {{ number_format(abs($totalPenyusutan), 2, ',', '.') }})
                    @elseif ($totalPenyusutan > 0 || $totalPenyusutan == 0)
                        Rp {{ number_format($totalPenyusutan, 2, ',', '.') }}
                    @else
                        -
                    @endif
                </td>
            </tr>
           <tr>
            <td></td>
                <td colspan="3">
                     <strong>Ebit</strong>
                </td>
                @php
                $ebit = $labaRugiKotor + $totalPenyusutan;
                @endphp
                <td style=" @if ($ebit < 0) color: red; @endif">
                    @if ($ebit < 0)
                        (Rp {{ number_format(abs($ebit), 2, ',', '.') }})
                    @elseif ($ebit > 0 || $ebit == 0)
                        Rp {{ number_format($ebit, 2, ',', '.') }}
                    @else
                        -
                    @endif
                </td>
            </tr>
           <tr>
            <td></td>
                <td colspan="4">
                <strong>BUNGA / PAJAK</strong>
                </td>
            </tr>
           @php
           $totalBungaPajakDebit = 0;
           $totalBungaPajakKredit = 0;
           $totalBungaPajak = 0;
           @endphp
                @foreach ($bungaPajak as $accountId => $row)
                     <tr>
                          <td style="text-align: center;">{{ $accountId }}</td>
                          <td>{{ $row['name'] }}</td>
                          @if ($row['lajurSaldo'] == 'debit')
                        <td style="@if (($row['saldo']) < 0) color: red; @endif; width:20%">
                            @if (($row['saldo']) < 0)
                                (Rp {{ number_format(abs(($row['saldo'])), 2, ',', '.') }})
                            @elseif (($row['saldo']) > 0 || ($row['saldo']) == 0)
                                Rp {{ number_format(($row['saldo']), 2, ',', '.') }}
                            @else
                                -
                            @endif
                        </td>
                        <td>-</td>
                        @else
                        <td>-</td>
                        <td style="@if (($row['saldo']) < 0) color: red; @endif; width:20%">
                            @if (($row['saldo']) < 0)
                                (Rp {{ number_format(abs(($row['saldo'])), 2, ',', '.') }})
                            @elseif (($row['saldo']) > 0 || ($row['saldo']) == 0)
                                Rp {{ number_format(($row['saldo']), 2, ',', '.') }}
                            @else
                                -
                            @endif
                        </td>
                        @endif
                        <td></td>
                     </tr>
                     @php
                     if ($row['lajurSaldo'] == 'debit') {
                        $totalBungaPajakDebit += $row['saldo'];
                     } elseif ($row['lajurSaldo'] == 'kredit'){
                        $totalBungaPajakKredit += $row['saldo'];
                     }
                     $totalBungaPajak += ($totalBungaPajakKredit - $totalBungaPajakDebit);
                     @endphp
                @endforeach
           <tr>
            <td></td>
                <td colspan="1">
                     <strong>Total Bunga / Pajak</strong>
                </td>
                <td style=" @if ($totalBungaPajakDebit < 0) color: red; @endif">
                    @if ($totalBungaPajakDebit < 0)
                        (Rp {{ number_format(abs($totalBungaPajakDebit), 2, ',', '.') }})
                    @elseif ($totalBungaPajakDebit > 0 || $totalBungaPajakDebit == 0)
                        Rp {{ number_format($totalBungaPajakDebit, 2, ',', '.') }}
                    @else
                        -
                    @endif
                </td>
                <td style=" @if ($totalBungaPajakKredit < 0) color: red; @endif">
                    @if ($totalBungaPajakKredit < 0)
                        (Rp {{ number_format(abs($totalBungaPajakKredit), 2, ',', '.') }})
                    @elseif ($totalBungaPajakKredit > 0 || $totalBungaPajakKredit == 0)
                        Rp {{ number_format($totalBungaPajakKredit, 2, ',', '.') }}
                    @else
                        -
                    @endif
                </td>
                <td style=" @if ($totalBungaPajak < 0) color: red; @endif">
                    @if ($totalBungaPajak < 0)
                        (Rp {{ number_format(abs($totalBungaPajak), 2, ',', '.') }})
                    @elseif ($totalBungaPajak > 0 || $totalBungaPajak == 0)
                        Rp {{ number_format($totalBungaPajak, 2, ',', '.') }}
                    @else
                        -
                    @endif
                </td>
            </tr>
           <tr>
            <td></td>
                <td colspan="3">
                     <strong>Laba / Rugi Kotor</strong>
                </td>
                @php
                $labaRugiKotor2 = $ebit + $totalBungaPajak;
                @endphp
                <td style=" @if ($labaRugiKotor2 < 0) color: red; @endif">
                    @if ($labaRugiKotor2 < 0)
                        (Rp {{ number_format(abs($labaRugiKotor2), 2, ',', '.') }})
                    @elseif ($labaRugiKotor2 > 0 || $labaRugiKotor2 == 0)
                        Rp {{ number_format($labaRugiKotor2, 2, ',', '.') }}
                    @else
                        -
                    @endif
                </td>
            </tr>
           <tr>
            <td></td>
                <td colspan="4">
                <strong>PENDAPATAN / PENGELUARAN LAIN-LAIN</strong>
                </td>
            </tr>
           @php
           $totalPendapatanPengeluaranLainDebit = 0;
           $totalPendapatanPengeluaranLainKredit = 0;
           $totalPendapatanPengeluaranLain = 0;
           @endphp
                @foreach ($pendapatanPengeluaranLain as $accountId => $row)
                     <tr>
                          <td style="text-align: center;">{{ $accountId }}</td>
                          <td>{{ $row['name'] }}</td>
                          @if ($row['lajurSaldo'] == 'debit')
                        <td style="@if (($row['saldo']) < 0) color: red; @endif; width:20%">
                            @if (($row['saldo']) < 0)
                                (Rp {{ number_format(abs(($row['saldo'])), 2, ',', '.') }})
                            @elseif (($row['saldo']) > 0 || ($row['saldo']) == 0)
                                Rp {{ number_format(($row['saldo']), 2, ',', '.') }}
                            @else
                                -
                            @endif
                        </td>
                        <td>-</td>
                        @else
                        <td>-</td>
                        <td style="@if (($row['saldo']) < 0) color: red; @endif; width:20%">
                            @if (($row['saldo']) < 0)
                                (Rp {{ number_format(abs(($row['saldo'])), 2, ',', '.') }})
                            @elseif (($row['saldo']) > 0 || ($row['saldo']) == 0)
                                Rp {{ number_format(($row['saldo']), 2, ',', '.') }}
                            @else
                                -
                            @endif
                        </td>
                        @endif
                        <td></td>
                     </tr>
                     @php
                     if ($row['lajurSaldo'] == 'debit') {
                        $totalPendapatanPengeluaranLainDebit += $row['saldo'];
                     } elseif ($row['lajurSaldo'] == 'kredit'){
                        $totalPendapatanPengeluaranLainKredit += $row['saldo'];
                     }
                     $totalPendapatanPengeluaranLain += ($totalPendapatanPengeluaranLainKredit - $totalPendapatanPengeluaranLainDebit);
                     @endphp
                @endforeach
           <tr>
            <td></td>
                <td colspan="1">
                     <strong>Total Pendapatan / Pengeluaran Lain</strong>
                </td>
                <td style=" @if ($totalPendapatanPengeluaranLainDebit < 0) color: red; @endif">
                    @if ($totalPendapatanPengeluaranLainDebit < 0)
                        (Rp {{ number_format(abs($totalPendapatanPengeluaranLainDebit), 2, ',', '.') }})
                    @elseif ($totalPendapatanPengeluaranLainDebit > 0 || $totalPendapatanPengeluaranLainDebit == 0)
                        Rp {{ number_format($totalPendapatanPengeluaranLainDebit, 2, ',', '.') }}
                    @else
                        -
                    @endif
                </td>
                <td style=" @if ($totalPendapatanPengeluaranLainKredit < 0) color: red; @endif">
                    @if ($totalPendapatanPengeluaranLainKredit < 0)
                        (Rp {{ number_format(abs($totalPendapatanPengeluaranLainKredit), 2, ',', '.') }})
                    @elseif ($totalPendapatanPengeluaranLainKredit > 0 || $totalPendapatanPengeluaranLainKredit == 0)
                        Rp {{ number_format($totalPendapatanPengeluaranLainKredit, 2, ',', '.') }}
                    @else
                        -
                    @endif
                </td>
                <td style=" @if ($totalPendapatanPengeluaranLain < 0) color: red; @endif">
                    @if ($totalPendapatanPengeluaranLain < 0)
                        (Rp {{ number_format(abs($totalPendapatanPengeluaranLain), 2, ',', '.') }})
                    @elseif ($totalPendapatanPengeluaranLain > 0 || $totalPendapatanPengeluaranLain == 0)
                        Rp {{ number_format($totalPendapatanPengeluaranLain, 2, ',', '.') }}
                    @else
                        -
                    @endif
                </td>
            </tr>
           <tr>
            <td></td>
                <td colspan="3">
                     <strong>LABA / RUGI BERSIH</strong>
                </td>
                @php
                $labaRugiBersih = $labaRugiKotor2 + $totalPendapatanPengeluaranLain;
                @endphp
                <td style=" @if ($labaRugiBersih < 0) color: red; @endif">
                    @if ($labaRugiBersih < 0)
                        (Rp {{ number_format(abs($labaRugiBersih), 2, ',', '.') }})
                    @elseif ($labaRugiBersih > 0 || $labaRugiBersih == 0)
                        Rp {{ number_format($labaRugiBersih, 2, ',', '.') }}
                    @else
                        -
                    @endif
                </td>
            </tr>
            </tbody>
          </table>
     </div>
    </div>
</x-app-layout>
