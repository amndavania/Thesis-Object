<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
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
    /* padding-top: 70px; */
    font-size: 12px;
    text-align: left;
  }
  
  .signature {
    width: 200px;
  }
  
  .signature-placeholder {
    border-bottom: 1px solid #000;
    margin-bottom: 10px;
    padding-bottom: 100px;
  }
  
  .signature-placeholder p {
    /* text-align: left; */
    margin: 0px;
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
            Laporan Bimbingan Studi
        </h2>
        <div class="container">
        <div class="table-keterangan">
        <table class="keterangan">
            <tr>
                <td>
                    DPA
                </td>
                <td>:</td>
                <td>{{ $dpa->name }}</td>
            </tr>
            <tr>
                <td>
                    Tahun Ajaran
                </td>
                <td>:</td>
                <td>{{ $tahunAjaran[0] . "/" . $tahunAjaran[0]+1}}</td>
            </tr>
            <tr>
                <td>
                    Semester
                </td>
                <td>:</td>
                <td>{{ $tahunAjaran[1] }}</td>
            </tr>
        </table>
        <table class="keterangan">
            <tr>
                <td>
                    Fakultas
                </td>
                <td>:</td>
                <td>{{ $dpa->studyprogram->faculty->name }}</td> 
            </tr>
            <tr>
                <td>
                    Program Studi
                </td>
                <td>:</td>
                <td>{{ $dpa->studyprogram->name }}</td>                   
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>  
            </tr>
        </table>
        </div>
        </div>
        <table class="content">
            <thead>
                <tr>
                    <th rowspan="2" style="width: 5%;">No</th>
                    <th rowspan="2" style="width: 20%;">NIM</th>
                    <th rowspan="2" style="width: 40%;">Nama Mahasiswa</th>
                    <th rowspan="2" style="width: 20%;">Semester</th>
                    <th rowspan="2" style="width: 15%;">status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $index => $row)
                    {{-- @php
                        $number = ($data->currentPage() - 1) * $data->perPage() + $index + 1;
                    @endphp --}}
                         <tr>
                              <th>{{ $loop->iteration }}</th>
                              <td>{{ $row['nim'] }}</td>
                              <td>{{ $row['name'] }}</td>
                              <td style="text-align: center;">{{ $row['semester'] }}</td>
                              <td>{{ $row['status'] }}</td>
                         </tr>
                    @endforeach
            </tbody>            
            </div>
        </table>
        <div class="signature-container">
            <div class="signature signature-left">
                <div class="signature-placeholder">
                    <p>Mengetahui,</p>
                    <p id="warek">Ketua Program Studi</p>
                    <p id="warek">{{ $dpa->studyprogram->name }}</p>
                    
                </div>
                    <p>{{ $dpa->studyprogram->kaprodi_name }}</p>
            </div>
            <div class="signature signature-right">
                <div class="signature-placeholder">
                    <p id="date" style="margin-top: 12px;">Banyuwangi, {{ $today }}</p>
                    <p id="kabak-keuangan">Dosen Pembimbing Akademik</p>                        
                </div>
                    <p>{{ $dpa->name }}</p>
            </div>
        </div>
    </div>       
    </div>
    <script type="text/javascript">
        window.print();
    </script>
</body>
</html>
