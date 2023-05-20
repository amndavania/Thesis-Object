<x-app-layout>
    <x-slot name="title">
        Fakultas
    </x-slot>
    <div class="card">
     <div class="card-header">
          <div class="text-center">
               <h4>Tambah Data Fakultas</h4>
          </div>
     </div>
     <div class="card-body">
          <form class="mx-2 p-4" action="{{ route('faculty.store') }}" method="POST">
          {{-- <form method="POST" class="mx-2 p-4" action="{{ url('faculty') }}"> --}}
               @csrf
          <div class="form-group">
               <label for="name">Nama Fakultas</label>
               <input type="text" class="form-control" id="name" placeholder="Nama Fakultas...">
          </div>
          <div class="d-flex justify-content-end">
               <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
          </form>
     </div>
    </div>
</x-app-layout>
