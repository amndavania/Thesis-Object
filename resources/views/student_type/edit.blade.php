<x-app-layout>
    <x-slot name="title">
        Beasiswa/Status Mahasiswa
    </x-slot>
    <div class="card">
     <div class="card-header">
          <div class="text-center">
               <h4>Ubah Data</h4>
          </div>
     </div>
     <div class="card-body">
        @include('message.form-message')
          <form method="post" class="mx-2 p-4" action="{{ route('student_type.update', $student_type->id) }}">
               @csrf
               @method('put')
          <div class="form-group">
               <label for="type">Nama Beasiswa</label>
               <input type="text" class="form-control" name="type" id="type" placeholder="Nama Akun..." value="{{ old('type', $student_type->type) }}">
          </div>
          <div class="form-group">
            <label for="year">Tahun Masuk</label>
            <input type="number" class="form-control" id="year" name="year" placeholder="Tahun Masuk..." value="{{ old('year', $student_type->year) }}">
        </div>
        <div class="form-group">
            <label for="study_program_id">Program Studi</label>
            <select class="form-control" id="study_program_id" name="study_program_id">
                 @foreach ($study_program as $item)
                      <option value="{{ $item->id }}" {{ $student_type->study_program_id == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                 @endforeach
            </select>
       </div>
          <div class="form-group">
               <label for="dpp">DPP</label>
               <input type="number" class="form-control" id="dpp" name="dpp" placeholder="Biaya DPP..."  value="{{ old('dpp', $student_type->dpp) }}">
          </div>
          <div class="form-group">
               <label for="krs">KRS</label>
               <input type="number" class="form-control" id="krs" name="krs" placeholder="Biaya KRS..." value="{{ old('krs', $student_type->krs) }}">
          </div>
          <div class="form-group">
               <label for="uts">Biaya UTS</label>
               <input type="number" class="form-control" id="uts" name="uts" placeholder="Biaya UTS..."  value="{{ old('uts', $student_type->uts) }}">
          </div>
          <div class="form-group">
               <label for="uas">Biaya UAS</label>
               <input type="number" class="form-control" id="uas" name="uas" placeholder="Biaya UAS..."  value="{{ old('uas', $student_type->uas) }}">
          </div>
          <div class="form-group">
               <label for="wisuda">Biaya Wisuda</label>
               <input type="number" class="form-control" id="wisuda" name="wisuda" placeholder="Biaya Wisuda..."  value="{{ old('wisuda', $student_type->wisuda) }}">
          </div>
          <div class="d-flex justify-content-end">
               <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
          </form>
     </div>
    </div>
</x-app-layout>
