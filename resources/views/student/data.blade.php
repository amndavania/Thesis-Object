<x-app-layout>
    <x-slot name="title">
        Mahasiswa
    </x-slot>
    <div class="card">
     <div class="card-header">
          <div class="d-flex">
               <form class="form-inline" action="{{ route('student.index') }}" method="GET">
                <div class="mb-2 mr-sm-2" id="mahasiswaContainer">
                    <select class="form-control selectpicker" name="students_id" id="students_id" data-live-search="true">
                        <option value="">Pilih Mahasiswa</option>
                        @foreach ($student_search as $search)
                            <option value="{{ $search->id }}">{{ $search->nim . ' / ' . $search->name }}</option>
                        @endforeach
                    </select>
                </div>

               <button type="submit" class="btn btn-primary mb-2">Cari</button>
               </form>

               @include('message.flash-message')
               <button type="button" class="btn btn-sm btn-primary ml-auto p-2" onclick="window.location='{{ url('student/create') }}'">
                    <i class="fas fa-plus-circle"></i> Tambah Data
               </button>
          </div>
     </div>
     <div class="card-body">
          <table class="table table-striped ">
               <thead class="table-dark">
                    <tr>
                         <th>No</th>
                         <td>Mahasiwa</td>
                         <td>Prodi dan DPA</td>
                         <td>Program</td>
                         <td>Status Pembayaran</td>
                         <td>Aksi</td>
                    </tr>
               </thead>
               <tbody>
                    @foreach ($student as $index => $row)
                    @php
                        $number = ($student->currentPage() - 1) * $student->perPage() + $index + 1;
                    @endphp
                         <tr>
                              <th>{{ $number }}</th>
                              <td>
                                   <p class="m-0">{{ $row->name }}</p>
                                   <p class="text-secondary text-sm m-0">{{ $row->force }} - {{ $row->nim }}</p>
                              </td>
                              <td>
                                   <p class="m-0">{{ $row->study_program_name }}</p>
                                   <p class="text-secondary text-sm m-0">{{ $row->dpas_name }}</p>
                              </td>
                              <td>{{ $row->student_type }}</td>
                              <td><p class="text-secondary m-0">{{ $row->status ?: 'Belum ada data UKT' }}</p></td>
                              <td>
                                   <div class="d-flex">
                                        <button type="button" class="btn btn-sm btn-outline-dark m-1" onclick="window.location='{{ route('student.edit',$row->id) }}'">Edit</button>
                                        <form action="{{ route('student.destroy',$row->id) }}" method="post" class="m-1">
                                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm(&quot;Apakah ingin menghapus data tersebut?&quot;)">Hapus</button>
                                        @csrf
                                        @method('delete')
                                        </form>
                                   </div>

                              </td>
                         </tr>
                    @endforeach
               </tbody>
          </table>
          <div class="d-flex justify-content-center align-items-center text-center">
               {{ $student->links() }}
          </div>
     </div>
    </div>
</x-app-layout>
