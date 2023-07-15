<x-guest-layout>
    <x-slot name="title">
        Kartu Ujian
    </x-slot>
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
          <div class="card-header text-center bg-light">
            <div>
                <img style="width: 30%; margin-bottom: 20px;" src="{{asset('img/logouniv.png')}}" alt="Logo"/>
                <div>
                  <h5><strong>KARTU PESERTA</strong></h5>
                  @if ($examcard->type == "UTS")
                    <h5><strong>UJIAN TENGAH SEMESTER</strong></h5>
                  @elseif ($examcard->type == "UAS")
                    <h5><strong>UJIAN AKHIR SEMESTER</strong></h5>
                  @endif
                  <h5><strong>INSTITUT AGAMA ISLAM IBRAHIMY</strong></h5>
                  <h5><strong>TAHUN {{ $examcard->year . "/" . ($examcard->year + 1) }}</strong></h5>
                </div>
              </div>
            {{-- <div class="text-center">
              <img src='../../img/logouniv.png' class="rounded shadow" alt="IAI IBRAHIMY" style="max-height: 200px;">
            </div> --}}
          </div>
          <div class="card-body">
            {{-- <div class="text-center">
                <img src="{{asset('img/bingkaifoto.png')}}" alt="Foto" style="width:100px;"/>
            </div> --}}
            <div style="display: flex; justify-content: center;">
            <table>
                <tr>
                  <td>
                    <p style="margin-bottom:0px;"><strong style="width:80px; display: inline-block;">NIM</strong> <span id="nim">: {{$student->nim}}</span></p>
                    <p style="margin-bottom:0px;"><strong style="width:80px; display: inline-block;">Nama</strong> <span id="nama">: {{$student->name}}</span></p>
                    <p style="margin-bottom:0px;"><strong style="width:80px; display: inline-block;">Semester</strong> <span id="semester">: {{$examcard->semester}}</span></p>
                    <p style="margin-bottom:0px;"><strong style="width:80px; display: inline-block;">Prodi</strong> <span id="prodi">: {{$student->studyprogram->name}}</span></p>
                    <p style="margin-bottom:0px;"><strong style="width:80px; display: inline-block;">Fakultas</strong> <span id="fakultas">: {{$student->studyprogram->faculty->name}}</span></p>
                  </td>
                </tr>
              </table>
            </div>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
</x-guest-layout>