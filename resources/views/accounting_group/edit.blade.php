<x-app-layout>
    <x-slot name="title">
        Akun Akuntansi
    </x-slot>
    <div class="card">
     <div class="card-header">
          <div class="text-center">
               <h4>Ubah Data</h4>
          </div>
     </div>
     <div class="card-body">
          {{-- <form method="POST" class="mx-2 p-4" action="/"> --}}
               {{-- {{ $accounting_group }} --}}
          {{-- <form method="post" class="mx-2 p-4" action="{{ url('accounting_group/' .$accounting_group->id) }}"> --}}
          <form method="post" class="mx-2 p-4" action="{{ route('accounting_group.update', $accounting_group->id) }}">
          {{-- <form method="post" class="mx-2 p-4" action="{{ route('accounting_group.update', $accounting_group->id) }}"> --}}
               @csrf
               @method('put')
          <div class="form-group">
               <label for="id">ID Akun</label>
               <input type="text" class="form-control" id="id" placeholder="ID Akun..." value="{{ old('id', $accounting_group->id) }}">
          </div>
          <div class="form-group">
               <label for="name">Nama Akun</label>
               <input type="text" class="form-control" id="name" placeholder="Nama Akun..." value="{{ old('name', $accounting_group->name) }}">
          </div>
          <div class="form-group">
               <label for="description">Deskripsi</label>
               <input type="text" class="form-control" id="description" placeholder="Deskripsi..." value="{{ old('description', $accounting_group->description) }}">
          </div>
          <div class="d-flex justify-content-end">
               <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
          </form>
     </div>
    </div>
</x-app-layout>
