<x-app-layout>
    <x-slot name="title">
        Fakultas
    </x-slot>
    <div class="card">
     <div class="card-header">
          <div class="text-center">
               <h4>Tambah Data Akun Akuntasi</h4>
          </div>
     </div>
     <div class="card-body">
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
          <form method="POST" class="mx-2 p-4" action="{{ url('accounting_group') }}">
               @csrf
          <div class="form-group">
               <label for="id">ID Akun</label>
               <input type="text" class="form-control" id="id" name="id" placeholder="ID Akun...">
          </div>
          <div class="form-group">
               <label for="name">Nama Akun</label>
               <input type="text" class="form-control" id="name" name="name" placeholder="Nama Akun...">
          </div>
          <div class="form-group">
               <label for="description">Deskripsi</label>
               <input type="text" class="form-control" id="description" name="description" placeholder="Deskripsi...">
          </div>
          <div class="d-flex justify-content-end">
               <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
          </form>
     </div>
    </div>
</x-app-layout>
