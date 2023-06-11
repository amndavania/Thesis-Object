<x-app-layout>
    <x-slot name="title">
        Pemasukan
    </x-slot>
    <div class="card">
     <div class="card-header">
          <div class="text-center">
               <h4>Ubah Data</h4>
          </div>
     </div>
     <div class="card-body">
        @include('message.form-message')
          <form method="POST" class="mx-2 p-4" action="{{ route('pemasukan.update', $pemasukan->id) }}">
               @csrf
               @method('PUT')
          <div class="form-group">
               <label for="description">Deskripsi</label>
               <input type="text" class="form-control" id="description" name="description" placeholder="Deskripsi..." value="{{ old('description', $pemasukan->description) }}">
          </div>
           <div class="form-group">
               <label for="reference_number">Nomor Referensi</label>
               <input type="number" class="form-control" id="reference_number" name="reference_number" placeholder="Nomor Referensi..." value="{{ old('reference_number', $pemasukan->reference_number) }}">
          </div>
          <div class="form-group">
               <label for="amount">Jumlah</label>
               <input type="number" class="form-control" id="amount" name="amount" placeholder="Jumlah..." value="{{ old('amount', $pemasukan->amount) }}" readonly>
          </div>
          <div class="form-group">
            <label for="transaction_accounts_id">Akun Transaksi</label>
            <input type="text" class="form-control" id="transaction_accounts_id" name="transaction_accounts_id" placeholder="{{ $pemasukan->transactionaccount->name }}" readonly>
          </div>
          <div class="d-flex justify-content-end">
               <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
          </form>
     </div>
    </div>
</x-app-layout>
