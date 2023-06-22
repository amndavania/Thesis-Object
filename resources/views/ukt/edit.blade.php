<x-app-layout>
    <x-slot name="title">
        Pemasukan Mahasiswa
    </x-slot>
    <div class="card">
     <div class="card-header">
          <div class="text-center">
               <h4>Ubah Data</h4>
          </div>
     </div>
     <div class="card-body">
        @include('message.form-message')
          <form method="POST" class="mx-2 p-4" action="{{ route('ukt.update', $ukt->id) }}">
               @csrf
               @method('PUT')
          <div class="form-group">
               <label for="students_id">Mahasiswa</label>
               <input type="text" class="form-control" id="students_id" name="students_id" placeholder="{{ $ukt->student_id->nim }} {{ $ukt->student_id->name }}" readonly>
          </div>
          <div class="form-group">
               <label for="semester">Semester</label>
               <input type="number" class="form-control" id="semester" name="semester" value="{{ old('semester', $ukt->semester) }}" readonly>
          </div>
          <div class="form-group">
            <label for="type">Jenis</label>
            <input type="text" class="form-control" id="type" name="type" placeholder="{{ $ukt->type }}" readonly>
       </div>
          <div class="form-group">
               <label for="reference_number">Reference Number</label>
               <input type="number" class="form-control" id="reference_number" name="reference_number" value="{{ old('reference_number', $ukt->reference_number) }}">
          </div>
          <div class="form-group">
               <label for="amount">Jumlah</label>
               <input type="number" class="form-control" id="amount" name="amount" value="{{ old('amount', $ukt->amount) }}">
          </div>
          <div class="d-flex justify-content-end">
            <button type="button" class="btn btn-outline-danger mr-2" onclick="window.location='{{ route('ukt.index') }}'">Batal</button>
               <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
          </form>
     </div>
    </div>
</x-app-layout>
