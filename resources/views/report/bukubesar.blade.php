<x-app-layout>
    <x-slot name="title">
      Buku Besar
    </x-slot>
    <div class="card">
     <div class="card-header">
          <div class="d-flex">
            @include('message.flash-message')
            <a href="{{ url('bukubesar/export') }}" target="_blank" class="btn btn-sm btn-primary ml-auto p-2">Export PDF</a>
          </div>
     </div>
         <div class="card-body">
          {{-- <a href="" @click.prevent="printme" target="_blank" class="btn btn-info btn-md mb-3 ">Download Buku Besar</a> --}}
          <table class="table table-striped ">
               <thead class="table-dark">
                    <tr>
                         <td>No</td>
                         <td>Nama Akun</td>
                         <td>ID Akun</td>
                         <td>Keterangan</td>
                         <td>Debit</td>
                         <td>Kredit</td>
                         <td>Saldo</td>
                    </tr>
               </thead>
               <tbody>
                    @foreach ($data as $row)
                         <tr>
                              <th>{{ $loop->iteration }}</th>
                              <td>{{ $row->name }}</td>
                              <td>{{ $row->id }}</td>
                              <td>{{ $row->description }}</td>
                              <td class="currency">{{ $row->ammount_debit }}</td>
                              <td class="currency">{{ $row->ammount_kredit }}</td>
                              <td class="currency">{{ $row->ammount_debit - $row->ammount_kredit }}</td>
                         </tr>
                    @endforeach
               </tbody>
          </table>
     </div>
    </div>
</x-app-layout>
