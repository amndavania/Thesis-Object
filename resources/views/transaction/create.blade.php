<x-app-layout>
    <x-slot name="title">
        Transaksi
    </x-slot>
    <div class="card">
     <div class="card-header">
          <div class="text-center">
               <h4>Tambah Data</h4>
          </div>
     </div>
     <div class="card-body">
        @include('message.form-message')
          <form class="mx-2 p-4" action="{{ route('transaction.store') }}" method="POST">
               @csrf
          <div class="form-group">
               <label for="description">Deskripsi</label>
               <input type="text" class="form-control" id="description" name="description" placeholder="Transaksinya untuk apa?" value="{{ old('description') }}">
          </div>
          <div class="form-group">
               <label for="created_at">Tanggal Pembayaran</label>
               <input type="date" class="form-control mb-2" id="created_at" name="created_at" max="<?= date('Y-m-d'); ?>" value="<?php echo date('Y-m-d'); ?>">
          </div>
          <div class="form-group">
               <label for="reference_number">Nomor Referensi</label>
               <input type="number" class="form-control" id="reference_number" name="reference_number" placeholder="Masukkan nomor referensi" value="{{ old('reference_number') }}">
          </div>
          <div class="form-group">
               <label for="amount">Nominal</label>
               <input type="number" class="form-control" id="amount" name="amount" placeholder="Masukkan nominal uang" value="{{ old('amount') }}">
          </div>
          <div class="form-group">
            <label for="type">Tipe</label>
            <select class="form-control" id="type" name="type">
                <option value="">Pilih Tipe Transaksi</option>
                <option value="debit" {{ old('type') == "debit" ? 'selected' : '' }}>Debit</option>
                <option value="kredit" {{ old('type') == "kredit" ? 'selected' : '' }}>Kredit</option>
            </select>
       </div>
          <div class="form-group">
               <label for="transaction_accounts_id">Akun Transaksi</label>
               <select class="form-control" id="transaction_accounts_id" name="transaction_accounts_id">
                <option value="">Pilih Akun Transaksi</option>
                    @foreach ($transaction_account as $item)
                         <option value="{{ $item->id }}" {{ old('transaction_accounts_id') == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                    @endforeach
               </select>
          </div>
          <div class="d-flex justify-content-end">
               <button type="button" class="btn btn-outline-danger mr-2" onclick="window.location='{{ route('transaction.index') }}'">Batal</button>
               <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
          </form>
     </div>
    </div>
</x-app-layout>
