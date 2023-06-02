<x-app-layout>
    <x-slot name="title">
      Cash Flow
    </x-slot>
    <div class="card">
         <div class="card-body">
          <a href="" @click.prevent="printme" target="_blank" class="btn btn-info btn-md mb-3 ">Download Cash Flow</a>
          <table class="table table-striped ">
               <thead class="table-dark">
                    <tr>
                         <td>ID Akun</td>
                         <td>Nama Akun</td>
                         <td>Jumlah</td>
                    </tr>
               </thead>
               <tr>
                    <td></td>
                    <td colspan="3">
                    <strong>Kas Masuk</strong>
                    </td>
                </tr>
               <tbody>
                    @foreach ($dataA as $row)
                         <tr>
                              <td>{{ $row->id }}</td>
                              <td>{{ $row->name }}</td>
                              <td class="currency">{{ $row->ammount_debit }}</td>
                         </tr>
                    @endforeach
               </tbody>
               <tr>
                    <td></td>
                    <td colspan="0">
                    <strong>Kas Keluar</strong>
                    </td>
                </tr>
               <tbody>
                    @foreach ($dataB as $row)
                         <tr>
                              <td>{{ $row->id }}</td>
                              <td>{{ $row->name }}</td>
                              <td class="currency">{{ $row->ammount_debit }}</td>
                         </tr>
                    @endforeach
               </tbody>
               <tr>
                    <td></td>
                    <td colspan="0">
                    <strong>Penjualan Aset</strong>
                    </td>
                </tr>
               <tbody>
                    @foreach ($dataC as $row)
                         <tr>
                              <td>{{ $row->id }}</td>
                              <td>{{ $row->name }}</td>
                              <td class="currency">{{ $row->ammount_debit }}</td>
                         </tr>
                    @endforeach
               </tbody>
               <tr>
                    <td></td>
                    <td colspan="0">
                    <strong>Pembelian Aset</strong>
                    </td>
                </tr>
               <tbody>
                    @foreach ($dataD as $row)
                         <tr>
                              <td>{{ $row->id }}</td>
                              <td>{{ $row->name }}</td>
                              <td class="currency">{{ $row->ammount_debit }}</td>
                         </tr>
                    @endforeach
               </tbody>
               <tr>
                    <td></td>
                    <td colspan="0">
                    <strong>Penambahan Dana</strong>
                    </td>
                </tr>
               <tbody>
                    @foreach ($dataE as $row)
                         <tr>
                              <td>{{ $row->id }}</td>
                              <td>{{ $row->name }}</td>
                              <td class="currency">{{ $row->ammount_debit }}</td>
                         </tr>
                    @endforeach
               </tbody>
               <tr>
                    <td></td>
                    <td colspan="0">
                    <strong>Pengurangan Dana</strong>
                    </td>
                </tr>
               <tbody>
                    @foreach ($dataF as $row)
                         <tr>
                              <td>{{ $row->id }}</td>
                              <td>{{ $row->name }}</td>
                              <td class="currency">{{ $row->ammount_debit }}</td>
                         </tr>
                    @endforeach
               </tbody>
          </table>
     </div>
    </div>
</x-app-layout>
