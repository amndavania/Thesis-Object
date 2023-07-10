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
        @include('message.form-message')
          <form class="mx-2 p-4" action="{{ route('student.store') }}" method="POST">
               @csrf
          <div class="form-group">
               <label for="name">Nama Mahasiswa</label>
               <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan nama mahasiswa" value="{{ old('name') }}">
          </div>
          <div class="form-group">
               <label for="nim">NIM</label>
               <input type="text" class="form-control" id="nim" name="nim" placeholder="Masukkan NIM" value="{{ old('nim') }}">
          </div>
          <div class="form-group">
               <label for="force">Tahun Masuk</label>
               <input type="number" class="form-control" id="force" name="force" placeholder="Masukkan tahun masuk" value="{{ old('force') }}">
          </div>
          <div class="form-group">
            <label for="study_program_id">Program Studi</label>
            <select class="form-control" id="study_program_id" name="study_program_id">
                <option value="">Pilih Program Studi</option>
                @foreach ($study_program as $item)
                    <option value="{{ $item->id }}" {{ old('study_program_id') == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="dpa_id">DPA</label>
            <select class="form-control selectpicker" id="dpa_id" name="dpa_id" data-live-search="true">
                <option value="">Pilih DPA</option>
                @foreach ($dpa as $item)
                    <option value="{{ $item->id }}" {{ old('dpa_id') == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                @endforeach
            </select>
        </div>
        
          <div class="form-group">
               <label for="student_types_id">Skema Pembayaran</label>
               <select class="form-control" id="student_types_id" name="student_types_id">
                <option value="">Pilih Skema Pembayaran</option>
                @foreach ($student_type as $item)
                    <option value="{{ $item->id }}" data-year="{{ $item->year }}" {{ old('student_types_id') == $item->id ? 'selected' : '' }}>
                        {{ $item->year . ' | ' . $item->studyprogram->name . ' | ' . $item->type}}
                    </option>
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
    <script>
        document.getElementById('force').addEventListener('change', function() {
            var year = this.value;
            var studentTypesSelect = document.getElementById('student_types_id');
            
            for (var i = 0; i < studentTypesSelect.options.length; i++) {
                var option = studentTypesSelect.options[i];
                var optionYear = option.getAttribute('data-year');
                
                if (optionYear == year) {
                    option.style.display = 'block';
                } else {
                    option.style.display = 'none';
                }
            }
            
            studentTypesSelect.selectedIndex = 0;
        });
    </script>
</x-app-layout>
