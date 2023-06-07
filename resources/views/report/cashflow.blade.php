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
                    </tr>
               </thead>
               <tr>
                    <td colspan="2">
                         <strong>Modal di awal Tahun Fiskal</strong>
                    </td>
                    <td> Modal awal </td>
                </tr>
               <tr>
                    <td colspan="3">
                         <strong>Kas Masuk</strong>
                    </td>
                </tr>
               <tbody>
               @php
               $totalDebit = 0;
               @endphp
                    @foreach ($dataA as $row)
                         <tr>
                              <td>{{ $row->id }}</td>
                              <td>{{ $row->name }}</td>
                              <td class="currency">{{ $row->ammount_debit }}</td>
                         </tr>
                         @php
                         $totalDebit += $row->ammount_debit;
                         @endphp
                    @endforeach
               </tbody>
               <tr>
                    <td colspan="2">
                         <strong>Total Kas Masuk</strong>
                    </td>
                    <td class="currency">{{ $totalDebit }}</td>
                </tr>

               <tr>
                    <td colspan="0">
                    <strong>Kas Keluar</strong>
                    </td>
                </tr>
               <tbody>
               @php
               $totalDebit = 0;
               @endphp
                    @foreach ($dataB as $row)
                         <tr>
                              <td>{{ $row->id }}</td>
                              <td>{{ $row->name }}</td>
                              <td class="currency">{{ $row->ammount_debit }}</td>
                         </tr>
                         @php
                         $totalDebit += $row->ammount_debit;
                         @endphp
                    @endforeach
               </tbody>
               <tr>
                    <td colspan="2">
                         <strong>Total Kas Keluar</strong>
                    </td>
                    <td class="currency">{{ $totalDebit }}</td>
                </tr>
               </tbody>
               <tr>
                    <td colspan="0">
                    <strong>Penjualan Aset</strong>
                    </td>
                </tr>
               <tbody>
               @php
               $totalDebit = 0;
               @endphp
                    @foreach ($dataC as $row)
                         <tr>
                              <td>{{ $row->id }}</td>
                              <td>{{ $row->name }}</td>
                              <td class="currency">{{ $row->ammount_debit }}</td>
                         </tr>
                         @php
                         $totalDebit += $row->ammount_debit;
                         @endphp
                    @endforeach
               </tbody>
               <tr>
                    <td colspan="2">
                         <strong>Total Penjualan Aset</strong>
                    </td>
                    <td class="currency">{{ $totalDebit }}</td>
                </tr>
               </tbody>
               <tr>
                    <td colspan="0">
                    <strong>Pembelian Aset</strong>
                    </td>
                </tr>
               <tbody>
               @php
               $totalDebit = 0;
               @endphp
                    @foreach ($dataD as $row)
                         <tr>
                              <td>{{ $row->id }}</td>
                              <td>{{ $row->name }}</td>
                              <td class="currency">{{ $row->ammount_debit }}</td>
                         </tr>
                         @php
                         $totalDebit += $row->ammount_debit;
                         @endphp
                    @endforeach
               </tbody>
               <tr>
                    <td colspan="2">
                         <strong>Total Pembelian Aset</strong>
                    </td>
                    <td class="currency">{{ $totalDebit }}</td>
                </tr>
               </tbody>
               <tr>
                    <td colspan="0">
                    <strong>Penambahan Dana</strong>
                    </td>
                </tr>
               <tbody>
               @php
               $totalDebit = 0;
               @endphp
                    @foreach ($dataE as $row)
                         <tr>
                              <td>{{ $row->id }}</td>
                              <td>{{ $row->name }}</td>
                              <td class="currency">{{ $row->ammount_debit }}</td>
                         </tr>
                         @php
                         $totalDebit += $row->ammount_debit;
                         @endphp
                    @endforeach
               </tbody>
               <tr>
                    <td colspan="2">
                         <strong>Total Penambahan Dana</strong>
                    </td>
                    <td class="currency">{{ $totalDebit }}</td>
                </tr>
               </tbody>
               <tr>
                    <td colspan="0">
                    <strong>Pengurangan Dana</strong>
                    </td>
                </tr>
               <tbody>
               @php
               $totalDebit = 0;
               @endphp
                    @foreach ($dataF as $row)
                         <tr>
                              <td>{{ $row->id }}</td>
                              <td>{{ $row->name }}</td>
                              <td class="currency">{{ $row->ammount_debit }}</td>
                         </tr>
                         @php
                         $totalDebit += $row->ammount_debit;
                         @endphp
                    @endforeach
               </tbody>
               <tr>
                    <td colspan="2">
                         <strong>Total Pengurangan Dana</strong>
                    </td>
                    <td class="currency">{{ $totalDebit }}</td>
                </tr>
               </tbody>
          </table>
     </div>
    </div>
</x-app-layout>
