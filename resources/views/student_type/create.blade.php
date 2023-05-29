<x-app-layout>
    <x-slot name="title">
        Beasiswa/Status Mahasiswa
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
               <label for="name">Nama Beasiswa</label>
               <input type="text" class="form-control" id="name" name="type" placeholder="Nama...">
          </div>
          <div class="form-group">
               <label for="dpp">DPP</label>
               <input type="number" class="form-control" id="dpp" name="dpp" placeholder="Biaya DPP...">
          </div>
          <div class="form-group">
               <label for="krs">KRS</label>
               <input type="number" class="form-control" id="krs" name="krs" placeholder="Biaya KRS...">
          </div>
          <div class="form-group">
               <label for="uts">Biaya UTS</label>
               <input type="number" class="form-control" id="uts" name="uts" placeholder="Biaya UTS...">
          </div>
          <div class="form-group">
               <label for="uas">Biaya UAS</label>
               <input type="number" class="form-control" id="uas" name="uas" placeholder="Biaya UAS...">
          </div>
          <div class="form-group">
               <label for="wisuda">Biaya Wisuda</label>
               <input type="number" class="form-control" id="wisuda" name="wisuda" placeholder="Biaya Wisuda...">
          </div>
          <div class="d-flex justify-content-end">
               <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
          </form>
     </div>
    </div>
</x-app-layout>
