<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ public_path('css/laporan.css') }}" rel="stylesheet" type="text/css">
    <!-- <script src="{{asset('js/laporan.js')}}"></script> -->
    <title>Laporan Jurnal</title>
</head>
<body>
    <div class="a4-container">
        <div class="header">
            <img src="{{ public_path('img/logouniv.png') }}" class="logo">
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
