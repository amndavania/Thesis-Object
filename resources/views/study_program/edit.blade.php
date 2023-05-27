<x-app-layout>
    <x-slot name="title">
        Program Studi
    </x-slot>
    <div class="card">
     <div class="card-header">
          <div class="text-center">
               <h4>Ubah Data</h4>
          </div>
     </div>
     <div class="card-body">
          {{-- <form method="POST" class="mx-2 p-4" action="/study_program/store"> --}}
          <form method="POST" class="mx-2 p-4" action="{{ route('study_program.update', $study_program->id) }}">
               @csrf
               @method('PUT')
          <div class="form-group">
               <label for="name">Nama Akun</label>
               <input type="text" class="form-control" id="name" name="name" placeholder="Nama Akun..." value="{{ old('name', $study_program->name) }}">
          </div>
           <div class="form-group">
               <label for="fakultas">Fakultas</label>
               <select class="form-control" id="fakultas" name="fakultas">
                    @foreach ($faculty as $item) 
                         <option value="{{ $item->id }}" {{ $study_program->faculty_id == $item->id ? 'selected' : '' }}>{{ $item->name }}</option> 
                    @endforeach
               </select>
          </div>
          <div class="d-flex justify-content-end">
               <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
          </form>
     </div>
    </div>
</x-app-layout>
