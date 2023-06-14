<x-app-layout>
    <x-slot name="title">
        Pemasukan Mahasiswa
    </x-slot>
    <div class="card">
     <div class="card-header">
          <div class="text-center">
               <h4>Ubah Data</h4>
          </div>
     </div>
     <div class="card-body">
        @include('message.form-message')
          <form method="POST" class="mx-2 p-4" action="{{ route('ukt.update', $ukt->id) }}">
               @csrf
               @method('PUT')
          <div class="form-group">
               <label for="students_id">Mahasiswa</label>
               <input type="text" class="form-control" id="students_id" name="students_id" placeholder="{{ $ukt->student_id->nim }} {{ $ukt->student_id->name }}" readonly>
          </div>
          <div class="form-group">
               <label for="semester">Semester</label>
               <input type="number" class="form-control" id="semester" name="semester" value="{{ old('semester', $ukt->semester) }}">
          </div>
          <div class="form-group">
               <label for="reference_number">Reference Number</label>
               <input type="number" class="form-control" id="reference_number" name="reference_number" value="{{ old('reference_number', $ukt->reference_number) }}">
          </div>
          <div class="form-group">
               <label for="amount">Jumlah</label>
               <input type="number" class="form-control" id="amount" name="amount" value="{{ old('amount', $ukt->amount) }}">
          </div>
          <div class="form-group">
               <label for="total">Total</label>
               <input type="number" class="form-control" id="total" name="total" value="{{ old('total', $ukt->total) }}">
          </div>
          <div class="form-group">
               <label for="status">Status</label>
               <input type="text" class="form-control" id="status" name="status" value="{{ old('status', $ukt->status) }}">
          </div>
          <div class="form-group">
               <label for="transaction_accounts_id">Akun Transaksi</label>
               <select class="form-control" id="transaction_accounts_id" name="transaction_accounts_id">
                    @foreach ($transaction_account as $item)
                         <option value="{{ $item->id }}" {{ $ukt->transaction_accounts_id == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                    @endforeach
               </select>
          </div>
          <div class="d-flex justify-content-end">
               <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
          </form>
     </div>
    </div>
</x-app-layout>
