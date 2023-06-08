<x-app-layout>
    <x-slot name="title">
      Laba Rugi
    </x-slot>
    <div class="card">
        <div class="card-header">
            <div class="d-flex">
              @include('message.flash-message')
              <a href="{{ url('cashflow/export') }}" target="_blank" class="btn btn-sm btn-primary ml-auto p-2">Export PDF</a>
            </div>
       </div>
         <div class="card-body">
          {{-- <a href="" @click.prevent="printme" target="_blank" class="btn btn-info btn-md mb-3 ">Download Laba Rugi</a> --}}
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
               <body>
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
                              <td class="currency">{{ $row->ammount_debit }}</td>
                              <td class="currency">{{ $row->ammount_kredit }}</td>
                              <td class="currency">{{ $totalPendapatan = $row->ammount_debit + $row->ammount_kredit; }}</td>
                         </tr>
                    @endforeach
               <tr>
                    <td colspan="4">
                         <strong>Total Pendapatan</strong>
                    </td>
                    <td class="currency">{{ $totalPendapatan }}</td>
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
                              <td class="currency">{{ $row->ammount_debit }}</td>
                              <td class="currency">{{ $row->ammount_kredit }}</td>
                              <td class="currency">{{ $totalPengeluaran = $row->ammount_debit + $row->ammount_kredit; }}</td>
                         </tr>
                    @endforeach
               <tr>
                    <td colspan="4">
                         <strong>Total Pengeluaran</strong>
                    </td>
                    <td class="currency">{{ $totalPengeluaran }}</td>
                </tr>
               <tr>
                    <td colspan="4">
                         <strong>Laba / Rugi Kotor</strong>
                    </td>
                    <td class="currency">{{ $labaRugiKotor = $totalPendapatan + $totalPengeluaran }}</td>
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
                              <td class="currency">{{ $row->ammount_debit }}</td>
                              <td class="currency">{{ $row->ammount_kredit }}</td>
                              <td class="currency">{{ $totalPenyusutan = $row->ammount_debit + $row->ammount_kredit; }}</td>
                         </tr>
                    @endforeach
               <tr>
                    <td colspan="4">
                         <strong>Total Penyusutan dan Amortisasi</strong>
                    </td>
                    <td class="currency">{{ $totalPenyusutan }}</td>
                </tr>
               <tr>
                    <td colspan="4">
                         <strong>Ebit</strong>
                    </td>
                    <td class="currency">{{ $ebit = $labaRugiKotor + $totalPenyusutan}}</td>
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
                              <td class="currency">{{ $row->ammount_debit }}</td>
                              <td class="currency">{{ $row->ammount_kredit }}</td>
                              <td class="currency">{{ $totalBungaPajak = $row->ammount_debit + $row->ammount_kredit; }}</td>
                         </tr>
                    @endforeach
               <tr>
                    <td colspan="4">
                         <strong>Total Pembelian Aset</strong>
                    </td>
                    <td class="currency">{{ $totalBungaPajak }}</td>
                </tr>
               <tr>
                    <td colspan="4">
                         <strong>Laba / Rugi Kotor</strong>
                    </td>
                    <td class="currency">{{ $labaRugiKotor2 = $ebit + $totalBungaPajak }}</td>
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
                              <td class="currency">{{ $row->ammount_debit }}</td>
                              <td class="currency">{{ $row->ammount_kredit }}</td>
                              <td class="currency">{{ $totalPendapatanPengeluaranLain = $row->ammount_debit + $row->ammount_kredit; }}</td>
                         </tr>
                    @endforeach
               <tr>
                    <td colspan="4">
                         <strong>Total Pendapatan / Pengeluaran Lain</strong>
                    </td>
                    <td class="currency">{{ $totalPendapatanPengeluaranLain }}</td>
                </tr>
               <tr>
                    <td colspan="4">
                         <strong>Laba / Rugi Bersih</strong>
                    </td>
                    <td class="currency">{{ $labaRugiBersih = $labaRugiKotor2 + $totalPendapatanPengeluaranLain }}</td>
                </tr>
                </tbody>
          </table>
     </div>
    </div>
</x-app-layout>
