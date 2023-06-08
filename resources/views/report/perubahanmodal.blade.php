<x-app-layout>
    <x-slot name="title">
      Perubahan Modal
    </x-slot>
    <div class="card">
        <div class="card-header">
            <div class="d-flex">
              @include('message.flash-message')
              <a href="{{ url('cashflow/export') }}" target="_blank" class="btn btn-sm btn-primary ml-auto p-2">Export PDF</a>
            </div>
       </div>
         <div class="card-body">
          {{-- <a href="" @click.prevent="printme" target="_blank" class="btn btn-info btn-md mb-3 ">Download Perubahan Modal</a> --}}
          <table class="table table-striped ">
               <thead class="table-dark">
                    <tr>
                         <td>ID Akun</td>
                         <td>Nama Akun</td>
                         <td>Jumlah</td>
                    </tr>
               </thead>
               <body>
               <tr>
                    <td colspan="3">
                         <strong>Modal di Awal Tahun Fiskal</strong>
                    </td>
               </tr>
               @php
               $totalModalAwal = 0;
               @endphp
                    @foreach ($dataA as $row)
                         <tr>
                              <td>{{ $row->id }}</td>
                              <td>{{ $row->name }}</td>
                              <td class="currency">{{ $row->ammount_debit - $row->ammount_kredit }}</td>
                         </tr>
                         @php
                         $totalModalAwal += ($row->ammount_debit - $row->ammount_kredit);
                         @endphp
                    @endforeach
               <tr>
                    <td colspan="2">
                         <strong>Total Modal Awal</strong>
                    </td>
                    <td class="currency">{{ $totalModalAwal }}</td>
                </tr>

               <tr>
                    <td colspan="0">
                    <strong>Penambahan Modal</strong>
                    </td>
                </tr>
               @php
               $totalPenambahanModal = 0;
               @endphp
                    @foreach ($dataB as $row)
                         <tr>
                              <td>{{ $row->id }}</td>
                              <td>{{ $row->name }}</td>
                              <td class="currency">{{ $row->ammount_debit - $row->ammount_kredit }}</td>
                         </tr>
                         @php
                         $totalPenambahanModal += ($row->ammount_debit - $row->ammount_kredit);
                         @endphp
                    @endforeach
               <tr>
                    <td colspan="2">
                         <strong>Total Penambahan Modal</strong>
                    </td>
                    <td class="currency">{{ $totalPenambahanModal }}</td>
                </tr>
               <tr>
                    <td colspan="3">
                    <strong>Pengurangan Modal</strong>
                    </td>
                </tr>
               @php
               $totalPenguranganModal = 0;
               @endphp
                    @foreach ($dataC as $row)
                         <tr>
                              <td>{{ $row->id }}</td>
                              <td>{{ $row->name }}</td>
                              <td class="currency">{{ $row->ammount_debit - $row->ammount_kredit }}</td>
                         </tr>
                         @php
                         $totalPenguranganModal += $row->ammount_debit - $row->ammount_kredit;
                         @endphp
                    @endforeach
               <tr>
                    <td colspan="2">
                         <strong>Total Pengurangan Modal</strong>
                    </td>
                    <td class="currency">{{ $totalPenguranganModal }}</td>
                </tr>
               <tr>
                    <td colspan="2">
                         <strong>Modal di akhir tahun fiskal</strong>
                    </td>
                    <td class="currency">{{ $modalAkhir = $totalModalAwal + $totalPenambahanModal - $totalPenguranganModal }}</td>
                </tr>
                </tbody>
          </table>
     </div>
    </div>
</x-app-layout>
