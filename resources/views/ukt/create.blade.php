<x-app-layout>
    <x-slot name="title">
        Pemasukan UKT Mahasiswa
    </x-slot>
    <div class="card">
     <div class="card-header">
          <div class="text-center">
               <h4>Tambah Data</h4>
          </div>
     </div>
     <div class="card-body">
        @include('message.form-message')
          <form class="mx-2 p-4" action="{{ route('ukt.store') }}" method="POST">
               @csrf
          <div class="form-group">
               <label for="students_id">Mahasiswa</label>
               <select class="form-control" id="students_id" name="students_id">
                    @foreach ($student as $item)
                         <option value="{{ $item->id }}">{{ $item->nim }} {{ $item->name }}</option>
                    @endforeach
               </select>
          </div>
          <div class="form-group">
               <label for="semester">Semester</label>
               <input type="number" class="form-control" id="semester" name="semester" placeholder="Semester..." value="{{ old('semester') }}">
          </div>
          <div class="form-group">
               <label for="reference_number">Reference Number</label>
               <input type="number" class="form-control" id="reference_number" name="reference_number" placeholder="Reference Number..." value="{{ old('reference_number') }}">
          </div>
          <div class="form-group">
               <label for="amount">Jumlah</label>
               <input type="number" class="form-control" id="amount" name="amount" placeholder="Jumlah..." value="{{ old('amount') }}">
          </div>
          <div class="form-group">
               <label for="total">Total</label>
               <input type="number" class="form-control" id="total" name="total" placeholder="Total..." value="{{ old('total') }}">
          </div>
          <div class="form-group">
               <label for="status">Status</label>
               <input type="text" class="form-control" id="status" name="status" placeholder="Status..." value="{{ old('status') }}">
          </div>
          <div class="form-group">
               <label for="transaction_accounts_id">Akun Transaksi</label>
               <select class="form-control" id="transaction_accounts_id" name="transaction_accounts_id">
                    @foreach ($transaction_account as $item)
                         <option value="{{ $item->id }}">{{ $item->name }}</option>
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
