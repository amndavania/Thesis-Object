<x-app-layout>
    <x-slot name="title">
        Fakultas
    </x-slot>
    {{-- @include('profile.partials.update-profile-information-form')
    @include('profile.partials.update-password-form')
    @include('profile.partials.delete-user-form') --}}
    <div class="card">
     <div class="card-header">
          <div class="text-center">
               <h4>Ubah Data Fakultas</h4>
          </div>
     </div>
     <div class="card-body">
          {{-- <form method="POST" class="mx-2 p-4" action="/faculty/store"> --}}
          <form method="POST" class="mx-2 p-4" action="{{ route('faculty.edit',$faculty->id) }}">
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
