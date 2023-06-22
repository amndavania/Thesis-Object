<x-app-layout>
    <x-slot name="title">
        Mahasiswa
    </x-slot>
    <div class="card">
     <div class="card-header">
          <div class="text-center">
               <h4>Ubah Data</h4>
          </div>
     </div>
     <div class="card-body">
        @include('message.form-message')
          <form method="POST" class="mx-2 p-4" action="{{ route('student.update', $student->id) }}">
               @csrf
               @method('PUT')
          <div class="form-group">
               <label for="name">Nama</label>
               <input type="text" class="form-control" id="name" name="name" placeholder="Nama..." value="{{ old('name', $student->name) }}">
          </div>
          <div class="form-group">
               <label for="nim">NIM</label>
               <input type="text" class="form-control" id="name" name="nim" placeholder="NIM..." value="{{ old('nim', $student->nim) }}">
          </div>
          <div class="form-group">
               <label for="force">Tahun Masuk</label>
               <input type="number" class="form-control" id="name" name="force" placeholder="Angkatan..." value="{{ old('force', $student->force) }}">
          </div>
          <div class="form-group">
          <label for="study_program_id">Program Studi</label>
          <select class="form-control" id="study_program_id" name="study_program_id">
               @foreach ($study_program as $item)
                    <option value="{{ $item->id }}" {{ $student->study_program_id == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
               @endforeach
          </select>
          </div>
          <div class="form-group">
          <label for="student_types_id">Tipe Mahasiswa</label>
          <select class="form-control" id="student_types_id" name="student_types_id">
               @foreach ($student_type as $item)
                    <option value="{{ $item->id }}" {{ $student->student_types_id == $item->id ? 'selected' : '' }}>{{ $item->type }}</option>
               @endforeach
          </select>
          </div>
          <div class="d-flex justify-content-end">
            <button type="button" class="btn btn-outline-danger mr-2" onclick="window.location='{{ route('student.index') }}'">Batal</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
          
          </form>
     </div>
    </div>
</x-app-layout>
