@include('report.kop')
        <div class="title">
            <h2>Laporan Perubahan Modal</h2>
            <h5>untuk periode yang berakhir 30 Mei 2023</h5>
        </div>
        <table class="content">
            <thead>
                <tr>
                    <th style="width: 10%;">ID_Akun</th>
                    <th style="width: 30%;">Nama_Akun</th>
                    <th style="width: 20%;">Debit</th>
                    <th style="width: 20%;">Kredit</th>
                    <th style="width: 20%;">Saldo</th>
                </tr>
                <tr>
                    <td></td>
                    <td><strong>Pendapatan</strong></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </thead>
            <tbody>
                <?php
                $dataPendapatan = array(
                    array('ID 1', 'Akun 1', '', 50000000, ''),
                    array('ID 2', 'Akun 2', '', 2000000, ''),
                    array('ID 3', 'Akun 3', '', 100000, ''),
                    array('ID 4', 'Akun 4', '', 200000, ''),
                    array('ID 5', 'Akun 5', '', 300000, ''), 
                );
                $totalPendapatan = 0;

                foreach ($dataPendapatan as $row) {
                    $ID_Akun = $row[0];
                    $Nama_Akun = $row[1];
                    $Debit = $row[2];
                    $Kredit = $row[3];
                    $Saldo = $row[4];

                    $totalPendapatan += $Kredit;

                    echo '<tr>';
                    echo '<td>' . $ID_Akun . '</td>';
                    echo '<td>' . $Nama_Akun . '</td>';
                    echo '<td>' . $Debit . "</td>";
                    echo '<td class="currency">' . $Kredit . '</td>';
                    echo '<td>' . $Saldo . '</td>';
                    echo '</tr>';
                }
                ?>
                <tr style="background-color: rgba(128, 128, 128, 0.4)">
                    <td></td>
                    <td>
                    <strong>Total Pendapatan</strong>
                    </td>
                    <td></td>
                    <td></td>
                    <?php
                    echo '<td class="currency">' . $totalPendapatan . '</td>';
                    ?>
                </tr>
                <tr style="background-color: #f2f2f2">
                    <td></td>
                    <td><strong>Pengeluaran</strong></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                <?php
                $dataPengeluaran = array(
                    array('ID 1', 'Akun 1', 500000, '',  ''),
                    array('ID 2', 'Akun 2', 2000000, '', ''),
                    array('ID 3', 'Akun 3', 100000, '',  ''),
                    array('ID 4', 'Akun 4', 2000, '', ''),
                    array('ID 5', 'Akun 5', 400000, '', ''), 
                );
                $totalPengeluaran = 0;
                foreach ($dataPengeluaran as $row) {
                    $ID_Akun = $row[0];
                    $Nama_Akun = $row[1];
                    $Debit = $row[2];
                    $Kredit = $row[3];
                    $Saldo = $row[4];

                    $totalPengeluaran += $Debit;

                    echo '<tr>';
                    echo '<td>' . $ID_Akun . '</td>';
                    echo '<td>' . $Nama_Akun . '</td>';
                    echo '<td class="currency">' . $Debit . "</td>";
                    echo '<td>' . $Kredit . '</td>';
                    echo '<td>' . $Saldo . '</td>';
                    echo '</tr>';
                }
                ?>
                </tr>
                <tr style="background-color: rgba(128, 128, 128, 0.4)">
                    <td></td>
                    <td>
                    <strong>Total Pengeluaran</strong>
                    </td>
                    <td></td>
                    <td></td>
                    <?php
                    echo '<td class="currency">' . $totalPengeluaran . '</td>';
                    ?>
                </tr>
                <tr style="background-color: rgba(128, 128, 128, 0.4)">
                    <td></td>
                    <td>
                    <strong>Laba/Rugi Kotor</strong>
                    </td>
                    <td></td>
                    <td></td>
                    <?php
                    $labaRugiKotor = $totalPendapatan - $totalPengeluaran;
                    echo '<td class="currency">' . $labaRugiKotor . '</td>';
                    ?>
                </tr>
                <tr style="background-color: #f2f2f2">
                    <td></td>
                    <td><strong>Pendapatan/Pengeluaran Lain-Lain</strong></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                <?php
                $datalainLain = array(
                    array('ID 1', 'Akun 1', '', 500000,  ''),
                    array('ID 2', 'Akun 2', '', 2000000, ''),
                    array('ID 3', 'Akun 3', '', 100000,  ''),
                    array('ID 4', 'Akun 4', '', 20000000, ''),
                    array('ID 5', 'Akun 5', '', 4000000, ''), 
                );
                $totallainLain = 0;
                foreach ($datalainLain as $row) {
                    $ID_Akun = $row[0];
                    $Nama_Akun = $row[1];
                    $Debit = $row[2];
                    $Kredit = $row[3];
                    $Saldo = $row[4];

                    $totallainLain += $Kredit;

                    echo '<tr>';
                    echo '<td>' . $ID_Akun . '</td>';
                    echo '<td>' . $Nama_Akun . '</td>';
                    echo '<td>' . $Debit . "</td>";
                    echo '<td class="currency">' . $Kredit . '</td>';
                    echo '<td>' . $Saldo . '</td>';
                    echo '</tr>';
                }
                ?>
                <tr style="background-color: rgba(128, 128, 128, 0.4)">
                    <td></td>
                    <td>
                    <strong>Total Pendapatan/Pengeluaran Lain-Lain</strong>
                    </td>
                    <td></td>
                    <td></td>
                    <?php
                    echo '<td class="currency">' . $totallainLain . '</td>';
                    ?>
                </tr>
                <tr style="background-color: rgba(128, 128, 128, 0.4)">
                    <td></td>
                    <td>
                    <strong>Laba/Rugi Bersih</strong>
                    </td>
                    <td></td>
                    <td></td>
                    <?php
                    $labaRugiBersih = $labaRugiKotor - $totallainLain;
                    echo '<td class="currency">' . $labaRugiBersih . '</td>';
                    ?>
                </tr>
            </tbody>
            <tfoot class = "total">
            </tfoot>

        </table>
        @include('report.signature')
