<x-app-layout>
    <x-slot name="title">
        Balance
    </x-slot>
    {{-- @include('profile.partials.update-profile-information-form')
    @include('profile.partials.update-password-form')
    @include('profile.partials.delete-user-form') --}}
    <div class="card">
     <div class="card-header">
          <button type="button" class="btn btn-sm btn-primary">
               <i class="fas fa-plus-circle"></i> Tambah Data
          </button>
     </div>
     <div class="card-body">
          <table class="table table-sm table-striped table-bordered">
               <thead class="table-dark">
                    <tr>No</tr>
                    <tr>Transaksi</tr>
                    <tr>Kredit</tr>
                    <tr>Debit</tr>
                    <tr>Aksi</tr>
               </thead>
               <tbody>
                    @foreach ($balance as $row)
                         <tr>
                              <th>{{ $loop->iteration }}</th>
                              <td>{{ $row->transaction_accounts_id }}</td>
                              <td>{{ $loop->ammount_kredit }}</td>
                              <td>{{ $loop->ammount_debit }}</td>
                              <td>a</td>
                              
                         </tr>
                    @endforeach
               </tbody>
          </table>

     </div>
    </div>
</x-app-layout>
