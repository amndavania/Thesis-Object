<x-app-layout>
    <x-slot name="title">
      Buku Besar
    </x-slot>
    <div class="card">
         <div class="card-body">
          <a href="" @click.prevent="printme" target="_blank" class="btn btn-info btn-md mb-3 ">Download Buku Besar</a>
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
