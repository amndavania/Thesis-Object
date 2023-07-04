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
                         <td style="text-align: right;">Saldo</td>
                    </tr>
               </thead>
               <tbody>
                <tr>
                    <td></td>
                    <td colspan="2">
                        <strong>PENDAPATAN</strong>
                    </td>
                </tr>
           @php
           $totalPendapatan = 0;
           @endphp
                @foreach ($pendapatan as $accountId => $row)
                     <tr>
                          <td style="text-align: center;">{{ $accountId }}</td>
                          <td>{{ $row['name'] }}</td>
                            <td style="text-align: right; @if ($row['saldo'] < 0) color: red; @endif">
                                @if ($row['saldo'] < 0)
                                    (Rp {{ number_format(abs($row['saldo']), 2, ',', '.') }})
                                @elseif ($row['saldo'] > 0 || $row['saldo'] == 0)
                                    Rp {{ number_format($row['saldo'], 2, ',', '.') }}
                                @else
                                    -
                                @endif
                            </td>
                     </tr>
                     @php
                          $totalPendapatan += $row['saldo'];
                    @endphp
                @endforeach
           <tr>
            <td></td>
                <td colspan="1">
                     <strong>Total Pendapatan</strong>
                </td>
                <td style="text-align: right; @if ($totalPendapatan < 0) color: red; @endif">
                    @if ($totalPendapatan < 0)
                        (Rp {{ number_format(abs($totalPendapatan), 2, ',', '.') }})
                    @elseif ($totalPendapatan > 0 || $totalPendapatan == 0)
                        Rp {{ number_format($totalPendapatan, 2, ',', '.') }}
                    @else
                        -
                    @endif
                </td>
            </tr>

           <tr>
            <td></td>
                <td colspan="2">
                <strong>PENGELUARAN</strong>
                </td>
            </tr>
           @php
           $totalPengeluaran = 0;
           @endphp
                @foreach ($pengeluaran as $accountId => $row)
                     <tr>
                          <td style="text-align: center;">{{ $accountId }}</td>
                          <td>{{ $row['name'] }}</td>
                            <td style="text-align: right; @if ($row['saldo'] < 0) color: red; @endif">
                                @if ($row['saldo'] < 0)
                                    (Rp {{ number_format(abs($row['saldo']), 2, ',', '.') }})
                                @elseif ($row['saldo'] > 0 || $row['saldo'] == 0)
                                    Rp {{ number_format($row['saldo'], 2, ',', '.') }}
                                @else
                                    -
                                @endif
                            </td>
                     </tr>
                     @php
                          $totalPengeluaran += $row['saldo'];
                    @endphp
                @endforeach
           <tr>
            <td></td>
                <td colspan="1">
                     <strong>Total Pengeluaran</strong>
                </td>
                <td style="text-align: right; @if ($totalPengeluaran < 0) color: red; @endif">
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
                <td colspan="1">
                     <strong>Laba / Rugi Kotor</strong>
                </td>
                @php
                $labaRugiKotor = $totalPendapatan + $totalPengeluaran;
                @endphp
                <td style="text-align: right; @if ($labaRugiKotor < 0) color: red; @endif">
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
                <td colspan="2">
                <strong>PENYUSUTAN / AMORTISASI</strong>
                </td>
            </tr>
           @php
           $totalPenyusutan = 0;
           @endphp
                @foreach ($penyusutanAmortisasi as $accountId => $row)
                     <tr>
                          <td style="text-align: center;">{{ $accountId }}</td>
                          <td>{{ $row['name'] }}</td>
                            <td style="text-align: right; @if ($row['saldo'] < 0) color: red; @endif">
                                @if ($row['saldo'] < 0)
                                    (Rp {{ number_format(abs($row['saldo']), 2, ',', '.') }})
                                @elseif ($row['saldo'] > 0 || $row['saldo'] == 0)
                                    Rp {{ number_format($row['saldo'], 2, ',', '.') }}
                                @else
                                    -
                                @endif
                            </td>
                     </tr>
                     @php
                     $totalPenyusutan += $row['saldo'];
                     @endphp
                @endforeach
           <tr>
            <td></td>
                <td colspan="1">
                     <strong>Total Penyusutan dan Amortisasi</strong>
                </td>
                <td style="text-align: right; @if ($totalPenyusutan < 0) color: red; @endif">
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
                <td colspan="1">
                     <strong>Ebit</strong>
                </td>
                @php
                $ebit = $labaRugiKotor + $totalPenyusutan;
                @endphp
                <td style="text-align: right; @if ($ebit < 0) color: red; @endif">
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
                <td colspan="2">
                <strong>BUNGA / PAJAK</strong>
                </td>
            </tr>
           @php
           $totalBungaPajak = 0;
           @endphp
                @foreach ($bungaPajak as $accountId => $row)
                     <tr>
                          <td style="text-align: center;">{{ $accountId }}</td>
                          <td>{{ $row['name'] }}</td>
                            <td style="text-align: right; @if ($row['saldo'] < 0) color: red; @endif">
                                @if ($row['saldo'] < 0)
                                    (Rp {{ number_format(abs($row['saldo']), 2, ',', '.') }})
                                @elseif ($row['saldo'] > 0 || $row['saldo'] == 0)
                                    Rp {{ number_format($totalBungaPajak, 2, ',', '.') }}
                                @else
                                    -
                                @endif
                            </td>
                     </tr>
                     @php
                     $totalBungaPajak += $row['saldo'];
                     @endphp
                @endforeach
           <tr>
            <td></td>
                <td colspan="1">
                     <strong>Total Pembelian Aset</strong>
                </td>
                <td style="text-align: right; @if ($totalBungaPajak < 0) color: red; @endif">
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
                <td colspan="1">
                     <strong>Laba / Rugi Kotor</strong>
                </td>
                @php
                $labaRugiKotor2 = $ebit + $totalBungaPajak;
                @endphp
                <td style="text-align: right; @if ($labaRugiKotor2 < 0) color: red; @endif">
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
                <td colspan="2">
                <strong>PENDAPATAN / PENGELUARAN LAIN-LAIN</strong>
                </td>
            </tr>
           @php
           $totalPendapatanPengeluaranLain = 0;
           @endphp
                @foreach ($pendapatanPengeluaranLain as $accountId => $row)
                     <tr>
                          <td style="text-align: center;">{{ $accountId }}</td>
                          <td>{{ $row['name'] }}</td>
                            <td style="text-align: right; @if ($row['saldo'] < 0) color: red; @endif">
                                @if ($row['saldo'] < 0)
                                    (Rp {{ number_format(abs($row['saldo']), 2, ',', '.') }})
                                @elseif ($row['saldo'] > 0 || $row['saldo'] == 0)
                                    Rp {{ number_format($row['saldo'], 2, ',', '.') }}
                                @else
                                    -
                                @endif
                            </td>
                     </tr>
                     @php
                     $totalPendapatanPengeluaranLain += $row['saldo'];
                     @endphp
                @endforeach
           <tr>
            <td></td>
                <td colspan="1">
                     <strong>Total Pendapatan / Pengeluaran Lain</strong>
                </td>
                <td style="text-align: right; @if ($totalPendapatanPengeluaranLain < 0) color: red; @endif">
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
                <td colspan="1">
                     <strong>LABA / RUGI BERSIH</strong>
                </td>
                @php
                $labaRugiBersih = $labaRugiKotor2 + $totalPendapatanPengeluaranLain;
                @endphp
                <td style="text-align: right; @if ($labaRugiBersih < 0) color: red; @endif">
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
