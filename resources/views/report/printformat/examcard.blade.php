<!DOCTYPE html>
<html>
  <head>
    <title>Kartu Ujian Siswa</title>
    <style>
      body {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        background-image: url('/img/bg-card.png');
        background-size: cover;
      }

      .card {
        width: 500px;
        height: 350px;
        padding: 20px;
        box-shadow: 0px 0px 5px 0px rgba(0, 0, 0, 0.3);
        background-color: #fff;
        border-radius: 10px;
        }

      .card h2 {
        margin-top: 0;
        font-size: medium;
      }

      .card p {
        margin: 5px 0;
      }

      .header {
        /* display: flex; */
        align-items: center;
        text-align: center;
        padding-bottom: 20px;
        margin-bottom: 20px;
        border-bottom: 1px solid #000;
      }

      .header img {
        padding: 10px;
        width: 50px;
        margin-right: 10px;
      }

      .header-content h2 {
        font-size: 18px;
        margin-bottom: 0px;
      }

      .header-content P {
        font-size: 16px;
        margin: 0px;
      }

      .table img {
        width: 100px;
        margin-left: 10px;
        margin-right: 40px;
      }

      .right-column {
        font-size: 16px;
      }

      .right-column p {
        display: flex;
        align-items: center;
        }

        .right-column strong {
        width: 100px;
        display: inline-block;
        }
    </style>
  </head>
  <body>
    <div class="card">
      <div class="header">
        <img src="{{asset('img/logouniv.png')}}" alt="Logo" class="logo" />
        <div class="header-content">
          <h2>KARTU PESERTA</h2>
          @if ($examcard->type == "UTS")
            <h2>UJIAN TENGAH SEMESTER</h2>
          @elseif ($examcard->type == "UAS")
            <h2>UJIAN AKHIR SEMESTER</h2>
          @endif
          <h2>INSTITUT AGAMA ISLAM IBRAHIMY</h2>
          <h2>TAHUN {{ $examcard->year . "/" . ($examcard->year + 1) }}</h2>
        </div>
      </div>
      <table class="table">
        <tr>
          <td class="left-column">
            <img src="{{asset('img/bingkaifoto.png')}}" alt="Foto" />
          </td>
          <td class="right-column">
            <p><strong>NIM</strong> <span id="nim">: {{$student->nim}}</span></p>
            <p><strong>Nama</strong> <span id="nama">: {{$student->name}}</span></p>
            <p><strong>Semester</strong> <span id="semester">: {{$examcard->semester}}</span></p>
            <p><strong>Prodi</strong> <span id="prodi">: {{$student->studyprogram->name}}</span></p>
            <p><strong>Fakultas</strong> <span id="fakultas">: {{$student->studyprogram->faculty->name}}</span></p>
          </td>
        </tr>
      </table>
      <div class
