<x-app-layout>
    <x-slot name="title">
        Skema Pembayaran
    </x-slot>
    <div class="card">
     <div class="card-header">
          <div class="text-center">
               <h4>Tambah Data</h4>
          </div>
     </div>
     <div class="card-body">
        @include('message.form-message')
          <form method="POST" class="mx-2 p-4" action="{{ url('student_type') }}">
               @csrf
          <div class="form-group">
               <label for="name">Nama Program</label>
               <input type="text" class="form-control" id="name" name="type" placeholder="Masukkan nama program" value="{{ old('name') }}">
          </div>
          <div class="form-group">
            <label for="year">Tahun</label>
            <input type="number" class="form-control" id="year" name="year" placeholder="Untuk mahasiswa angkatan berapa?" value="{{ old('year') }}">
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
               <label for="dpp">DPP</label>
               <input type="number" class="form-control" id="dpp" name="dpp" placeholder="Masukkan biaya DPP" value="{{ old('dpp') }}">
          </div>
          <div class="form-group">
               <label for="krs">KRS</label>
               <input type="number" class="form-control" id="krs" name="krs" placeholder="Masukkan biaya saat KRS" value="{{ old('krs') }}">
          </div>
          <div class="form-group">
               <label for="uts">Biaya UTS</label>
               <input type="number" class="form-control" id="uts" name="uts" placeholder="Masukkan biaya saat UTS" value="{{ old('uts') }}">
          </div>
          <div class="form-group">
               <label for="uas">Biaya UAS</label>
               <input type="number" class="form-control" id="uas" name="uas" placeholder="Masukkan biaya saat UAS" value="{{ old('uas') }}">
          </div>
          <div class="form-group">
               <label for="wisuda">Biaya Wisuda</label>
               <input type="number" class="form-control" id="wisuda" name="wisuda" placeholder="Masukkan biaya Wisuda" value="{{ old('wisuda') }}">
          </div>
          <div class="d-flex justify-content-end">
            <button type="button" class="btn btn-outline-danger mr-2" onclick="window.location='{{ route('student_type.index') }}'">Batal</button>
               <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
          </form>
     </div>
    </div>
</x-app-layout>
