<x-app-layout>
    <x-slot name="title">
      Perubahan Modal
    </x-slot>
    <div class="card">
        <div class="card-header">
            <div class="d-flex">
                <form class="form-inline" action="{{ route('perubahanmodal.index') }}" method="GET">
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
                @if (!empty($modaldiAwal) || !empty($penambahanModal) || !empty($penguranganModal))
                    <button onclick="window.open('{{ url('perubahanmodal/export') }}?datepicker={{ $datepicker }}&filter={{ $filter }}', '_blank')" class="btn btn-sm btn-primary ml-auto p-2">
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
                         <td>Kode Akun</td>
                         <td>Nama Akun</td>
                         <td>Saldo</td>
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
                     @foreach ($modaldiAwal as $accountId => $row)
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
                          $totalModalAwal += $row['saldo'];
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
                     @foreach ($penambahanModal as $accountId => $row)
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
                          $totalPenambahanModal += $row['saldo'];
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
          </table>
     </div>
    </div>
</x-app-layout>
