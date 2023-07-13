<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$title}}</title>
    <style>
        .a4-container {
            width: 210mm;
            height: 297mm;
            margin: 0 auto;
            background-color: white;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            padding: 10mm;
            box-sizing: border-box;
            position: relative;
        }
        table {
            font-size: 12px;
        }
        .title {
            text-align: center;
            font-size: larger;
        }
        .title h2 {
            padding-top: 10px;
            font-size: large;
            margin: 0px;
        }
        .logo {
            width: 100px;
            margin-right: 20px;
        }

        .header-content {
            flex-grow: 1;
        }

        .header-content h2,
        .header-content p {
            margin: 0;
            text-align: center;
        }
        .header-content h2{
            font-size: 18px;
        }
        .header-content p {
            font-size: 16px;
        }
        .signature-container {
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
            font-size: 12px;
            height: 150px;
        }

        .signature {
            width: 100%;
        }

        .signature-placeholder {
            border-bottom: 1px solid #000;
            margin-bottom: 5px;
            padding-bottom: 100px;
        }

        .signature-bottom {
            text-align: center;
        }

        .signature-placeholder p {
            text-align: center;
            margin: 0px;
        }
        .signature2-container {
  display: flex;
  margin-top: 20px;
  justify-content: center;
  align-items: center;
  height: 150px;
  font-size: 12px;
}

.signature2-center {
  text-align: center;
}

.signature2-placeholder {
  margin-bottom: 10px;
}

.signature2-placeholder p {
  margin: 0;
}

.signature2-placeholder {
            border-bottom: 1px solid #000;
            margin-bottom: 5px;
            padding-bottom: 100px;
        }

        .signature-left {
            padding-right: 80px;
            padding-left: 80px;
        }
        .signature-right {
            padding-right: 80px;
            padding-left: 80px;
        }

        img {
            width: 100px;
            padding-bottom: 20px;
        }
        .header {
            display: flex;
            align-items: center;
            border-bottom: 1px solid #000;
        }
        hr {
            border-bottom: 2px solid #000;
            margin-top: 2px;
        }
        .contact-info {
            font-size: 16px;
            text-align: center;
        }
        
        .contact-info span {
            display: block;
        }
        .total td {
            background-color: rgba(128, 128, 128, 0.4);
        }
        .keterangan {
            padding-bottom: 20px;
        }
        .content {
            border-collapse: collapse;
            width: 100%;
            table-layout: auto;
        }
        .content th {
            background-color: rgba(128, 128, 128, 0.7);
            padding: 8px;
            text-align: center;
            border: 1px solid #000000;
        }
        .content td {
            padding: 8px;
            width: 100px;
            text-align: left;
            border: 1px solid #000000;
        }
        .content tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .content tr:nth-child(odd) {
            background-color: #ffffff;
        }
        /* .currency::after {
            content: ",00";
        } */
        @media print {
            .a4-container {
                margin: 0;
                box-shadow: none;
                padding: 0;
            }
            .title {
                position: sticky;
                text-align: center;
            }
            .content {
                position: sticky;
            }
            .th {
                background-color: rgba(128, 128, 128, 0.8) !important;
            }
            .header {
                position: sticky;
            }
            .contact-info {
                position: sticky;
            }
        }
        .table-keterangan {
            display: flex;
            justify-content: space-between;
        }
        .catatan {
  width: 100%;
  margin-top: 20px;
  font-size: 12px;
}

.catatandosen {
  width: 100%;
  border-collapse: collapse;
}

.catatandosen th {
  border: 1px solid black;
  padding: 50px;
  text-align: left;
}

.catatandosen td {
  border: 1px solid black;
  padding: 8px;
  text-align: left;
}

.horizontal-line {
  border-top: 1px solid black;
}
    </style>

    <title>Lembar Bimbingan Studi</title>
