@include('report.kop')
            <h2 class="title">
                Laporan Cash Flow
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
                    Tanggal Dicetak
                </td>
                <td>:</td>
                <td>25 Mei 2023</td>
            </tr>
        </table>
        <table class="content">
        <thead>
        <tr>
            <th rowspan="2" style="width: 15%;">ID_Akun</th>
            <th rowspan="2" style="width: 35%;">Nama_Akun</th>
            <th style="width: 25%;">18-03-2023</th>
            <th style="width: 25%;">01-04-2023</th>
        </tr>
        <tr>
            <td style="text-align: center;"><strong>Seimbang</strong></td>
            <td style="text-align: center;"><strong>Seimbang</strong></td>
        </tr>
        </thead>
        <tbody>
        <tr style="background-color: rgba(128, 128, 128, 0.4)">
            <td></td>
            <td colspan="3"><strong>AKTIVA</strong></td>
        </tr>
        <tr style="background-color: #f2f2f2">
            <td></td>
            <td colspan="3">Aktiva Lancar</td>
        </tr>
        <?php
        $dataAktivaLancar = array(
            array('ID 1', 'Akun 1', 80000000, ''),
            array('ID 2', 'Akun 2', 4000000, ''),
            array('ID 3', 'Akun 3', '', 60000000),
            array('ID 4', 'Akun 4', 200000, 900000),
            array('ID 5', 'Akun 5', '', 8000000),
        );
        $totalTanggalAkhirLancar = 0;
        $totalTanggalAwalLancar = 0;

        foreach ($dataAktivaLancar as $row) {
            $ID_Akun = $row[0];
            $Nama_Akun = $row[1];
            $Tanggal_Akhir = $row[2];
            $Tanggal_Awal = $row[3];

            $totalTanggalAkhirLancar += ($Tanggal_Akhir != '' ? $Tanggal_Akhir : 0);
            $totalTanggalAwalLancar += ($Tanggal_Awal != '' ? $Tanggal_Awal : 0);

            echo '<tr>';
            echo '<td>' . $ID_Akun . '</td>';
            echo '<td>' . $Nama_Akun . '</td>';
            echo '<td class="currency">' . ($Tanggal_Akhir != '' ? $Tanggal_Akhir : 0) . '</td>';
            echo '<td class="currency">' . ($Tanggal_Awal != '' ? $Tanggal_Awal : 0) . '</td>';            
            echo '</tr>';
        }
        ?>
        <tr style="background-color: #f2f2f2">
            <td></td>
            <td colspan="3">Aktiva Tetap</td>
        </tr>
        <?php
        $dataAktivaTetap = array(
            array('ID 1', 'Akun 1', 50000000, ''),
            array('ID 2', 'Akun 2', 5000000, ''),
            array('ID 3', 'Akun 3', '', 60000000),
            array('ID 4', 'Akun 4', 700000, ''),
            array('ID 5', 'Akun 5', '', 8000000),
        );
        $totalTanggalAkhirTetap = 0;
        $totalTanggalAwalTetap = 0;

        foreach ($dataAktivaTetap as $row) {
            $ID_Akun = $row[0];
            $Nama_Akun = $row[1];
            $Tanggal_Akhir = $row[2];
            $Tanggal_Awal = $row[3];

            $totalTanggalAkhirTetap += ($Tanggal_Akhir != '' ? $Tanggal_Akhir : 0);
            $totalTanggalAwalTetap += ($Tanggal_Awal != '' ? $Tanggal_Awal : 0);

            echo '<tr>';
            echo '<td>' . $ID_Akun . '</td>';
            echo '<td>' . $Nama_Akun . '</td>';
            echo '<td class="currency">' . ($Tanggal_Akhir != '' ? $Tanggal_Akhir : 0) . '</td>';
            echo '<td class="currency">' . ($Tanggal_Awal != '' ? $Tanggal_Awal : 0) . '</td>';            
            echo '</tr>';
        }
        ?>
        <tr style="background-color: rgba(128, 128, 128, 0.4)">
            <td></td>
            <td><strong>Total Aktiva</strong></td>
            <td class="currency"><?php echo $totalTanggalAkhirLancar + $totalTanggalAkhirTetap; ?></td>
            <td class="currency"><?php echo $totalTanggalAwalLancar + $totalTanggalAwalTetap; ?></td>            
        </tr>
        <tr style="background-color: rgba(128, 128, 128, 0.4)">
            <td></td>
            <td colspan="3"><strong>PASSIVA</strong></td>
        </tr>
        <tr style="background-color: #f2f2f2">
            <td></td>
            <td colspan="3">Hutang Lancar</td>
        </tr>
        <?php
        $dataHutangLancar = array(
            array('ID 1', 'Akun 1', 50000000, ''),
            array('ID 2', 'Akun 2', 2000000, ''),
            array('ID 3', 'Akun 3', '', 20000000),
            array('ID 4', 'Akun 4', 200000, ''),
            array('ID 5', 'Akun 5', '', 9000000),
        );
        $totalTanggalAkhirHutangLancar = 0;
        $totalTanggalAwalHutangLancar = 0;

        foreach ($dataHutangLancar as $row) {
            $ID_Akun = $row[0];
            $Nama_Akun = $row[1];
            $Tanggal_Akhir = $row[2];
            $Tanggal_Awal = $row[3];

            $totalTanggalAkhirHutangLancar += ($Tanggal_Akhir != '' ? $Tanggal_Akhir : 0);
            $totalTanggalAwalHutangLancar += ($Tanggal_Awal != '' ? $Tanggal_Awal : 0);

            echo '<tr>';
            echo '<td>' . $ID_Akun . '</td>';
            echo '<td>' . $Nama_Akun . '</td>';
            echo '<td class="currency">' . ($Tanggal_Akhir != '' ? $Tanggal_Akhir : 0) . '</td>';
            echo '<td class="currency">' . ($Tanggal_Awal != '' ? $Tanggal_Awal : 0) . '</td>';
            echo '</tr>';
        }
        ?>
        <tr style="background-color: #f2f2f2">
            <td></td>
            <td colspan="3">Hutang Jangka Panjang</td>
        </tr>
        <?php
        $dataHutangJangkaPanjang = array(
            array('ID 1', 'Akun 1', 50000000, ''),
            array('ID 2', 'Akun 2', 5000000, ''),
            array('ID 3', 'Akun 3', '', 60000000),
            array('ID 4', 'Akun 4', 700000, ''),
            array('ID 5', 'Akun 5', '', 8000000),
        );
        $totalTanggalAkhirHutangJangkaPanjang = 0;
        $totalTanggalAwalHutangJangkaPanjang = 0;

        foreach ($dataHutangJangkaPanjang as $row) {
            $ID_Akun = $row[0];
            $Nama_Akun = $row[1];
            $Tanggal_Akhir = $row[2];
            $Tanggal_Awal = $row[3];

            $totalTanggalAkhirHutangJangkaPanjang += ($Tanggal_Akhir != '' ? $Tanggal_Akhir : 0);
            $totalTanggalAwalHutangJangkaPanjang += ($Tanggal_Awal != '' ? $Tanggal_Awal : 0);

            echo '<tr>';
            echo '<td>' . $ID_Akun . '</td>';
            echo '<td>' . $Nama_Akun . '</td>';
            echo '<td class="currency">' . ($Tanggal_Akhir != '' ? $Tanggal_Akhir : 0) . '</td>';
            echo '<td class="currency">' . ($Tanggal_Awal != '' ? $Tanggal_Awal : 0) . '</td>';
            echo '</tr>';
        }
        ?>
        <tr style="background-color: rgba(128, 128, 128, 0.4)">
            <td></td>
            <td><strong>Total Hutang</strong></td>
            <td class="currency"><?php echo $totalTanggalAkhirHutangLancar + $totalTanggalAkhirHutangJangkaPanjang; ?></td>
            <td class="currency"><?php echo $totalTanggalAwalHutangLancar + $totalTanggalAwalHutangJangkaPanjang; ?></td>
        </tr>
        <tr style="background-color: rgba(128, 128, 128, 0.4)">
            <td></td>
            <td colspan="3"><strong>MODAL</strong></td>
        </tr>
        <?php
        $dataModal = array(
            array('ID 1', 'Akun 1', 50000000, ''),
            array('ID 2', 'Akun 2', 5000000, ''),
            array('ID 3', 'Akun 3', '', 60000000),
            array('ID 4', 'Akun 4', 700000, ''),
            array('ID 5', 'Akun 5', '', 8000000),
        );
        $totalTanggalAkhirModal = 0;
        $totalTanggalAwalModal= 0;

        foreach ($dataModal as $row) {
            $ID_Akun = $row[0];
            $Nama_Akun = $row[1];
            $Tanggal_Akhir = $row[2];
            $Tanggal_Awal = $row[3];

            $totalTanggalAkhirModal += ($Tanggal_Akhir != '' ? $Tanggal_Akhir : 0);
            $totalTanggalAwalModal += ($Tanggal_Awal != '' ? $Tanggal_Awal : 0);

            echo '<tr>';
            echo '<td>' . $ID_Akun . '</td>';
            echo '<td>' . $Nama_Akun . '</td>';
            echo '<td class="currency">' . ($Tanggal_Akhir != '' ? $Tanggal_Akhir : 0) . '</td>';
            echo '<td class="currency">' . ($Tanggal_Awal != '' ? $Tanggal_Awal : 0) . '</td>';
            echo '</tr>';
        }
        ?>
        <tr style="background-color: rgba(128, 128, 128, 0.4)">
            <td></td>
            <td><strong>Total Modal</strong></td>
            <td class="currency"><?php echo $totalTanggalAkhirModal; ?></td>
            <td class="currency"><?php echo $totalTanggalAwalModal; ?></td>
        </tr>
        <tr style="background-color: rgba(128, 128, 128, 0.4)">
            <td></td>
            <td><strong>Total Passiva</strong></td>
            <td class="currency"><?php echo $totalTanggalAkhirHutangLancar + $totalTanggalAkhirHutangJangkaPanjang + $totalTanggalAkhirModal; ?></td>
            <td class="currency"><?php echo $totalTanggalAwalHutangLancar + $totalTanggalAwalHutangJangkaPanjang + $totalTanggalAwalModal; ?></td>
        </tr>
        </tbody>
        </table>
        @include('report.signature')
