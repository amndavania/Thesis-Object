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
               <label for="name">Nama</label>
               <input type="text" class="form-control" id="name" name="name" placeholder="Nama...">
          </div>
          <div class="form-group">
               <label for="fakultas">Fakultas</label>
               <select class="form-control" id="fakultas" name="fakultas">
                    @foreach ($faculty as $item)
                         <option value="{{ $item->id }}">{{ $item->name }}</option>
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
