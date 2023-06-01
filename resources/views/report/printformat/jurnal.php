<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='../../../css/laporan.css' rel="stylesheet" type="text/css">
    <!-- <script src="{{asset('js/laporan.js')}}"></script> -->
    <style>
        .a4-container {
  width: 210mm;
  height: 297mm;
  margin: 0 auto;
  background-color: white;
  box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
  padding: 20mm;
  box-sizing: border-box;
  position: relative;
}

.title {
  text-align: center;
  font-size: larger;
  /* padding-bottom: 10px; */
  /* padding-top: 20px; */
}

.title p {
  margin-top: 10px;
  padding-top: 5px;
  margin-bottom: 5px;
  font-size: large;
}
.title h5 {
  margin-top: 5px;
  font-size: medium;
}
.title h2 {
  padding-top: 10px;
  font-size: large;
  margin: 0px;
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

.currency::after {
  content: ",00";
}
.perubahanModal td,
th {
  text-align: left;
  padding: 8px;
}
.perubahanModal th {
  padding: 8px;
  text-align: left;
  margin: 0px;
}

@media print {
  .a4-container {
    margin: 0;
    box-shadow: none;
    padding: 0;
  }

  .title {
    position: static;
    text-align: center;
  }

  .content {
    position: static;
  }
  .th {
    background-color: rgba(128, 128, 128, 0.8) !important;
  }
  .header {
    position: static;
  }
}

.signature-container {
  display: flex;
  justify-content: space-between;
  margin-top: 20px;
  padding-top: 70px;
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
  text-align: center;
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

.header-content p {
  font-size: 14px;
}

.contact-info {
  font-size: 14px;
  text-align: center;
}

.contact-info span {
  display: block;
}
.total td {
  background-color: rgba(128, 128, 128, 0.4);
}

    </style>
    <title>Laporan Jurnal</title>
</head>
<body>
    <div class="a4-container">
        <div class="header">
        <img src="/img/logo.png" alt="Logo" class="logo">
            <div class="header-content">
                <h2>KEMENTERIAN AGAMA</h2>
                <h2>INSTITUT AGAMA ISLAM IBRAHIMY</h2>
                <div class="contact-info">
                    <span>Jl. KH. Hasyim Asy'ari No.01, Dusun Krajan, Kembiritan Kec. Genteng, Kabupaten Banyuwangi, Jawa Timur 68465</span>
                    <span>Phone:0333-845654&nbsp;Email: admin@iaiibrahimy.ac.id</span>
                </div>
            </div>            
        </div>
        <hr>
        <h2 class="title">
            Jurnal Umum
        </h2>
        <table class="keterangan">
            <tr>
                <td>
                    Periode
                </td>
                <td>:</td>
                <td>Mei 2023</td>                   
            </tr>
            <tr>
                <td>
                    Tanggal Dibuat
                </td>
                <td>:</td>
                <td>25 Mei 2023</td> 
            </tr>
            <tr>
                <td>
                    Kode
                </td>
                <td>:</td>
                <td>6666-9966-3363</td> 
            </tr>
        </table>
        <table class="content">
            <thead>
                <tr>
                    <th style="width: 5%;">No</th>
                    <th style="width: 15%;">Tanggal</th>
                    <th style="width: 20%;">Nama Akun</th>
                    <th style="width: 10%;">ID Akun</th>
                    <th style="width: 10%;">Ref</th>
                    <th style="width: 20%;">Debit</th>
                    <th style="width: 20%;">Kredit</th>
                </tr>
            </thead>
            <tbody>
                <?php




                $jumlahDebit = 0;
                $jumlahKredit = 0;

                foreach ($data as $key => $row) {
                    $No = $key+1;
                    $Tanggal = $row->created_at;
                    $Nama_Akun = $row->transactionaccount->name;
                    $ID_Akun = $row->id;
                    $Ref = $row->reference_number;
                    $Debit = $row->type == 'Debit' ? $row->amount : 0;
                    $Kredit = $row->type == 'Kredit' ? $row->amount : 0;

                    $jumlahDebit += $Debit;
                    $jumlahKredit += $Kredit;

                    echo '<tr>';
                    echo '<td>' . $No . '</td>';
                    echo '<td>' . $Tanggal . '</td>';
                    echo '<td>' . $Nama_Akun . '</td>';
                    echo '<td>' . $ID_Akun . '</td>';
                    echo '<td>' . $Ref . '</td>';
                    echo '<td class="currency">' . $Debit . "</td>";
                    echo '<td class="currency">' . $Kredit . '</td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
            <tfoot class = "total">
                <tr>                    
                    <td colspan="5" style="text-align: center; background-color: rgba(128, 128, 128, 0.4)">
                    <strong>Jumlah</strong>
                    </td>
                    <?php
                    echo '<td class="currency">' . $jumlahDebit . '</td>';
                    echo '<td class="currency">' . $jumlahKredit . '</td>';
                    ?>
                </tr>
            </tfoot>
            </div>
        </table>        

        <div class="signature-container">
            <div class="signature signature-left">
                <div class="signature-placeholder">
                    <p>Mengetahui,</p>
                    <p id="warek">Warek II Bidang Keuangan</p>
                    
                </div>
                    <p style="text-align: center; margin: 2px;">Zidniyati, M.Pd.</p>
            </div>
            <div class="signature signature-right">
                <div class="signature-placeholder">
                    <p id="date">Banyuwangi, 24-05-2023</p>
                    <p id="kabak-keuangan">Ka. BAUKK</p>                        
                </div>
                    <p style="text-align: center; margin: 2px;">Samsuri, M.Si.</p>
            </div>
    </div>
    </div>       
    </div>
</body>
</html>
