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
                     @foreach ($modal as $accountId => $row)
                          <tr>
                               <td style="text-align: center;">{{ $accountId }}</td>
                               <td>{{ $row['name'] }}</td>
                                 <td style="text-align: right; @if ($row['saldoAwal'] < 0) color: red; @endif">
                                     @if ($row['saldoAwal'] < 0)
                                         (Rp {{ number_format(abs($row['saldoAwal']), 2, ',', '.') }})
                                     @elseif ($row['saldoAwal'] > 0 || $row['saldoAwal'] == 0)
                                         Rp {{ number_format($row['saldoAwal'], 2, ',', '.') }}
                                     @else
                                         -
                                     @endif
                                 </td>
                          </tr>
                          @php
                          $totalModalAwal += $row['saldoAwal'];
                          @endphp
                     @endforeach
                     @php
                          $totalModalAwal += $labaDitahan;
                          @endphp
                     <tr>
                               <td></td>
                               <td>Laba / Rugi Ditahan</td>
                                 <td style="text-align: right; @if ($labaDitahan < 0) color: red; @endif">
                                     @if ($labaDitahan < 0)
                                         (Rp {{ number_format(abs($labaDitahan), 2, ',', '.') }})
                                     @elseif ($labaDitahan > 0 || $labaDitahan == 0)
                                         Rp {{ number_format($labaDitahan, 2, ',', '.') }}
                                     @else
                                         -
                                     @endif
                                 </td>
                          </tr>
                <tr>
                    <td></td>
                     <td colspan="1">
                          <strong>Total Modal Awal</strong>
                     </td>
                     <td style="text-align: right; @if ($totalModalAwal < 0) color: red; @endif">
                         @if ($totalModalAwal < 0)
                             (Rp {{ number_format(abs($totalModalAwal), 2, ',', '.') }})
                         @elseif ($totalModalAwal > 0 || $totalModalAwal == 0)
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
                     @foreach ($modal as $accountId => $row)
                          <tr>
                               <td style="text-align: center;">{{ $accountId }}</td>
                               <td>{{ $row['name'] }}</td>
                                 <td style="text-align: right; @if ($row['penambahanSaldo'] < 0) color: red; @endif">
                                     @if ($row['penambahanSaldo'] < 0)
                                         (Rp {{ number_format(abs($row['penambahanSaldo']), 2, ',', '.') }})
                                     @elseif ($row['penambahanSaldo'] > 0 || $row['penambahanSaldo'] == 0)
                                         Rp {{ number_format($row['penambahanSaldo'], 2, ',', '.') }}
                                     @else
                                         -
                                     @endif
                                 </td>
                          </tr>
                          @php
                          $totalPenambahanModal += $row['penambahanSaldo'];
                          @endphp
                     @endforeach
                <tr>
                @php
                          $totalPenambahanModal += $labaBerjalan;
                          @endphp
                <tr>
                               <td></td>
                               <td>Laba / Rugi Berjalan</td>
                                 <td style="text-align: right; @if ($labaBerjalan < 0) color: red; @endif">
                                     @if ($labaBerjalan < 0)
                                         (Rp {{ number_format(abs($labaBerjalan), 2, ',', '.') }})
                                     @elseif ($labaBerjalan > 0 || $labaBerjalan == 0)
                                         Rp {{ number_format($labaBerjalan, 2, ',', '.') }}
                                     @else
                                         -
                                     @endif
                                 </td>
                          </tr>
                    <td></td>
                     <td colspan="1">
                          <strong>Total Penambahan Modal</strong>
                     </td>
                     <td style="text-align: right; @if ($totalPenambahanModal < 0) color: red; @endif">
                         @if ($totalPenambahanModal < 0)
                             (Rp {{ number_format(abs($totalPenambahanModal), 2, ',', '.') }})
                         @elseif ($totalPenambahanModal > 0 || $totalPenambahanModal == 0)
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
                     @foreach ($penguranganModal as $accountId => $row)
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
                          $totalPenguranganModal += $row['saldo'];
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
                         @elseif ($totalPenguranganModal > 0 || $totalPenguranganModal == 0)
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
                         @elseif ($modalAkhir > 0 || $modalAkhir == 0)
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
