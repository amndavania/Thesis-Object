<x-app-layout>
    <x-slot name="title">
      Neraca
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
                    </tr>
               </thead>
               <body>
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
                              <td class="currency">{{ $row->ammount_debit - $row->ammount_kredit }}</td>
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
                              <td class="currency">{{ $row->ammount_debit - $row->ammount_kredit }}</td>
                         </tr>
                         @php
                         $totalAktivaTetap += $row->ammount_debit - $row->ammount_kredit;
                         @endphp
                    @endforeach
               <tr>
                    <td colspan="2">
                         <strong>Total Aktiva</strong>
                    </td>
                    <td class="currency">{{ $totalAktiva = $totalAktivaLancar + $totalAktivaTetap }}</td>
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
                              <td class="currency">{{ $row->ammount_debit - $row->ammount_kredit }}</td>
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
                              <td class="currency">{{ $row->ammount_debit - $row->ammount_kredit }}</td>
                         </tr>
                         @php
                         $totalHutangJangkaPanjang += $row->ammount_debit - $row->ammount_kredit;
                         @endphp
                    @endforeach
               <tr>
                    <td colspan="2">
                         <strong>Total Hutang</strong>
                    </td>
                    <td class="currency">{{ $totalHutang = $totalHutangLancar + $totalHutangJangkaPanjang }}</td>
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
                              <td class="currency">{{ $row->ammount_debit - $row->ammount_kredit }}</td>
                         </tr>
                         @php
                         $totalModal += $row->ammount_debit - $row->ammount_kredit;
                         @endphp
                    @endforeach
               <tr>
                    <td colspan="2">
                         <strong>Total Modal</strong>
                    </td>
                    <td class="currency">{{ $totalModal }}</td>
                </tr>
                </tbody>
          </table>
     </div>
    </div>
</x-app-layout>
