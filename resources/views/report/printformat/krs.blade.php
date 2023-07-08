@include('report.kop')
<h2 class="title">
    Lembar Bimbingan Studi
</h2>
<div class="container">
<div class="left-column">
<table class="keterangan">
    <tr>
        <td>
            Nama
        </td>
        <td>:</td>
        <td>Putra Kencana</td>                   
    </tr>
    <tr>
        <td>
            NIM
        </td>
        <td>:</td>
        <td>1924101028</td> 
    </tr>
    <tr>
        <td>
            Semester
        </td>
        <td>:</td>
        <td>7</td> 
    </tr>
</table>
</div>
<div class="right-column">
<table class="keterangan">
    <tr>
        <td>
            Prodi
        </td>
        <td>:</td>
        <td>Teknologi Informasi</td>                   
    </tr>
    <tr>
        <td>
            Fakultas
        </td>
        <td>:</td>
        <td>Ilmu Komputer</td> 
    </tr>
    <tr>
        <td>
            Tahun Angkatan
        </td>
        <td>:</td>
        <td>2019</td> 
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
            <tr>
                @for ($j = 1; $j <= 7; $j++)
                    <td></td>
                @endfor
            </tr>
        @endfor
        <?php
        $data = [
            ['1', 'MKU1001', 'Pancasila', '2', 'Maududi', 'Selasa', '09.00'],
            ['2', 'MKU1002', 'Kewarganegaraan', '2', 'luhut', 'Selasa', '09.00'],
        ];

        foreach ($data as $row) {
            $No = $row[0];
            $Kode_Mata_Kuliah = $row[1];
            $Nama_Mata_Kuliah = $row[2];
            $SKS = $row[3];
            $Dosen_Pembimbing = $row[4];
            $Hari = $row[5];
            $Jam = $row[6];


            echo '<tr>';
            echo '<td>' . $No . '</td>';
            echo '<td>' . $Kode_Mata_Kuliah . '</td>';
            echo '<td>' . $Nama_Mata_Kuliah . '</td>';
            echo '<td>' . $SKS . '</td>';
            echo '<td>' . $Dosen_Pembimbing . '</td>';
            echo '<td>' . $Hari . '</td>';
            echo '<td>' . $Jam . '</td>';
            echo '</tr>';
        }
        ?>
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
            <p>Mengetahui,</p>
            <p id="warek">Mahasiswa</p>
            
        </div>
            <p style="text-align: center; margin: 2px;">name</p>
    </div>
    <div class="signature signature-right">
        <div class="signature-placeholder">
            <p id="date">Banyuwangi, 24-05-2023</p>
            <p id="kabak-keuangan">Dosen Pembimbing Akademik</p>                        
        </div>
            <p style="text-align: center; margin: 2px;">name</p>
    </div>
</div>
<div class="signature2-container">
<div class="signature2-center">
        <div class="signature2-placeholder">
            <p id="date">Banyuwangi, 24-05-2023</p>
            <p id="kabak-keuangan">Kaprodi</p>                        
        </div>
            <p style="text-align: center; margin: 2px;">name</p>
    </div>
</div>

</div>
</div>       
</div>
</body>
</html>