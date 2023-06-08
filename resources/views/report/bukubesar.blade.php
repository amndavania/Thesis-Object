<x-app-layout>
    <x-slot name="title">
      Buku Besar
    </x-slot>
    <div class="card">
     <div class="card-header">
          <div class="d-flex">
            <form class="form-inline" action="{{ route('bukubesar.index') }}" method="GET">
                <label class="sr-only" for="search_account">Akun Transaksi</label>
                <div class="mb-2 mr-sm-2">
                    <select class="form-control selectpicker" name="search_account" id="search_account" data-live-search="true">
                        @foreach ($selects as $id => $name)
                            <option value="{{ $id }}">{{ $name }}</option>
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
                         <td>Uraian</td>
                         <td>Debit</td>
                         <td>Kredit</td>
                    </tr>
               </thead>
               <tbody>
                    @foreach ($data as $row)
                         <tr>
                              <th>{{ $loop->iteration }}</th>
                              <td>{{ $row->created_at }}</td>
                              <td>{{ $row->description }}</td>
                              @if ($row->type == "debit")
                                <td class="currency">{{ $row->amount }}</td>
                                <td>-</td>
                              @else
                                <td>-</td>
                                <td class="currency">{{ $row->amount }}</td>
                              @endif

                         </tr>
                    @endforeach
               </tbody>
          </table>
     </div>
    </div>
</x-app-layout>
