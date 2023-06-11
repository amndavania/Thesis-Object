@include('report.kop')
            <h2 class="title">
                Laporan Neraca
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
            <th rowspan="2" style="width: 15%;">ID</th>
            <th rowspan="2" style="width: 35%;">Nama Akun</th>
            <th style="width: 25%;">Saldo</th>
        </tr>
        </thead>
        <tbody>
            <tr>
                 <td colspan="3">
                      <strong>AKTIVA</strong>
                 </td>
             </tr>
            <tr>
                 <td colspan="3">
                      <strong>Aktiva Lancar</strong>
                 </td>
             </tr>
            @php
            $totalAktivaLancar = 0;
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
                      </tr>
                      @php
                      $totalAktivaLancar += $row->ammount_debit - $row->ammount_kredit;
                      @endphp
                 @endforeach
            <tr>
                 <td colspan="3">
                 <strong>Aktiva Tetap</strong>
                 </td>
             </tr>
            @php
            $totalAktivaTetap = 0;
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
                      </tr>
                      @php
                      $totalAktivaTetap += $row->ammount_debit - $row->ammount_kredit;
                      @endphp
                 @endforeach
            <tr>
                 <td colspan="2">
                      <strong>Total Aktiva</strong>
                 </td>
                 @php
                     $totalAktiva = $totalAktivaLancar + $totalAktivaTetap;
                 @endphp
                 <td>
                     @if ($totalAktiva < 0)
                         (Rp {{ number_format(abs($totalAktiva), 2, ',', '.') }})
                     @elseif ($totalAktiva > 0)
                         Rp {{ number_format($totalAktiva, 2, ',', '.') }}
                     @else
                         -
                     @endif
                 </td>
             </tr>
            <tr>
                 <td colspan="3">
                 <strong>PASIVA</strong>
                 </td>
             </tr>
            <tr>
                 <td colspan="3">
                 <strong>Hutang Lancar</strong>
                 </td>
             </tr>
            @php
            $totalHutangLancar = 0;
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
                      </tr>
                      @php
                      $totalHutangLancar += $row->ammount_debit - $row->ammount_kredit;
                      @endphp
                 @endforeach
            <tr>
                 <td colspan="3">
                 <strong>Hutang Jangka Panjang</strong>
                 </td>
             </tr>
            @php
            $totalHutangJangkaPanjang = 0;
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
                      </tr>
                      @php
                      $totalHutangJangkaPanjang += $row->ammount_debit - $row->ammount_kredit;
                      @endphp
                 @endforeach
            <tr>
                 <td colspan="2">
                      <strong>Total Hutang</strong>
                 </td>
                 @php
                     $totalHutang = $totalHutangLancar + $totalHutangJangkaPanjang;
                 @endphp
                 <td>
                     @if ($totalHutang < 0)
                         (Rp {{ number_format(abs($totalHutang), 2, ',', '.') }})
                     @elseif ($totalHutang > 0)
                         Rp {{ number_format($totalHutang, 2, ',', '.') }}
                     @else
                         -
                     @endif
                 </td>
             </tr>
            <tr>
                 <td colspan="3">
                 <strong>Modal</strong>
                 </td>
             </tr>
            @php
            $totalModal = 0;
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
                      </tr>
                      @php
                      $totalModal += $row->ammount_debit - $row->ammount_kredit;
                      @endphp
                 @endforeach
            <tr>
                 <td colspan="2">
                      <strong>Total Modal</strong>
                 </td>
                 <td>
                     @if ($totalModal < 0)
                         (Rp {{ number_format(abs($totalModal), 2, ',', '.') }})
                     @elseif ($totalModal > 0)
                         Rp {{ number_format($totalModal, 2, ',', '.') }}
                     @else
                         -
                     @endif
                 </td>
             </tr>
             </tbody>
        </table>
        @include('report.signature')
