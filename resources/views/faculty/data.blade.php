<x-app-layout>
    <x-slot name="title">
        Fakultas
    </x-slot>
    {{-- @include('profile.partials.update-profile-information-form')
    @include('profile.partials.update-password-form')
    @include('profile.partials.delete-user-form') --}}
    <div class="card">
     <div class="card-header">
          <div class="d-flex justify-content-end">
               <button type="button" class="btn btn-sm btn-primary" onclick="window.location='{{ url('faculty/create') }}'">
                    <i class="fas fa-plus-circle"></i> Tambah Data
               </button>
          </div>
     </div>
     <div class="card-body">
          <table class="table table-striped ">
               <thead class="table-dark">
                    <tr>
                         <th>No</th>
                         <td>Nama</td>
                         <td>Aksi</td>
                    </tr>
               </thead>
               <tbody>
                    @foreach ($faculty as $row)
                         <tr>
                              <th>{{ $loop->iteration }}</th>
                              <td>{{ $row->name }}</td>
                              <td>
                                   <button type="button" class="btn btn-sm btn-outline-secondary" >Edit</button>
                                   <button type="button" class="btn btn-sm btn-danger" onclick="window.location="{{ url('faculty.destror') }}">Hapus</button>
                              </td>   
                         </tr>
                    @endforeach
               </tbody>
          </table>

     </div>
    </div>
</x-app-layout>
