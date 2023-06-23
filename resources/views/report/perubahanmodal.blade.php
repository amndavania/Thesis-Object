<x-app-layout>
    <x-slot name="title">
      Perubahan Modal
    </x-slot>
    <div class="card">
        <div class="card-header">
            <div class="d-flex">
                <form class="form-inline" action="{{ route('perubahanmodal.index') }}" method="GET">
                    <input type="text" class="form-control mb-2 mr-sm-2" id="datepicker" name="datepicker" placeholder="Pilih Bulan" readonly>
                    <button type="submit" class="btn btn-primary mb-2">Cari</button>
                </form>
                <button onclick="window.open('{{ url('perubahanmodal/export') }}?datepicker={{ $datepicker }}', '_blank')" class="btn btn-sm btn-primary ml-auto p-2">
                    <i class="fas fa-print"></i> Export PDF
                </button>
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
                     @foreach ($modaldiAwal as $row)
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
                     @foreach ($penambahanModal as $row)
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
                     @foreach ($penguranganModal as $row)
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
          </table>
     </div>
    </div>
</x-app-layout>
