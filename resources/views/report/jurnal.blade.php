<x-app-layout>
    <x-slot name="title">
        Jurnal
    </x-slot>
    <div class="card">
        <div class="card-header">
            <div class="d-flex">
              @include('message.flash-message')
              <a href="{{ url('jurnal/export') }}" target="_blank" class="btn btn-sm btn-primary ml-auto p-2">Export PDF</a>
            </div>
       </div>
     <div class="card-body">
          <table class="table table-striped ">
               <thead class="table-dark">
                    <tr>
                         <th>No</th>
                         <td>Tanggal</td>
                         <td>Nama Akun</td>
                         <td>ID Akun</td>
                         <td>Ref</td>
                         <td>Debit</td>
                         <td>Kredit</td>
                    </tr>
               </thead>
               <tbody>
                    @foreach ($transaction as $row)
                         <tr>
                              <th>{{ $loop->iteration }}</th>
                              <td>{{ $row->created_at }}</td>
                              <td>{{ $row->transactionaccount->name }}</td>
                              <td>{{ $row->id }}</td>
                              <td>{{ $row->reference_number }}</td>
                              <td class="currency">{{ $row->type == 'Debit' ? $row->amount : null }}</td>
                              <td class="currency">{{ $row->type == 'Kredit' ? $row->amount : null }}</td>
                         </tr>
                    @endforeach
               </tbody>
          </table>
     </div>
    </div>
</x-app-layout>
