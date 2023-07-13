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
        @include('message.form-message')
          <form class="mx-2 p-4" action="{{ route('study_program.store') }}" method="POST">
               @csrf
          <div class="form-group">
               <label for="name">Nama Program Studi</label>
               <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan nama program studi" value="{{ old('name') }}">
          </div>
          <div class="form-group">
               <label for="name">Nama Kaprodi</label>
               <input type="text" class="form-control" id="kaprodi_name" name="kaprodi_name" placeholder="Masukkan nama kepala program studi" value="{{ old('kaprodi_name') }}">
          </div>
          <div class="form-group">
               <label for="faculty_id">Fakultas</label>
               <select class="form-control" id="faculty_id" name="faculty_id">
                <option value="">Pilih Fakultas</option>
                    @foreach ($faculty as $item)
                         <option value="{{ $item->id }}" {{ old('faculty_id') == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                    @endforeach
               </select>
          </div>

          <div class="d-flex justify-content-end">
               <button type="button" class="btn btn-outline-danger mr-2" onclick="window.location='{{ route('study_program.index') }}'">Batal</button>
               <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
          </form>
     </div>
    </div>
</x-app-layout>
