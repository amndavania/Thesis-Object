<x-app-layout>
    <x-slot name="title">
        Pembayaran Mahasiswa
    </x-slot>
    <div class="card">
     <div class="card-header">
          <div class="text-center">
               <h4>Tambah Data</h4>
          </div>
     </div>
     <div class="card-body">
        @include('message.form-message')
          <form class="mx-2 p-4" action="{{ route('ukt.store') }}" method="POST">
               @csrf
          <div class="form-group">
               <label for="students_id">Mahasiswa</label>
               <select class="form-control selectpicker" name="students_id" id="mahasiswaID" data-live-search="true" onchange="handleStudentChange()">
                <option value="">Pilih Mahasiswa</option>
                @foreach ($student as $student)
                    <option value="{{ $student->id }}"  data-force="{{ $student->force }}">{{ $student->nim . ' / ' . $student->name }}</option>
                @endforeach
            </select>
          </div>
          <div class="d-flex">
            <div class="form-group mr-3">
              <label for="year">Tahun Ajaran</label>
              <input type="text" class="form-control mb-2" id="tahunAjaran" name="year" placeholder="Pilih Tahun Ajaran" onchange="handleYearChange()" readonly>
            </div>
            <div class="form-group">
              <label for="semester">Semester</label>
              <select class="form-control" id="semester" name="semester">
                <option value="">Pilih Semester</option>
                <option value="GASAL" {{ old('semester') == 'GASAL' ? 'selected' : '' }}>GASAL</option>
                <option value="GENAP" {{ old('semester') == 'GENAP' ? 'selected' : '' }}>GENAP</option>
              </select>
            </div>
          </div>
          <div class="form-group">
               <label for="type">Jenis Pembayaran</label>
               <select class="form-control" id="type" name="type">
               <option value="">Pilih Jenis Pembayaran</option>
                    <option value="DPP" {{ old('type') == 'DPP' ? 'selected' : '' }}>DPP</option>
                    <option value="UKT" {{ old('type') == 'UKT' ? 'selected' : '' }}>UKT</option>
                    <option value="WISUDA" {{ old('type') == 'WISUDA' ? 'selected' : '' }}>WISUDA</option>
               </select>
          </div>
          <div class="form-group">
               <label for="created_at">Tanggal Pembayaran</label>
               <input type="date" class="form-control mb-2" id="created_at" name="created_at" max="<?= date('Y-m-d'); ?>" value="<?php echo date('Y-m-d'); ?>">
          </div>
          <div class="form-group">
               <label for="reference_number">Reference Number</label>
               <input type="number" class="form-control" id="reference_number" name="reference_number" placeholder="Masukkan reference number" value="{{ old('reference_number') }}">
          </div>
          <div class="form-group">
               <label for="amount">Nominal</label>
               <input type="number" class="form-control" id="amount" name="amount" placeholder="Masukkan nominal yang dibayarkan" value="{{ old('amount') }}">
          </div>
          <div class="d-flex justify-content-end">
            <button type="button" class="btn btn-outline-danger mr-2" onclick="window.location='{{ route('ukt.index') }}'">Batal</button>
               <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
          </form>
     </div>
    </div>
</x-app-layout>
