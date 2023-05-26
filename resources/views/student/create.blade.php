<x-app-layout>
    <x-slot name="title">
        Mahasiswa
    </x-slot>
    <div class="card">
     <div class="card-header">
          <div class="text-center">
               <h4>Tambah Data</h4>
          </div>
     </div>
     <div class="card-body">
          <form class="mx-2 p-4" action="{{ route('student.store') }}" method="POST">
               @csrf
          <div class="form-group">
               <label for="name">Nama</label>
               <input type="text" class="form-control" id="name" name="name" placeholder="Nama...">
          </div>
          <div class="form-group">
               <label for="name">NIM</label>
               <input type="text" class="form-control" id="name" name="nim" placeholder="NIM...">
          </div>
          <div class="form-group">
               <label for="name">Angkatan</label>
               <input type="number" class="form-control" id="name" name="force" placeholder="Angkatan...">
          </div>
          <div class="form-group">
               <label for="study_program">Program Studi</label>
               <select class="form-control" id="study_program" name="study_program">
                    @foreach ($study_program as $item) 
                         <option value="{{ $item->id }}">{{ $item->name }}</option> 
                    @endforeach
               </select>
          </div>
          <div class="form-group">
               <label for="student_type">Tipe</label>
               <select class="form-control" id="student_type" name="student_type">
                    @foreach ($student_type as $item) 
                         <option value="{{ $item->id }}">{{ $item->type }}</option> 
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
