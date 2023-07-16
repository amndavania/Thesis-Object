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
                    <td style="text-align: center;">Debit</td>
                    <td style="text-align: center;">Kredit</td>
                    <td style="text-align: center;">Saldo</td>
                  </tr>
               </thead>
               <tbody>
                <tr>
                 <td></td>
                     <td colspan="4">
                          <strong>AKTIVA</strong>
                     </td>
                 </tr>
                <tr>
                 <td></td>
                     <td colspan="4">
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
                               <td style="text-align: right; @if ($row['debit'] < 0) color: red; @endif">
                                @if ($row['debit'] < 0)
                                    (Rp {{ number_format(abs($row['debit']), 2, ',', '.') }})
                                @elseif ($row['debit'] > 0)
                                    Rp {{ number_format($row['debit'], 2, ',', '.') }}
                                @else
                                    -
                                @endif
                            </td>
                               <td style="text-align: right; @if ($row['kredit'] < 0) color: red; @endif">
                                 @if ($row['kredit'] < 0)
                                     (Rp {{ number_format(abs($row['kredit']), 2, ',', '.') }})
                                 @elseif ($row['kredit'] > 0)
                                     Rp {{ number_format($row['kredit'], 2, ',', '.') }}
                                 @else
                                     -
                                 @endif
                             </td>
                             <td></td>
                          </tr>
                          @php
                          $totalAktivaLancar += ($row['debit'] - $row['kredit']);
                          @endphp
                     @endforeach
                <tr>
                 <td></td>
                     <td colspan="4">
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
                               <td style="text-align: right; @if ($row['debit'] < 0) color: red; @endif">
                                @if ($row['debit'] < 0)
                                    (Rp {{ number_format(abs($row['debit']), 2, ',', '.') }})
                                @elseif ($row['debit'] > 0)
                                    Rp {{ number_format($row['debit'], 2, ',', '.') }}
                                @else
                                    -
                                @endif
                            </td>
                               <td style="text-align: right; @if ($row['kredit'] < 0) color: red; @endif">
                                 @if ($row['kredit'] < 0)
                                     (Rp {{ number_format(abs($row['kredit']), 2, ',', '.') }})
                                 @elseif ($row['kredit'] > 0)
                                     Rp {{ number_format($row['kredit'], 2, ',', '.') }}
                                 @else
                                     -
                                 @endif
                             </td>
                             <td></td>
                          </tr>
                          @php
                          $totalAktivaTetap += ($row['debit'] - $row['kredit']);
                          @endphp
                     @endforeach
                <tr>
                 <td></td>
                     <td colspan="3">
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
                     <td colspan="4">
                     <strong>PASIVA</strong>
                     </td>
                 </tr>
                <tr>
                 <td></td>
                     <td colspan="4">
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
                               <td style="text-align: right; @if ($row['debit'] < 0) color: red; @endif">
                                @if ($row['debit'] < 0)
                                    (Rp {{ number_format(abs($row['debit']), 2, ',', '.') }})
                                @elseif ($row['debit'] > 0)
                                    Rp {{ number_format($row['debit'], 2, ',', '.') }}
                                @else
                                    -
                                @endif
                            </td>
                               <td style="text-align: right; @if ($row['kredit'] < 0) color: red; @endif">
                                 @if ($row['kredit'] < 0)
                                     (Rp {{ number_format(abs($row['kredit']), 2, ',', '.') }})
                                 @elseif ($row['kredit'] > 0)
                                     Rp {{ number_format($row['kredit'], 2, ',', '.') }}
                                 @else
                                     -
                                 @endif
                             </td>
                             <td></td>
                          </tr>
                          @php
                          $totalHutangLancar += ($row['debit'] - $row['kredit']);
                          @endphp
                     @endforeach
                <tr>
                 <td></td>
                     <td colspan="4">
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
                               <td style="text-align: right; @if ($row['debit'] < 0) color: red; @endif">
                                @if ($row['debit'] < 0)
                                    (Rp {{ number_format(abs($row['debit']), 2, ',', '.') }})
                                @elseif ($row['debit'] > 0)
                                    Rp {{ number_format($row['debit'], 2, ',', '.') }}
                                @else
                                    -
                                @endif
                            </td>
                               <td style="text-align: right; @if ($row['kredit'] < 0) color: red; @endif">
                                 @if ($row['kredit'] < 0)
                                     (Rp {{ number_format(abs($row['kredit']), 2, ',', '.') }})
                                 @elseif ($row['kredit'] > 0)
                                     Rp {{ number_format($row['kredit'], 2, ',', '.') }}
                                 @else
                                     -
                                 @endif
                             </td>
                             <td></td>
                          </tr>
                          @php
                          $totalHutangJangkaPanjang += ($row['debit'] - $row['kredit']);
                          @endphp
                     @endforeach
                <tr>
                 <td></td>
                     <td colspan="3">
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
                     <td colspan="4">
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
                               <td style="text-align: right; @if ($row['debit'] < 0) color: red; @endif">
                                @if ($row['debit'] < 0)
                                    (Rp {{ number_format(abs($row['debit']), 2, ',', '.') }})
                                @elseif ($row['debit'] > 0)
                                    Rp {{ number_format($row['debit'], 2, ',', '.') }}
                                @else
                                    -
                                @endif
                            </td>
                               <td style="text-align: right; @if ($row['kredit'] < 0) color: red; @endif">
                                 @if ($row['kredit'] < 0)
                                     (Rp {{ number_format(abs($row['kredit']), 2, ',', '.') }})
                                 @elseif ($row['kredit'] > 0)
                                     Rp {{ number_format($row['kredit'], 2, ',', '.') }}
                                 @else
                                     -
                                 @endif
                             </td>
                             <td></td>
                          </tr>
                          @php
                          $totalModal += ($row['debit'] - $row['kredit']);
                          @endphp
                     @endforeach
                <tr>
                 <td></td>
                     <td colspan="3">
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
                         <td colspan="3">
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
