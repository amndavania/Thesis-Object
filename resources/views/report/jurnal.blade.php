<x-app-layout>
    <x-slot name="title">
        Fakultas
    </x-slot>
    <a href="" @click.prevent="printme" target="_blank" class="btn btn-info btn-md">Download Jurnal</a>
    <div class="card">
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
                    @foreach ($transaksi as $row)
                         <tr>
                              <th>{{ $loop->iteration }}</th>
                              <td>{{ $row->created_at }}</td>
                              <td>{{ $row->transactionaccount->name }}</td>
                              <td>{{ $row->id }}</td>
                              <td>{{ $row->reference_number }}</td>
                              <td>{{ $row->type == 'Debit' ? 'Rp ' . number_format($row->amount, 0, ',', '.') : null }}</td>
                              <td>{{ $row->type == 'Kredit' ? 'Rp ' . number_format($row->amount, 0, ',', '.') : null }}</td>
                         </tr>
                    @endforeach
               </tbody>
          </table>
     </div>
    </div>
</x-app-layout>