</head>
<body>
    <div class="a4-container">
        <div class="header">
            <table>
                <tr>
                  <td>
                    <img src="{{asset('img/logouniv.png')}}" alt="Logo" class="logo">
                  </td>
                  <td>
                    <div class="header-content">
                        <h2>KEMENTERIAN AGAMA</h2>
                        <h2>INSTITUT AGAMA ISLAM IBRAHIMY</h2>
                        <div class="contact-info">
                            <span>Jl. KH. Hasyim Asy'ari No.01, Dusun Krajan, Kembiritan Kec. Genteng, Kabupaten Banyuwangi, Jawa Timur 68465</span>
                            <span>Phone:0333-845654&nbsp;Email: admin@iaiibrahimy.ac.id</span>
                        </div>
                    </div>
                  </td>
                </tr>
              </table>            
        </div>
        <hr>
<h2 class="title">
    Lembar Bimbingan Studi
</h2>
<div class="container">
<div class="table-keterangan">
    <table class="keterangan">
        <tr>
            <td>
                Nama
            </td>
            <td>:</td>
            <td>{{ $student->name }}</td>                   
        </tr>
        <tr>
            <td>
                NIM
            </td>
            <td>:</td>
            <td>{{ $student->nim }}</td> 
        </tr>
        <tr>
            <td>
                Semester
            </td>
            <td>:</td>
            <td>
                {{ $semester }}
        
            </td> 
        </tr>
    </table>
    <table class="keterangan">
        <tr>
            <td>
                Program Studi
            </td>
            <td>:</td>
            <td>{{ $student->studyprogram->name }}</td>                   
        </tr>
        <tr>
            <td>
                Fakultas
            </td>
            <td>:</td>
            <td>{{ $student->studyprogram->faculty->name }}</td> 
        </tr>
        <tr>
            <td>
                Tahun Ajaran
            </td>
            <td>:</td>
            <td>{{ $bimbinganstudi->year . "/" . $bimbinganstudi->year + 1 }}</td> 
        </tr>
    </table>
</div>
</div>
<table class="content">
    <thead>
        <tr>
            <th rowspan="2" style="width: 5%;">No</th>
            <th rowspan="2" style="width: 15%;">Kode</th>
            <th rowspan="2" style="width: 25%;">Mata Kuliah</th>
            <th rowspan="2" style="width: 5%;">SKS</th>
            <th rowspan="2" style="width: 20%;">Dosen Pengampu</th>
            <th colspan="2" style="width: 30%;">Jadwal</th>
        </tr>
        <tr style="background-color: rgba(128, 128, 128, 0.4)">
            <td style="text-align: center;"><strong>Hari</strong></td>
            <td style="text-align: center;"><strong>Jam</strong></td>
        </tr>
    </thead>
    <tbody>
        @for ($i = 1; $i <= 10; $i++)
            <tr style="height: 30px;">
                @for ($j = 1; $j <= 7; $j++)
                    <td></td>
                @endfor
            </tr>
        @endfor
    </tbody>            
    </div>
</table>
<div class="catatan">
    <p><strong>Catatan Bimbingan:</strong></p>
        <table class="catatandosen">
            <th></th>
        </table>
</div>
<div class="signature-container">
    <div class="signature signature-left">
        <div class="signature-placeholder">
            <p style="margin-top: 15px;">Mahasiswa</p>
            
        </div>
            <p style="text-align: center; margin: 0px;">{{ $student->name }}</p>
    </div>
    <div class="signature signature-right">
        <div class="signature-placeholder">
            <p id="date">Banyuwangi, {{ $today }}</p>
            <p id="kabak-keuangan">Dosen Pembimbing Akademik</p>                        
        </div>
            <p style="text-align: center; margin: 0px;">{{ $student->dpa->name }}</p>
    </div>
</div>
<div class="signature2-container">
<div class="signature2-center">
        <div class="signature2-placeholder">
            <p>Mengetahui,</p>
            <p id="kabak-keuangan">Ketua Program Studi</p> 
            <p id="kabak-keuangan">{{ $student->studyprogram->name }}</p>                        
        </div>
            <p style="text-align: center; margin: 0px;">{{ $student->studyprogram->kaprodi_name }}</p>
    </div>
</div>

</div>
</div>       
</div>
<script type="text/javascript">
    window.print();
</script>
</body>
</html>