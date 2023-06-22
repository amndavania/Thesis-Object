<x-app-layout>
    <x-slot name="title">
        Fakultas
    </x-slot>
    <div class="card">
     <div class="card-header">
          <div class="text-center">
               <h4>Ubah Data Fakultas</h4>
          </div>
     </div>
     <div class="card-body">
        @include('message.form-message')
          <form method="POST" class="mx-2 p-4" action="{{ route('faculty.update', $faculty->id) }}">
               @csrf
               @method('PUT')
          <div class="form-group">
               <label for="name">Nama Fakultas</label>
               <input type="text" class="form-control" id="name" name="name" placeholder="Nama Fakultas..." value="{{ old('name', $faculty->name) }}">
          </div>
          <div class="d-flex justify-content-end">
               <button type="button" class="btn btn-outline-danger mr-2" onclick="window.location='{{ route('faculty.index') }}'">Batal</button>
               <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
          </form>
     </div>
    </div>
</x-app-layout>
