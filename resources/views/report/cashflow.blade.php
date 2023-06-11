<x-app-layout>
    <x-slot name="title">
      Cash Flow
    </x-slot>
    <div class="card">
        <div class="card-header">
            <div class="d-flex">
                <form class="form-inline" action="{{ route('cashflow.index') }}" method="GET">
                    <input type="text" class="form-control mb-2 mr-sm-2" id="datepicker" name="datepicker" placeholder="Pilih Bulan" readonly>
                    <button type="submit" class="btn btn-primary mb-2">Cari</button>
                </form>
                <button onclick="window.open('{{ url('cashflow/export') }}?datepicker={{ $datepicker }}', '_blank')" class="btn btn-sm btn-primary ml-auto p-2">Export PDF</button>
            </div>
       </div>
         <div class="card-body">
            <h5>Periode : {{ !empty($datepicker) ? $datepicker : '-' }}</h5>
          <table class="table table-striped ">
               <thead class="table-dark">
                    <tr>
                         <td>ID Akun</td>
                         <td>Nama Akun</td>
                         <td>Saldo</td>
                         <td>Total</td>
                    </tr>
               </thead>
               <tbody>
               <tr>
                    <td colspan="4">
                         <strong>Aktivitas Operasi</strong>
                    </td>
                </tr>
               <tr>
                    <td colspan="4">
                         <strong>Arus Kas Masuk</strong>
                    </td>
                </tr>
               @php
               $totalArusKasMasuk = 0;
               @endphp
                    @foreach ($dataA as $row)
                         <tr>
                              <td>{{ $row->id }}</td>
                              <td>{{ $row->name }}</td>
                              @php
                              $saldo = $row->ammount_debit - $row->ammount_kredit;
                                @endphp
                                <td>
                                    @if ($saldo < 0)
                                        (Rp {{ number_format(abs($saldo), 2, ',', '.') }})
                                    @elseif ($saldo > 0)
                                        Rp {{ number_format($saldo, 2, ',', '.') }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td></td>
                         </tr>
                         @php
                         $totalArusKasMasuk += $row->ammount_debit - $row->ammount_kredit;
                         @endphp
                    @endforeach
               <tr>
                    <td colspan="3">
                         <strong>Total Arus Kas Masuk</strong>
                    </td>
                    <td>
                        @if ($totalArusKasMasuk < 0)
                            (Rp {{ number_format(abs($totalArusKasMasuk), 2, ',', '.') }})
                        @elseif ($totalArusKasMasuk > 0)
                            Rp {{ number_format($totalArusKasMasuk, 2, ',', '.') }}
                        @else
                            -
                        @endif
                    </td>
                </tr>
               <tr>
                    <td colspan="4">
                    <strong>Arus Kas Keluar</strong>
                    </td>
                </tr>
               @php
               $totalArusKasKeluar = 0;
               @endphp
                    @foreach ($dataB as $row)
                         <tr>
                              <td>{{ $row->id }}</td>
                              <td>{{ $row->name }}</td>
                              @php
                              $saldo = $row->ammount_debit - $row->ammount_kredit;
                                @endphp
                                <td>
                                    @if ($saldo < 0)
                                        (Rp {{ number_format(abs($saldo), 2, ',', '.') }})
                                    @elseif ($saldo > 0)
                                        Rp {{ number_format($saldo, 2, ',', '.') }}
                                    @else
                                        -
                                    @endif
                                </td>
                              <td></td>
                         </tr>
                         @php
                         $totalArusKasKeluar += $row->ammount_debit - $row->ammount_kredit;
                         @endphp
                    @endforeach
               <tr>
                    <td colspan="3">
                         <strong>Total Arus Kas Keluar</strong>
                    </td>
                    <td>
                        @if ($totalArusKasKeluar < 0)
                            (Rp {{ number_format(abs($totalArusKasKeluar), 2, ',', '.') }})
                        @elseif ($totalArusKasKeluar > 0)
                            Rp {{ number_format($totalArusKasKeluar, 2, ',', '.') }}
                        @else
                            -
                        @endif
                    </td>
                </tr>
               <tr>
                    <td colspan="3">
                    <strong>Arus Kas Dari Aktivitas Operasi</strong>
                    </td>
                    @php
                         $totalArusKasAktivitasOperasi = $totalArusKasMasuk - $totalArusKasKeluar;
                    @endphp
                    <td>
                        @if ($totalArusKasAktivitasOperasi < 0)
                            (Rp {{ number_format(abs($totalArusKasAktivitasOperasi), 2, ',', '.') }})
                        @elseif ($totalArusKasAktivitasOperasi > 0)
                            Rp {{ number_format($totalArusKasAktivitasOperasi, 2, ',', '.') }}
                        @else
                            -
                        @endif
                    </td>
                </tr>
               <tr>
                    <td colspan="4">
                    <strong>Aktivitas Investasi</strong>
                    </td>
                </tr>
               <tr>
                    <td colspan="4">
                    <strong>Penjualan Aset</strong>
                    </td>
                </tr>
               @php
               $totalPenjualanAset = 0;
               @endphp
                    @foreach ($dataC as $row)
                         <tr>
                              <td>{{ $row->id }}</td>
                              <td>{{ $row->name }}</td>
                              @php
                              $saldo = $row->ammount_debit - $row->ammount_kredit;
                                @endphp
                                <td>
                                    @if ($saldo < 0)
                                        (Rp {{ number_format(abs($saldo), 2, ',', '.') }})
                                    @elseif ($saldo > 0)
                                        Rp {{ number_format($saldo, 2, ',', '.') }}
                                    @else
                                        -
                                    @endif
                                </td>
                              <td></td>
                         </tr>
                         @php
                         $totalPenjualanAset += $row->ammount_debit - $row->ammount_kredit;
                         @endphp
                    @endforeach
               <tr>
                    <td colspan="3">
                         <strong>Total Penjualan Aset</strong>
                    </td>
                    <td>
                        @if ($totalPenjualanAset < 0)
                            (Rp {{ number_format(abs($totalPenjualanAset), 2, ',', '.') }})
                        @elseif ($totalPenjualanAset > 0)
                            Rp {{ number_format($totalPenjualanAset, 2, ',', '.') }}
                        @else
                            -
                        @endif
                    </td>
                </tr>
               <tr>
                    <td colspan="4">
                    <strong>Pembelian Aset</strong>
                    </td>
                </tr>
               @php
               $totalPembelianAset = 0;
               @endphp
                    @foreach ($dataD as $row)
                         <tr>
                              <td>{{ $row->id }}</td>
                              <td>{{ $row->name }}</td>
                              @php
                              $saldo = $row->ammount_debit - $row->ammount_kredit;
                                @endphp
                                <td>
                                    @if ($saldo < 0)
                                        (Rp {{ number_format(abs($saldo), 2, ',', '.') }})
                                    @elseif ($saldo > 0)
                                        Rp {{ number_format($saldo, 2, ',', '.') }}
                                    @else
                                        -
                                    @endif
                                </td>
                              <td></td>
                         </tr>
                         @php
                         $totalPembelianAset += $row->ammount_debit - $row->ammount_kredit;
                         @endphp
                    @endforeach
               <tr>
                    <td colspan="3">
                         <strong>Total Pembelian Aset</strong>
                    </td>
                    <td>
                        @if ($totalPembelianAset < 0)
                            (Rp {{ number_format(abs($totalPembelianAset), 2, ',', '.') }})
                        @elseif ($totalPembelianAset > 0)
                            Rp {{ number_format($totalPembelianAset, 2, ',', '.') }}
                        @else
                            -
                        @endif
                    </td>
                </tr>
               <tr>
                    <td colspan="3">
                    <strong>Arus Kas Dari Aktivitas Investasi</strong>
                    </td>
                    @php
                         $totalArusKasAktivitasInvestasi = $totalPenjualanAset - $totalPembelianAset;
                    @endphp
                    <td>
                        @if ($totalArusKasAktivitasInvestasi < 0)
                            (Rp {{ number_format(abs($totalArusKasAktivitasInvestasi), 2, ',', '.') }})
                        @elseif ($totalArusKasAktivitasInvestasi > 0)
                            Rp {{ number_format($totalArusKasAktivitasInvestasi, 2, ',', '.') }}
                        @else
                            -
                        @endif
                    </td>
                </tr>
               <tr>
                    <td colspan="4">
                    <strong>Aktivitas Pendanaan</strong>
                    </td>
                </tr>
               <tr>
                    <td colspan="4">
                    <strong>Penambahan Dana</strong>
                    </td>
                </tr>
               @php
               $totalPenambahanDana = 0;
               @endphp
                    @foreach ($dataE as $row)
                         <tr>
                              <td>{{ $row->id }}</td>
                              <td>{{ $row->name }}</td>
                              @php
                              $saldo = $row->ammount_debit - $row->ammount_kredit;
                                @endphp
                                <td>
                                    @if ($saldo < 0)
                                        (Rp {{ number_format(abs($saldo), 2, ',', '.') }})
                                    @elseif ($saldo > 0)
                                        Rp {{ number_format($saldo, 2, ',', '.') }}
                                    @else
                                        -
                                    @endif
                                </td>
                              <td></td>
                         </tr>
                         @php
                         $totalPenambahanDana += $row->ammount_debit - $row->ammount_kredit;
                         @endphp
                    @endforeach
               <tr>
                    <td colspan="3">
                         <strong>Total Penambahan Dana</strong>
                    </td>
                    <td>
                        @if ($totalPenambahanDana < 0)
                            (Rp {{ number_format(abs($totalPenambahanDana), 2, ',', '.') }})
                        @elseif ($totalPenambahanDana > 0)
                            Rp {{ number_format($totalPenambahanDana, 2, ',', '.') }}
                        @else
                            -
                        @endif
                    </td>
                </tr>
               <tr>
                    <td colspan="4">
                    <strong>Pengurangan Dana</strong>
                    </td>
                </tr>
               @php
               $totalPenguranganDana = 0;
               @endphp
                    @foreach ($dataF as $row)
                         <tr>
                              <td>{{ $row->id }}</td>
                              <td>{{ $row->name }}</td>
                              @php
                              $saldo = $row->ammount_debit - $row->ammount_kredit;
                                @endphp
                                <td>
                                    @if ($saldo < 0)
                                        (Rp {{ number_format(abs($saldo), 2, ',', '.') }})
                                    @elseif ($saldo > 0)
                                        Rp {{ number_format($saldo, 2, ',', '.') }}
                                    @else
                                        -
                                    @endif
                                </td>
                              <td></td>
                         </tr>
                         @php
                         $totalPenguranganDana += $row->ammount_debit - $row->ammount_kredit;
                         @endphp
                    @endforeach
               <tr>
                    <td colspan="3">
                         <strong>Total Pengurangan Dana</strong>
                    </td>
                    <td>
                        @if ($totalPenguranganDana < 0)
                            (Rp {{ number_format(abs($totalPenguranganDana), 2, ',', '.') }})
                        @elseif ($totalPenguranganDana > 0)
                            Rp {{ number_format($totalPenguranganDana, 2, ',', '.') }}
                        @else
                            -
                        @endif
                    </td>
                </tr>
               <tr>
                    <td colspan="3">
                         <strong>Arus Kas Dari Aktivitas Pendanaan</strong>
                    </td>
                    @php
                         $totalArusKasAktivitasPendanaan = $totalPenambahanDana - $totalPenguranganDana;
                    @endphp
                    <td>
                        @if ($totalArusKasAktivitasPendanaan < 0)
                            (Rp {{ number_format(abs($totalArusKasAktivitasPendanaan), 2, ',', '.') }})
                        @elseif ($totalArusKasAktivitasPendanaan > 0)
                            Rp {{ number_format($totalArusKasAktivitasPendanaan, 2, ',', '.') }}
                        @else
                            -
                        @endif
                    </td>
                </tr>
               <tr>
                    <td colspan="3">
                         <strong>Kenaikan / Penurunan Kas</strong>
                    </td>
                    @php
                         $totalKenaikanPenurunanKas = $totalArusKasAktivitasOperasi + $totalArusKasAktivitasInvestasi + $totalArusKasAktivitasPendanaan;
                    @endphp
                    <td>
                        @if ($totalKenaikanPenurunanKas < 0)
                            (Rp {{ number_format(abs($totalKenaikanPenurunanKas), 2, ',', '.') }})
                        @elseif ($totalKenaikanPenurunanKas > 0)
                            Rp {{ number_format($totalKenaikanPenurunanKas, 2, ',', '.') }}
                        @else
                            -
                        @endif
                    </td>
                </tr>
               <tr>
                    <td colspan="3">
                         <strong>Saldo Awal Kas</strong>
                    </td>
                    @php
                         $totalAwalKas = "Saldo awal ini darimana?";
                    @endphp
                    <td class="currency">{{ $totalAwalKas }}</td>
                </tr>
               <tr>
                    <td colspan="3">
                         <strong>Saldo Akhir Kas</strong>
                    </td>
                    @php
                         $totalAkhirKas = "$totalKenaikanPenurunanKas + $totalAwalKas";
                    @endphp
                </tr>
               </tbody>
          </table>
     </div>
    </div>
</x-app-layout>
