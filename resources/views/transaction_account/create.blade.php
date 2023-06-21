<x-app-layout>
    <x-slot name="title">
        Akun Transaksi
    </x-slot>
    <div class="card">
     <div class="card-header">
          <div class="text-center">
               <h4>Tambah Data Akun Transaksi</h4>
          </div>
     </div>
     <div class="card-body">
            @include('message.form-message')
          <form method="POST" class="mx-2 p-4" action="{{ url('transaction_account') }}">
               @csrf
          <div class="form-group">
               <label for="id">ID Akun</label>
               <input type="text" class="form-control" id="id" name="id" placeholder="Masukkan ID akun" value="{{ old('id') }}">
          </div>
          <div class="form-group">
               <label for="name">Nama Akun</label>
               <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan nama akun" value="{{ old('name') }}">
          </div>
          <div class="form-group">
               <label for="description">Deskripsi</label>
               <input type="text" class="form-control" id="description" name="description" placeholder="Masukkan deskripsi" value="{{ old('description') }}">
          </div>
          <div class="form-group">
            <label for="accounting_group_id">Grup</label>
            {{-- <select class="form-control" id="accounting_group_id" name="accounting_group_id[]" multiple> --}}
            <select class="form-control" id="accounting_group_id" name="accounting_group_id">
                @foreach ($accounting_group as $item)
                     <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
           </select>
          </div>
          <input type="hidden" name="ammount_kredit" value="0">
          <input type="hidden" name="ammount_debit" value="0">
          <div class="d-flex justify-content-end">
            <button type="button" class="btn btn-outline-danger mr-2" onclick="window.location='{{ route('transaction_account.index') }}'">Batal</button>
               <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
          </form>
     </div>
    </div>
</x-app-layout>
