<x-app-layout>
    <x-slot name="title">
        Grup Akun Transaksi
    </x-slot>
    <div class="card">
     <div class="card-header">
          <div class="d-flex">
                @include('message.flash-message')
          </div>
     </div>
     <div class="card-body">
          <table class="table table-striped ">
               <thead class="table-dark">
                    <tr>
                         <th>No</th>
                         <td>Nama</td>
                         <td>Deskripsi</td>
                    </tr>
               </thead>
               <tbody>
                    @foreach ($accounting_group as $index => $row)
                    @php
                        $number = ($accounting_group->currentPage() - 1) * $accounting_group->perPage() + $index + 1;
                    @endphp
                         <tr>
                              <th>{{ $number }}</th>
                              <td>{{ $row->name }}</td>
                              <td>{{ $row->description ? $row->description : '-' }}</td>
                         </tr>
                    @endforeach
               </tbody>
          </table>
          <div class="d-flex justify-content-center align-items-center text-center">
               {{ $accounting_group->links() }}
          </div>

     </div>
    </div>
</x-app-layout>
