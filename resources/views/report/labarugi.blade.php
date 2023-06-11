<x-app-layout>
    <x-slot name="title">
      Laba Rugi
    </x-slot>
    <div class="card">
        <div class="card-header">
            <div class="d-flex">
                <form class="form-inline" action="{{ route('labarugi.index') }}" method="GET">
                    <input type="text" class="form-control mb-2 mr-sm-2" id="datepicker" name="datepicker" placeholder="Pilih Bulan" readonly>
                    <button type="submit" class="btn btn-primary mb-2">Cari</button>
                </form>

                <button onclick="window.open('{{ url('labarugi/export') }}?datepicker={{ $datepicker }}', '_blank')" class="btn btn-sm btn-primary ml-auto p-2">Export PDF</button>
            </div>
       </div>
         <div class="card-body">
            <h5>Periode : {{ !empty($datepicker) ? $datepicker : '-' }}</h5>
            <table class="table table-striped ">
               <thead class="table-dark">
                    <tr>
                         <td>ID Akun</td>
                         <td>Nama Akun</td>
                         <td>Debet</td>
                         <td>Kredit</td>
                         <td>Saldo</td>
                    </tr>
               </thead>
               <tbody>
                    <tr>
                        <td colspan="5">
                            <strong>Pendapatan</strong>
                        </td>
                    </tr>
               @php
               $totalPendapatan = 0;
               @endphp
                    @foreach ($dataA as $row)
                         <tr>
                              <td>{{ $row->id }}</td>
                              <td>{{ $row->name }}</td>
                              <td>{{ 'Rp ' . number_format($row->ammount_debit, 2, ',', '.') }}</td>
                              <td>{{ 'Rp ' . number_format($row->ammount_kredit, 2, ',', '.') }}</td>
                              @php
                               $totalPendapatan = $row->ammount_debit + $row->ammount_kredit;
                                @endphp
                                <td>
                                    @if ($totalPendapatan < 0)
                                        (Rp {{ number_format(abs($totalPendapatan), 2, ',', '.') }})
                                    @elseif ($totalPendapatan > 0)
                                        Rp {{ number_format($totalPendapatan, 2, ',', '.') }}
                                    @else
                                        -
                                    @endif
                                </td>
                         </tr>
                    @endforeach
               <tr>
                    <td colspan="4">
                         <strong>Total Pendapatan</strong>
                    </td>
                    <td>
                        @if ($totalPendapatan < 0)
                            (Rp {{ number_format(abs($totalPendapatan), 2, ',', '.') }})
                        @elseif ($totalPendapatan > 0)
                            Rp {{ number_format($totalPendapatan, 2, ',', '.') }}
                        @else
                            -
                        @endif
                    </td>
                </tr>

               <tr>
                    <td colspan="5">
                    <strong>Pengeluaran</strong>
                    </td>
                </tr>
               @php
               $totalPengeluaran = 0;
               @endphp
                    @foreach ($dataB as $row)
                         <tr>
                              <td>{{ $row->id }}</td>
                              <td>{{ $row->name }}</td>
                              <td>{{ 'Rp ' . number_format($row->ammount_debit, 2, ',', '.') }}</td>
                              <td>{{ 'Rp ' . number_format($row->ammount_kredit, 2, ',', '.') }}</td>
                              @php
                               $totalPengeluaran = $row->ammount_debit + $row->ammount_kredit;
                                @endphp
                                <td>
                                    @if ($totalPengeluaran < 0)
                                        (Rp {{ number_format(abs($totalPengeluaran), 2, ',', '.') }})
                                    @elseif ($totalPengeluaran > 0)
                                        Rp {{ number_format($totalPengeluaran, 2, ',', '.') }}
                                    @else
                                        -
                                    @endif
                                </td>
                         </tr>
                    @endforeach
               <tr>
                    <td colspan="4">
                         <strong>Total Pengeluaran</strong>
                    </td>
                    <td>
                        @if ($totalPengeluaran < 0)
                            (Rp {{ number_format(abs($totalPengeluaran), 2, ',', '.') }})
                        @elseif ($totalPengeluaran > 0)
                            Rp {{ number_format($totalPengeluaran, 2, ',', '.') }}
                        @else
                            -
                        @endif
                    </td>
                </tr>
               <tr>
                    <td colspan="4">
                         <strong>Laba / Rugi Kotor</strong>
                    </td>
                    @php
                    $labaRugiKotor = $totalPendapatan + $totalPengeluaran;
                    @endphp
                    <td>
                        @if ($labaRugiKotor < 0)
                            (Rp {{ number_format(abs($labaRugiKotor), 2, ',', '.') }})
                        @elseif ($labaRugiKotor > 0)
                            Rp {{ number_format($labaRugiKotor, 2, ',', '.') }}
                        @else
                            -
                        @endif
                    </td>
                </tr>
               <tr>
                    <td colspan="5">
                    <strong>Penyusutan / Amortisasi</strong>
                    </td>
                </tr>
               @php
               $totalPenyusutan = 0;
               @endphp
                    @foreach ($dataC as $row)
                         <tr>
                              <td>{{ $row->id }}</td>
                              <td>{{ $row->name }}</td>
                              <td>{{ 'Rp ' . number_format($row->ammount_debit, 2, ',', '.') }}</td>
                              <td>{{ 'Rp ' . number_format($row->ammount_kredit, 2, ',', '.') }}</td>
                              @php
                                $totalPenyusutan = $row->ammount_debit + $row->ammount_kredit;
                                @endphp
                                <td>
                                    @if ($totalPenyusutan < 0)
                                        (Rp {{ number_format(abs($totalPenyusutan), 2, ',', '.') }})
                                    @elseif ($totalPenyusutan > 0)
                                        Rp {{ number_format($totalPenyusutan, 2, ',', '.') }}
                                    @else
                                        -
                                    @endif
                                </td>
                         </tr>
                    @endforeach
               <tr>
                    <td colspan="4">
                         <strong>Total Penyusutan dan Amortisasi</strong>
                    </td>
                    <td>
                        @if ($totalPenyusutan < 0)
                            (Rp {{ number_format(abs($totalPenyusutan), 2, ',', '.') }})
                        @elseif ($totalPenyusutan > 0)
                            Rp {{ number_format($totalPenyusutan, 2, ',', '.') }}
                        @else
                            -
                        @endif
                    </td>
                </tr>
               <tr>
                    <td colspan="4">
                         <strong>Ebit</strong>
                    </td>
                    @php
                    $ebit = $labaRugiKotor + $totalPenyusutan;
                    @endphp
                    <td>
                        @if ($ebit < 0)
                            (Rp {{ number_format(abs($ebit), 2, ',', '.') }})
                        @elseif ($ebit > 0)
                            Rp {{ number_format($ebit, 2, ',', '.') }}
                        @else
                            -
                        @endif
                    </td>
                </tr>
               <tr>
                    <td colspan="5">
                    <strong>Bunga / Pajak</strong>
                    </td>
                </tr>
               @php
               $totalBungaPajak = 0;
               @endphp
                    @foreach ($dataD as $row)
                         <tr>
                              <td>{{ $row->id }}</td>
                              <td>{{ $row->name }}</td>
                              <td>{{ 'Rp ' . number_format($row->ammount_debit, 2, ',', '.') }}</td>
                              <td>{{ 'Rp ' . number_format($row->ammount_kredit, 2, ',', '.') }}</td>
                              @php
                               $totalBungaPajak = $row->ammount_debit + $row->ammount_kredit;
                                @endphp
                                <td>
                                    @if ($totalBungaPajak < 0)
                                        (Rp {{ number_format(abs($totalBungaPajak), 2, ',', '.') }})
                                    @elseif ($totalBungaPajak > 0)
                                        Rp {{ number_format($totalBungaPajak, 2, ',', '.') }}
                                    @else
                                        -
                                    @endif
                                </td>
                         </tr>
                    @endforeach
               <tr>
                    <td colspan="4">
                         <strong>Total Pembelian Aset</strong>
                    </td>
                    <td>
                        @if ($totalBungaPajak < 0)
                            (Rp {{ number_format(abs($totalBungaPajak), 2, ',', '.') }})
                        @elseif ($totalBungaPajak > 0)
                            Rp {{ number_format($totalBungaPajak, 2, ',', '.') }}
                        @else
                            -
                        @endif
                    </td>
                </tr>
               <tr>
                    <td colspan="4">
                         <strong>Laba / Rugi Kotor</strong>
                    </td>
                    @php
                    $labaRugiKotor2 = $ebit + $totalBungaPajak;
                    @endphp
                    <td>
                        @if ($labaRugiKotor2 < 0)
                            (Rp {{ number_format(abs($labaRugiKotor2), 2, ',', '.') }})
                        @elseif ($labaRugiKotor2 > 0)
                            Rp {{ number_format($labaRugiKotor2, 2, ',', '.') }}
                        @else
                            -
                        @endif
                    </td>
                </tr>
               <tr>
                    <td colspan="5">
                    <strong>Pendapatan / Pengeluaran Lain-Lain</strong>
                    </td>
                </tr>
               @php
               $totalPendapatanPengeluaranLain = 0;
               @endphp
                    @foreach ($dataE as $row)
                         <tr>
                              <td>{{ $row->id }}</td>
                              <td>{{ $row->name }}</td>
                              <td>{{ 'Rp ' . number_format($row->ammount_debit, 2, ',', '.') }}</td>
                              <td>{{ 'Rp ' . number_format($row->ammount_kredit, 2, ',', '.') }}</td>
                              @php
                               $totalPendapatanPengeluaranLain = $row->ammount_debit + $row->ammount_kredit;
                                @endphp
                                <td>
                                    @if ($totalPendapatanPengeluaranLain < 0)
                                        (Rp {{ number_format(abs($totalPendapatanPengeluaranLain), 2, ',', '.') }})
                                    @elseif ($totalPendapatanPengeluaranLain > 0)
                                        Rp {{ number_format($totalPendapatanPengeluaranLain, 2, ',', '.') }}
                                    @else
                                        -
                                    @endif
                                </td>
                         </tr>
                    @endforeach
               <tr>
                    <td colspan="4">
                         <strong>Total Pendapatan / Pengeluaran Lain</strong>
                    </td>
                    <td>
                        @if ($totalPendapatanPengeluaranLain < 0)
                            (Rp {{ number_format(abs($totalPendapatanPengeluaranLain), 2, ',', '.') }})
                        @elseif ($totalPendapatanPengeluaranLain > 0)
                            Rp {{ number_format($totalPendapatanPengeluaranLain, 2, ',', '.') }}
                        @else
                            -
                        @endif
                    </td>
                </tr>
               <tr>
                    <td colspan="4">
                         <strong>Laba / Rugi Bersih</strong>
                    </td>
                    @php
                    $labaRugiBersih = $labaRugiKotor2 + $totalPendapatanPengeluaranLain;
                    @endphp
                    <td>
                        @if ($labaRugiBersih < 0)
                            (Rp {{ number_format(abs($labaRugiBersih), 2, ',', '.') }})
                        @elseif ($labaRugiBersih > 0)
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
