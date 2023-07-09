<x-app-layout>
    <x-slot name="title">
    Dosen Pembimbing Akademik
    </x-slot>
    <div class="card">
     <div class="card-header">
          <div class="text-center">
               <h4>Tambah Data</h4>
          </div>
     </div>
     <div class="card-body">
        @include('message.form-message')
          <form class="mx-2 p-4" action="{{ route('dpa.store') }}" method="POST">
               @csrf
          <div class="form-group">
               <label for="name">Nama DPA</label>
               <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan nama mahasiswa" value="{{ old('name') }}">
          </div>
          <div class="form-group">
               <label for="email">Email</label>
               <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan Email" value="{{ old('email') }}">
          </div>
          <div class="d-flex justify-content-end">
            <button type="button" class="btn btn-outline-danger mr-2" onclick="window.location='{{ route('student.index') }}'">Batal</button>
               <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
          </form>
     </div>
    </div>
</x-app-layout>
