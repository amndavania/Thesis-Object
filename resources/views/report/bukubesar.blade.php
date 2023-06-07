<x-app-layout>
    <x-slot name="title">
      Buku Besar
    </x-slot>
    <div class="card">
     <div class="card-header">
          <div class="d-flex">
            <form class="form-inline" action="bukubesar/search" method="GET">
                <label class="sr-only" for="search_account">Akun Transaksi</label>
                <div class="mb-2 mr-sm-2">
                    <select class="form-control selectpicker" name="search_account" id="search_account" data-live-search="true">
                        @foreach ($selects as $row)
                            <option value="{{ $row->id }}">{{ $row->name }}</option>
                        @endforeach
                    </select>
                </div>
                <label class="sr-only" for="datepicker">Bulan</label>
                <input type="text" class="form-control mb-2 mr-sm-2" id="datepicker" name="datepicker">

                <button type="submit" class="btn btn-primary mb-2">Cari</button>
              </form>

              <button onclick="window.open('{{ url('bukubesar/export') }}', '_blank')" class="btn btn-sm btn-primary ml-auto p-2">Export PDF</button>
          </div>
     </div>
         <div class="card-body">
          {{-- <a href="" @click.prevent="printme" target="_blank" class="btn btn-info btn-md mb-3 ">Download Buku Besar</a> --}}
          <table class="table table-striped ">
               <thead class="table-dark">
                    <tr>
                         <th>No</th>
                         <td>Tanggal</td>
                         <td>Nama Akun</td>
                         <td>ID Akun</td>
                         <td>Debit</td>
                         <td>Kredit</td>
                    </tr>
               </thead>
               <tbody>
                    @foreach ($data as $row)
                         <tr>
                              <th>{{ $loop->iteration }}</th>
                              <td>{{ $row->created_at }}</td>
                              <td>{{ $row->name }}</td>
                              <td>{{ $row->id }}</td>
                              <td class="currency">{{ $row->ammount_debit }}</td>
                              <td class="currency">{{ $row->ammount_kredit }}</td>
                         </tr>
                    @endforeach
               </tbody>
          </table>
     </div>
    </div>
</x-app-layout>
