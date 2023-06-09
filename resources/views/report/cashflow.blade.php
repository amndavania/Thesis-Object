<x-app-layout>
    <x-slot name="title">
      Cash Flow
    </x-slot>
    <div class="card">
        <div class="card-header">
            <div class="d-flex">
              @include('message.flash-message')
              <a href="{{ url('cashflow/export') }}" target="_blank" class="btn btn-sm btn-primary ml-auto p-2">Export PDF</a>
            </div>
       </div>
         <div class="card-body">
          {{-- <a href="" @click.prevent="printme" target="_blank" class="btn btn-info btn-md mb-3 ">Download Cash Flow</a> --}}
          <table class="table table-striped ">
               <thead class="table-dark">
                    <tr>
                         <td>ID Akun</td>
                         <td>Nama Akun</td>
                         <td>Jumlah</td>
                         <td>Total</td>
                    </tr>
               </thead>
               <body>
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
                              <td class="currency">{{ $row->ammount_debit - $row->ammount_kredit }}</td>
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
                    <td class="currency">{{ $totalArusKasMasuk }}</td>
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
                              <td class="currency">{{ $row->ammount_debit - $row->ammount_kredit }}</td>
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
                    <td class="currency">{{ $totalArusKasKeluar }}</td>
                </tr>
               <tr>
                    <td colspan="3">
                    <strong>Arus Kas Dari Aktivitas Operasi</strong>
                    </td>
                    @php
                         $totalArusKasAktivitasOperasi = $totalArusKasMasuk - $totalArusKasKeluar;
                    @endphp
                    <td class="currency">{{ $totalArusKasAktivitasOperasi }}</td>
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
                              <td class="currency">{{ $row->ammount_debit - $row->ammount_kredit }}</td>
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
                    <td class="currency">{{ $totalPenjualanAset }}</td>
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
                              <td class="currency">{{ $row->ammount_debit - $row->ammount_kredit }}</td>
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
                    <td class="currency">{{ $totalPembelianAset }}</td>
                </tr>
               <tr>
                    <td colspan="3">
                    <strong>Arus Kas Dari Aktivitas Investasi</strong>
                    </td>
                    @php
                         $totalArusKasAktivitasInvestasi = $totalPenjualanAset - $totalPembelianAset;
                    @endphp
                    <td class="currency">{{ $totalArusKasAktivitasInvestasi }}</td>
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
                              <td class="currency">{{ $row->ammount_debit - $row->ammount_kredit }}</td>
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
                    <td class="currency">{{ $totalPenambahanDana }}</td>
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
                              <td class="currency">{{ $row->ammount_debit - $row->ammount_kredit }}</td>
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
                    <td class="currency">{{ $totalPenguranganDana }}</td>
                </tr>
               <tr>
                    <td colspan="3">
                         <strong>Arus Kas Dari Aktivitas Pendanaan</strong>
                    </td>
                    @php
                         $totalArusKasAktivitasPendanaan = $totalPenambahanDana - $totalPenguranganDana;
                    @endphp
                    <td class="currency">{{ $totalArusKasAktivitasPendanaan }}</td>
                </tr>
               <tr>
                    <td colspan="3">
                         <strong>Kenaikan / Penurunan Kas</strong>
                    </td>
                    @php
                         $totalKenaikanPenurunanKas = $totalArusKasAktivitasOperasi + $totalArusKasAktivitasInvestasi + $totalArusKasAktivitasPendanaan;
                    @endphp
                    <td class="currency">{{ $totalKenaikanPenurunanKas }}</td>
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
                    <td class="currency">{{ $totalAkhirKas }}</td>
                </tr>
               </tbody>
          </table>
     </div>
    </div>
</x-app-layout>
