<x-app-layout>
    <x-slot name="title">
      Neraca
    </x-slot>
    <div class="card">
        <div class="card-header">
            <div class="d-flex">
              <form class="form-inline" action="{{ route('neraca.index') }}" method="GET">
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
                @if (!empty($aktivaLancar) || !empty($aktivaTetap) || !empty($hutangLancar) || !empty($hutangJangkaPanjang) || !empty($modal))
                    <button onclick="window.open('{{ url('neraca/export') }}?datepicker={{ $datepicker }}&filter={{ $filter }}', '_blank')" class="btn btn-sm btn-primary ml-auto p-2">
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
                          <strong>AKTIVA</strong>
                     </td>
                 </tr>
                <tr>
                 <td></td>
                     <td colspan="2">
                          <strong>Aktiva Lancar</strong>
                     </td>
                 </tr>
                @php
                $totalAktivaLancar = 0;
                @endphp
                     @foreach ($aktivaLancar as $accountId => $row)
                          <tr>
                               <td style="text-align: center;">{{ $accountId }}</td>
                               <td>{{ $row['name'] }}</td>
                               <td style="text-align: right; @if ($row['saldo'] < 0) color: red; @endif">
                                 @if ($row['saldo'] < 0)
                                     (Rp {{ number_format(abs($row['saldo']), 2, ',', '.') }})
                                 @elseif ($row['saldo'] > 0)
                                     Rp {{ number_format($row['saldo'], 2, ',', '.') }}
                                 @else
                                     -
                                 @endif
                             </td>
                          </tr>
                          @php
                          $totalAktivaLancar += $row['saldo'];
                          @endphp
                     @endforeach
                <tr>
                 <td></td>
                     <td colspan="2">
                     <strong>Aktiva Tetap</strong>
                     </td>
                 </tr>
                @php
                $totalAktivaTetap = 0;
                @endphp
                     @foreach ($aktivaTetap as $accountId => $row)
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
                          $totalAktivaTetap += $row['saldo'];
                          @endphp
                     @endforeach
                <tr>
                 <td></td>
                     <td colspan="1">
                          <strong>TOTAL AKTIVA</strong>
                     </td>
                     @php
                         $totalAktiva = $totalAktivaLancar + $totalAktivaTetap;
                     @endphp
                     <td style="text-align: right; @if ($totalAktiva < 0) color: red; @endif">
                         @if ($totalAktiva < 0)
                             (Rp {{ number_format(abs($totalAktiva), 2, ',', '.') }})
                         @elseif ($totalAktiva > 0 || $totalAktiva == 0)
                             Rp {{ number_format($totalAktiva, 2, ',', '.') }}
                         @else
                             -
                         @endif
                     </td>
                 </tr>
                <tr>
                 <td></td>
                     <td colspan="2">
                     <strong>PASIVA</strong>
                     </td>
                 </tr>
                <tr>
                 <td></td>
                     <td colspan="2">
                     <strong>Hutang Lancar</strong>
                     </td>
                 </tr>
                @php
                $totalHutangLancar = 0;
                @endphp
                     @foreach ($hutangLancar as $accountId => $row)
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
                          $totalHutangLancar += $row['saldo'];
                          @endphp
                     @endforeach
                <tr>
                 <td></td>
                     <td colspan="2">
                     <strong>Hutang Jangka Panjang</strong>
                     </td>
                 </tr>
                @php
                $totalHutangJangkaPanjang = 0;
                @endphp
                     @foreach ($hutangJangkaPanjang as $accountId => $row)
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
                          $totalHutangJangkaPanjang += $row['saldo'];
                          @endphp
                     @endforeach
                <tr>
                 <td></td>
                     <td colspan="1">
                          <strong>Total Hutang</strong>
                     </td>
                     @php
                         $totalHutang = $totalHutangLancar + $totalHutangJangkaPanjang;
                     @endphp
                     <td style="text-align: right; @if ($totalHutang < 0) color: red; @endif">
                         @if ($totalHutang < 0)
                             (Rp {{ number_format(abs($totalHutang), 2, ',', '.') }})
                         @elseif ($totalHutang > 0 || $totalHutang == 0)
                             Rp {{ number_format($totalHutang, 2, ',', '.') }}
                         @else
                             -
                         @endif
                     </td>
                 </tr>
                <tr>
                 <td></td>
                     <td colspan="2">
                     <strong>MODAL</strong>
                     </td>
                 </tr>
                @php
                $totalModal = 0;
                @endphp
                     @foreach ($modal as $accountId => $row)
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
                          $totalModal += $row['saldo'];
                          @endphp
                     @endforeach
                <tr>
                 <td></td>
                     <td colspan="1">
                          <strong>Total Modal</strong>
                     </td>
                     <td style="text-align: right; @if ($totalModal < 0) color: red; @endif">
                         @if ($totalModal < 0)
                             (Rp {{ number_format(abs($totalModal), 2, ',', '.') }})
                         @elseif ($totalModal > 0 || $totalModal == 0)
                             Rp {{ number_format($totalModal, 2, ',', '.') }}
                         @else
                             -
                         @endif
                     </td>
                 </tr>
                 <tr>
                     <td></td>
                         <td colspan="1">
                              <strong>Total Pasiva</strong>
                         </td>
                         @php
                             $totalPasiva = $totalHutang + $totalModal;
                         @endphp
                         <td style="text-align: right; @if ($totalPasiva < 0) color: red; @endif">
                             @if ($totalPasiva < 0)
                                 (Rp {{ number_format(abs($totalPasiva), 2, ',', '.') }})
                             @elseif ($totalPasiva > 0 || $totalPasiva == 0)
                                 Rp {{ number_format($totalPasiva, 2, ',', '.') }}
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
