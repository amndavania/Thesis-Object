<x-app-layout>
    <x-slot name="title">
        Program Studi
    </x-slot>
    <div class="card">
     <div class="card-header">
          <div class="text-center">
               <h4>Tambah Data</h4>
          </div>
     </div>
     <div class="card-body">
          <form class="mx-2 p-4" action="{{ route('study_program.store') }}" method="POST">
          {{-- <form method="POST" class="mx-2 p-4" action="{{ url('study_program') }}"> --}}
               @csrf
          <div class="form-group">
               <label for="name">Nama</label>
               <input type="text" class="form-control" id="name" placeholder="Nama...">
          </div>
          <div class="form-group">
               <label for="fakultas">Deskripsi</label>
               <input type="text" class="form-control" id="fakultas" placeholder="Deskripsi...">
          </div>
          <div class="d-flex justify-content-end">
               <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
          </form>
     </div>
    </div>
</x-app-layout>
