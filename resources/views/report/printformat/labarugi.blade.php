@include('report.kop')
        <div class="title">
            <h2>Laporan Rugi Laba</h2>
            <h5>untuk periode yang berakhir 30 Mei 2023</h5>
        </div>
        <table class="content">
            <thead>
                <tr>
                    <th style="width: 10%;">ID_Akun</th>
                    <th style="width: 30%;">Nama_Akun</th>
                    <th style="width: 20%;">Jumlah</th>
                    <th style="width: 20%;">Saldo</th>
                </tr>
                <tr>
                    <td></td>
                    <td><strong>Modal Diawal Tahun Fiskal</strong></td>
                    <td></td>
                    <td></td>
                </tr>
            </thead>
            <tbody>
                <?php
                $dataModal = array(
                    array('ID 1', 'Akun 1', 50000000, ''),
                    array('ID 2', 'Akun 2', 2000000, ''),
                    array('ID 3', 'Akun 3', 100000, ''),
                    array('ID 4', 'Akun 4', 200000, ''),
                    array('ID 5', 'Akun 5', 300000, ''), 
                );
                $totalSaldoAwal = 0;

                foreach ($dataModal as $row) {
                    $ID_Akun = $row[0];
                    $Nama_Akun = $row[1];
                    $Jumlah = $row[2];
                    $Saldo = $row[3];

                    $totalSaldoAwal += $Jumlah;

                    echo '<tr>';
                    echo '<td>' . $ID_Akun . '</td>';
                    echo '<td>' . $Nama_Akun . '</td>';
                    echo '<td class="currency">' . $Jumlah . '</td>';
                    echo '<td>' . $Saldo . '</td>';
                    echo '</tr>';
                }
                ?>
                <tr style="background-color: rgba(128, 128, 128, 0.4)">
                    <td></td>
                    <td>
                    <strong>Total Modal Awal</strong>
                    </td>
                    <td></td>
                    <?php
                    echo '<td class="currency">' . $totalSaldoAwal . '</td>';
                    ?>
                </tr>
                <tr style="background-color: #f2f2f2">
                    <td></td>
                    <td><strong>Penambahan Modal</strong></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                <?php
                $dataModal = array(
                    array('ID 1', 'Akun 1', 50000000, ''),
                    array('ID 2', 'Akun 2', 2000000, ''),
                    array('ID 3', 'Akun 3', 100000, ''),
                    array('ID 4', 'Akun 4', 2000000, ''),
                    array('ID 5', 'Akun 5', 3000000, ''), 
                );
                $totalPenambahanModal = 0;

                foreach ($dataModal as $row) {
                    $ID_Akun = $row[0];
                    $Nama_Akun = $row[1];
                    $Jumlah = $row[2];
                    $Saldo = $row[3];

                    $totalPenambahanModal += $Jumlah;

                    echo '<tr>';
                    echo '<td>' . $ID_Akun . '</td>';
                    echo '<td>' . $Nama_Akun . '</td>';
                    echo '<td class="currency">' . $Jumlah . '</td>';
                    echo '<td>' . $Saldo . '</td>';
                    echo '</tr>';
                }
                ?>
                </tr>
                <tr style="background-color: rgba(128, 128, 128, 0.4)">
                    <td></td>
                    <td>
                    <strong>Total Penambahan Modal</strong>
                    </td>
                    <?php
                    echo '<td class="currency">' . $totalPenambahanModal . '</td>';
                    ?>
                    <td></td>                    
                </tr>
                <tr style="background-color: rgba(128, 128, 128, 0.4)">
                    <td></td>
                    <td>
                    <strong>Laba Rugi Periode Berjalan</strong>
                    </td>
                    <?php
                    $labarRugiBerjalan = 1000000;
                    echo '<td class="currency">' . $labarRugiBerjalan . '</td>';
                    ?>
                    <td></td>                    
                </tr>
                <tr style="background-color: #f2f2f2">
                    <td></td>
                    <td><strong>Pengurangan Modal</strong></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                <?php
                $dataModal = array(
                    array('ID 1', 'Akun 1', 50000000, ''),
                    array('ID 2', 'Akun 2', 2000000, ''),
                    array('ID 3', 'Akun 3', 100000, ''),
                    array('ID 4', 'Akun 4', 2000000, ''),
                    array('ID 5', 'Akun 5', 3000000, ''), 
                );
                $totalPenguranganModal = 0;

                foreach ($dataModal as $row) {
                    $ID_Akun = $row[0];
                    $Nama_Akun = $row[1];
                    $Jumlah = $row[2];
                    $Saldo = $row[3];

                    $totalPenguranganModal += $Jumlah;

                    echo '<tr>';
                    echo '<td>' . $ID_Akun . '</td>';
                    echo '<td>' . $Nama_Akun . '</td>';
                    echo '<td class="currency">' . $Jumlah . '</td>';
                    echo '<td>' . $Saldo . '</td>';
                    echo '</tr>';
                }
                ?>
                <tr style="background-color: rgba(128, 128, 128, 0.4)">
                    <td></td>
                    <td>
                    <strong>Penambahan/Pengurangan Modal</strong>
                    </td>
                    <td></td>
                    <?php
                    $totalPenambahanPenguranganModal = $totalPenguranganModal + $labarRugiBerjalan;
                    echo '<td class="currency">' . $totalPenambahanPenguranganModal . '</td>';
                    ?>
                </tr>
                <tr style="background-color: rgba(128, 128, 128, 0.4)">
                    <td></td>
                    <td>
                    <strong>Modal Diakhir Tahun Fiskal</strong>
                    </td>
                    <td></td>
                    <?php
                    $totalModal = $totalSaldoAwal + $totalPenambahanPenguranganModal;
                    echo '<td class="currency">' . $totalModal . '</td>';
                    ?>
                </tr>
            </tbody>
            <tfoot class = "total">
            </tfoot>

        </table>
        @include('report.signature')
