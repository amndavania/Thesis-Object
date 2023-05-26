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
            @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <h4 class="alert-heading">Gagal! Perhatikan ketentuan berikut:</h4>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
          <form method="post" class="mx-2 p-4" action="{{ route('accounting_group.update', $accounting_group->id) }}">
          {{-- <form method="post" class="mx-2 p-4" action="{{ route('accounting_group.update', $accounting_group->id) }}"> --}}
               @csrf
               @method('put')
          <div class="form-group">
               <label for="id">ID Akun</label>
               <input type="text" class="form-control" name="id" id="id" placeholder="ID Akun..." value="{{ old('id', $accounting_group->id) }}">
          </div>
          <div class="form-group">
               <label for="name">Nama Akun</label>
               <input type="text" class="form-control" name="name" id="name" placeholder="Nama Akun..." value="{{ old('name', $accounting_group->name) }}">
          </div>
          <div class="form-group">
               <label for="description">Deskripsi</label>
               <input type="text" class="form-control" name="description" id="description" placeholder="Deskripsi..." value="{{ old('description', $accounting_group->description) }}">
          </div>
          <div class="d-flex justify-content-end">
               <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
          </form>
     </div>
    </div>
</x-app-layout>
