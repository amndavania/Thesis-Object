@include('report.kop')
            <h2 class="title">
                Laporan Perubahan Modal
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
                    <th style="width: 10%;">Kode Akun </th>
                    <th style="width: 40%;">Nama Akun</th>
                    <th style="width: 20%;">Saldo</th>
                </tr>
                <tr>
                    <td></td>
                    <td><strong>PENDAPATAN</strong></td>
                    <td></td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td></td>
                     <td colspan="2">
                          <strong>MODAL DI AWAL TAHUN FISKAL</strong>
                     </td>
                </tr>
                @php
                $totalModalAwal = 0;
                @endphp
                     @foreach ($dataA as $row)
                          <tr>
                               <td style="text-align: center;">{{ $row->id }}</td>
                               <td>{{ $row->name }}</td>
                               @php
                               $saldo = $row->ammount_debit - $row->ammount_kredit;
                                 @endphp
                                 <td style="text-align: right; @if ($saldo < 0) color: red; @endif">
                                     @if ($saldo < 0)
                                         (Rp {{ number_format(abs($saldo), 2, ',', '.') }})
                                     @elseif ($saldo > 0)
                                         Rp {{ number_format($saldo, 2, ',', '.') }}
                                     @else
                                         -
                                     @endif
                                 </td>
                          </tr>
                          @php
                          $totalModalAwal += ($row->ammount_debit - $row->ammount_kredit);
                          @endphp
                     @endforeach
                <tr>
                    <td></td>
                     <td colspan="1">
                          <strong>Total Modal Awal</strong>
                     </td>
                     <td style="text-align: right; @if ($totalModalAwal < 0) color: red; @endif">
                         @if ($totalModalAwal < 0)
                             (Rp {{ number_format(abs($totalModalAwal), 2, ',', '.') }})
                         @elseif ($totalModalAwal > 0)
                             Rp {{ number_format($totalModalAwal, 2, ',', '.') }}
                         @else
                             -
                         @endif
                     </td>
                 </tr>

                <tr>
                    <td></td>
                     <td colspan="2">
                     <strong>PENAMBAHAN MODAL</strong>
                     </td>
                 </tr>
                @php
                $totalPenambahanModal = 0;
                @endphp
                     @foreach ($dataB as $row)
                          <tr>
                               <td style="text-align: center;">{{ $row->id }}</td>
                               <td>{{ $row->name }}</td>
                               @php
                               $saldo = $row->ammount_debit - $row->ammount_kredit;
                                 @endphp
                                 <td style="text-align: right; @if ($saldo < 0) color: red; @endif">
                                     @if ($saldo < 0)
                                         (Rp {{ number_format(abs($saldo), 2, ',', '.') }})
                                     @elseif ($saldo > 0)
                                         Rp {{ number_format($saldo, 2, ',', '.') }}
                                     @else
                                         -
                                     @endif
                                 </td>
                          </tr>
                          @php
                          $totalPenambahanModal += ($row->ammount_debit - $row->ammount_kredit);
                          @endphp
                     @endforeach
                <tr>
                    <td></td>
                     <td colspan="1">
                          <strong>Total Penambahan Modal</strong>
                     </td>
                     <td style="text-align: right; @if ($totalPenambahanModal < 0) color: red; @endif">
                         @if ($totalPenambahanModal < 0)
                             (Rp {{ number_format(abs($totalPenambahanModal), 2, ',', '.') }})
                         @elseif ($totalPenambahanModal > 0)
                             Rp {{ number_format($totalPenambahanModal, 2, ',', '.') }}
                         @else
                             -
                         @endif
                     </td>
                 </tr>
                <tr>
                    <td></td>
                     <td colspan="2">
                     <strong>PENGURANGAN MODAL</strong>
                     </td>
                 </tr>
                @php
                $totalPenguranganModal = 0;
                @endphp
                     @foreach ($dataC as $row)
                          <tr>
                               <td style="text-align: center;">{{ $row->id }}</td>
                               <td>{{ $row->name }}</td>
                               @php
                               $saldo = $row->ammount_debit - $row->ammount_kredit;
                                 @endphp
                                 <td style="text-align: right; @if ($saldo < 0) color: red; @endif">
                                     @if ($saldo < 0)
                                         (Rp {{ number_format(abs($saldo), 2, ',', '.') }})
                                     @elseif ($saldo > 0)
                                         Rp {{ number_format($saldo, 2, ',', '.') }}
                                     @else
                                         -
                                     @endif
                                 </td>
                          </tr>
                          @php
                          $totalPenguranganModal += $row->ammount_debit - $row->ammount_kredit;
                          @endphp
                     @endforeach
                <tr>
                    <td></td>
                     <td colspan="1">
                          <strong>Total Pengurangan Modal</strong>
                     </td>
                     <td style="text-align: right; @if ($totalPenguranganModal < 0) color: red; @endif">
                         @if ($totalPenguranganModal < 0)
                             (Rp {{ number_format(abs($totalPenguranganModal), 2, ',', '.') }})
                         @elseif ($totalPenguranganModal > 0)
                             Rp {{ number_format($totalPenguranganModal, 2, ',', '.') }}
                         @else
                             -
                         @endif
                     </td>
                 </tr>
                <tr>
                    <td></td>
                     <td colspan="1">
                          <strong>MODAL DI AKHIR TAHUN FISKAL</strong>
                     </td>
                     @php
                     $modalAkhir = $totalModalAwal + $totalPenambahanModal - $totalPenguranganModal;
                     @endphp
                     <td style="text-align: right; @if ($modalAkhir < 0) color: red; @endif">
                         @if ($modalAkhir < 0)
                             (Rp {{ number_format(abs($modalAkhir), 2, ',', '.') }})
                         @elseif ($modalAkhir > 0)
                             Rp {{ number_format($modalAkhir, 2, ',', '.') }}
                         @else
                             -
                         @endif
                     </td>
                 </tr>
                 </tbody>
            <tfoot class = "total">
            </tfoot>

        </table>
        @include('report.signature')
