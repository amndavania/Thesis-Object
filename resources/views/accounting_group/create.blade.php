<x-app-layout>
    <x-slot name="title">
        Grup Akun Transaksi
    </x-slot>
    <div class="card">
     <div class="card-header">
          <div class="text-center">
               <h4>Tambah Data Grup Akun Transaksi</h4>
          </div>
     </div>
     <div class="card-body">
            @include('message.form-message')
          <form method="POST" class="mx-2 p-4" action="{{ url('accounting_group') }}">
               @csrf
          <div class="form-group">
               <label for="name">Nama Grup</label>
               <input type="text" class="form-control" id="name" name="name" placeholder="Nama Grup..." value="{{ old('name') }}">
          </div>
          <div class="form-group">
               <label for="description">Deskripsi</label>
               <input type="text" class="form-control" id="description" name="description" placeholder="Deskripsi..." value="{{ old('description') }}">
          </div>
          <div class="d-flex justify-content-end">
               <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
          </form>
     </div>
    </div>
</x-app-layout>
