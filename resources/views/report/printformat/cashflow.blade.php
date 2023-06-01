@include('report.kop')
        <div class="title">
            <h2>Laporan Cash Flow</h2>
            <h5>untuk periode yang berakhir 30 Mei 2023</h5>
        </div>
        <table class="content">
            <thead class="thead">
                <tr>
                    <th style="width: 10%;">ID_Akun</th>
                    <th style="width: 30%;">Nama_Akun</th>
                    <th style="width: 20%;">Jumlah</th>
                    <th style="width: 20%;">Saldo</th>
                </tr>
            </thead>
            <tbody>
                <tr style="background-color: rgba(128, 128, 128, 0.4)">
                    <td></td>
                    <td colspan="3"><strong>Modal Diawal Tahun Fiskal</strong></td>
                </tr>
                <tr style="background-color: #f2f2f2">
                    <td></td>
                    <td colspan="3"><strong>Arus Kas Masuk</strong></td>
                </tr>
                <?php
                $datakasMasuk = array(
                    array('ID 1', 'Akun 1', 50000000, ''),
                    array('ID 2', 'Akun 2', 2000000, ''),
                    array('ID 3', 'Akun 3', 100000, ''),
                    array('ID 4', 'Akun 4', 200000, ''),
                    array('ID 5', 'Akun 5', 300000, ''), 
                );
                $totalArusKasMasuk = 0;

                foreach ($datakasMasuk as $row) {
                    $ID_Akun = $row[0];
                    $Nama_Akun = $row[1];
                    $Jumlah = $row[2];
                    $Saldo = $row[3];

                    $totalArusKasMasuk += $Jumlah;

                    echo '<tr>';
                    echo '<td>' . $ID_Akun . '</td>';
                    echo '<td>' . $Nama_Akun . '</td>';
                    echo '<td class="currency">' . $Jumlah . '</td>';
                    echo '<td>' . $Saldo . '</td>';
                    echo '</tr>';
                }
                ?>
                <tr>
                    <td></td>
                    <td colspan="2">
                    <strong>Total Arus Kas Masuk</strong>
                    </td>
                    <?php
                    echo '<td class="currency">' . $totalArusKasMasuk . '</td>';
                    ?>
                </tr>
                <tr style="background-color: #f2f2f2">
                    <td></td>
                    <td colspan="3"><strong>Arus Kas Keluar</strong></td>
                </tr>
                <tr>
                <?php
                $datakasKeluar = array(
                    array('ID 1', 'Akun 1', 50000000, ''),
                    array('ID 2', 'Akun 2', 2000000, ''),
                    array('ID 3', 'Akun 3', 100000, ''),
                    array('ID 4', 'Akun 4', 2000000, ''),
                    array('ID 5', 'Akun 5', 3000000, ''), 
                );
                $totalArusKasKeluar = 0;

                foreach ($datakasKeluar as $row) {
                    $ID_Akun = $row[0];
                    $Nama_Akun = $row[1];
                    $Jumlah = $row[2];
                    $Saldo = $row[3];

                    $totalArusKasKeluar += $Jumlah;

                    echo '<tr>';
                    echo '<td>' . $ID_Akun . '</td>';
                    echo '<td>' . $Nama_Akun . '</td>';
                    echo '<td class="currency">' . $Jumlah . '</td>';
                    echo '<td>' . $Saldo . '</td>';
                    echo '</tr>';
                }
                ?>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="2">
                    <strong>Total Arus Kas Keluar</strong>
                    </td>
                    <?php
                    echo '<td class="currency">' . $totalArusKasKeluar . '</td>';
                    ?>                
                </tr>
                <tr style="background-color: rgba(128, 128, 128, 0.4)">
                    <td></td>
                    <td colspan="2"><strong>Arus Kas Dari Aktivitas Operasi</strong></td>
                    <?php
                    $arusKasAktivasiOperasi = $totalArusKasMasuk - $totalArusKasKeluar;
                    echo '<td class="currency">' . $arusKasAktivasiOperasi . '</td>';
                    ?> 
                </tr>
                <tr style="background-color: rgba(128, 128, 128, 0.4)">
                    <td></td>
                    <td colspan="3"><strong>Aktivasi Investasi</strong></td>
                </tr>
                <tr style="background-color: #f2f2f2">
                    <td></td>
                    <td colspan="3"><strong>Penjualan Aset</strong></td>
                </tr>
                <tr>
                <?php
                $dataAset = array(
                    array('ID 1', 'Akun 1', 50000000, ''),
                    array('ID 2', 'Akun 2', 2000000, ''),
                    array('ID 3', 'Akun 3', 100000, ''),
                    array('ID 4', 'Akun 4', 2000000, ''),
                    array('ID 5', 'Akun 5', 3000000, ''), 
                );
                $totalJualAset = 0;

                foreach ($dataAset as $row) {
                    $ID_Akun = $row[0];
                    $Nama_Akun = $row[1];
                    $Jumlah = $row[2];
                    $Saldo = $row[3];

                    $totalJualAset += $Jumlah;

                    echo '<tr>';
                    echo '<td>' . $ID_Akun . '</td>';
                    echo '<td>' . $Nama_Akun . '</td>';
                    echo '<td class="currency">' . $Jumlah . '</td>';
                    echo '<td>' . $Saldo . '</td>';
                    echo '</tr>';
                }
                ?>
                <tr>
                    <td></td>
                    <td colspan="2">
                    <strong>Total Penjualan Aset</strong>
                    </td>
                    <?php
                    echo '<td class="currency">' . $totalJualAset . '</td>';
                    ?>
                </tr>
                <tr style="background-color: #f2f2f2">
                    <td></td>
                    <td colspan="3"><strong>Pembelian Aset</strong></td>
                </tr>
                <tr>
                <?php
                $dataAset = array(
                    array('ID 1', 'Akun 1', 50000000, ''),
                    array('ID 2', 'Akun 2', 2000000, ''),
                    array('ID 3', 'Akun 3', 100000, ''),
                    array('ID 4', 'Akun 4', 20000000, ''),
                    array('ID 5', 'Akun 5', 3000000, ''), 
                );
                $totalBeliAset = 0;

                foreach ($dataAset as $row) {
                    $ID_Akun = $row[0];
                    $Nama_Akun = $row[1];
                    $Jumlah = $row[2];
                    $Saldo = $row[3];

                    $totalBeliAset += $Jumlah;

                    echo '<tr>';
                    echo '<td>' . $ID_Akun . '</td>';
                    echo '<td>' . $Nama_Akun . '</td>';
                    echo '<td class="currency">' . $Jumlah . '</td>';
                    echo '<td>' . $Saldo . '</td>';
                    echo '</tr>';
                }
                ?>
                <tr>
                    <td></td>
                    <td colspan="2">
                    <strong>Total Pembelian Aset</strong>
                    </td>
                    <?php
                    echo '<td class="currency">' . $totalBeliAset . '</td>';
                    ?>
                </tr>
                <tr style="background-color: rgba(128, 128, 128, 0.4)">
                    <td></td>
                    <td colspan="2"><strong>Arus Kas Dari Aktivitas Investasi</strong></td>
                    <?php
                    $arusKasAktivasiInvestasi = $totalJualAset - $totalBeliAset;
                    echo '<td class="currency">' . $arusKasAktivasiInvestasi . '</td>';
                    ?> 
                </tr>
                <tr style="background-color: rgba(128, 128, 128, 0.4)">
                    <td></td>
                    <td colspan="3"><strong>Aktivasi Pendanaan</strong></td>
                </tr>
                <tr style="background-color: #f2f2f2">
                    <td></td>
                    <td><strong>Penambahan Dana</strong></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                <?php
                $dataPenambahanDana = array(
                    array('ID 1', 'Akun 1', 50000000, ''),
                    array('ID 2', 'Akun 2', 2000000, ''),
                    array('ID 3', 'Akun 3', 1000000, ''),
                    array('ID 4', 'Akun 4', 2000000, ''),
                    array('ID 5', 'Akun 5', 3000000, ''), 
                );
                $totalPenambahanDana = 0;

                foreach ($dataPenambahanDana as $row) {
                    $ID_Akun = $row[0];
                    $Nama_Akun = $row[1];
                    $Jumlah = $row[2];
                    $Saldo = $row[3];

                    $totalPenambahanDana += $Jumlah;

                    echo '<tr>';
                    echo '<td>' . $ID_Akun . '</td>';
                    echo '<td>' . $Nama_Akun . '</td>';
                    echo '<td class="currency">' . $Jumlah . '</td>';
                    echo '<td>' . $Saldo . '</td>';
                    echo '</tr>';
                }
                ?>
                <tr>
                    <td></td>
                    <td>
                    <strong>Total Penambahan Dana</strong>
                    </td>
                    <td></td>
                    <?php
                    echo '<td class="currency">' . $totalPenambahanDana. '</td>';
                    ?>
                </tr>
                <tr style="background-color: #f2f2f2">
                    <td></td>
                    <td><strong>Pengurangan Dana</strong></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                <?php
                $dataPenguranganDana = array(
                    array('ID 1', 'Akun 1', 50000000, ''),
                    array('ID 2', 'Akun 2', 2000000, ''),
                    array('ID 3', 'Akun 3', 100000, ''),
                    array('ID 4', 'Akun 4', 2000000, ''),
                    array('ID 5', 'Akun 5', 7000000, ''), 
                );
                $totalPenguranganDana = 0;

                foreach ($dataPenguranganDana as $row) {
                    $ID_Akun = $row[0];
                    $Nama_Akun = $row[1];
                    $Jumlah = $row[2];
                    $Saldo = $row[3];

                    $totalPenguranganDana += $Jumlah;

                    echo '<tr>';
                    echo '<td>' . $ID_Akun . '</td>';
                    echo '<td>' . $Nama_Akun . '</td>';
                    echo '<td class="currency">' . $Jumlah . '</td>';
                    echo '<td>' . $Saldo . '</td>';
                    echo '</tr>';
                }
                ?>
                <tr>
                    <td></td>
                    <td>
                    <strong>Total Pengurangan Dana</strong>
                    </td>
                    <td></td>
                    <?php
                    echo '<td class="currency">' . $totalPenguranganDana . '</td>';
                    ?>
                </tr>
                <tr style="background-color: rgba(128, 128, 128, 0.4)">
                    <td></td>
                    <td colspan="2"><strong>Arus Kas Dari Aktivitas Pendanaan</strong></td>
                    <?php
                    $arusKasAktivasiPendanaan = $totalPenambahanDana- $totalPenguranganDana;
                    echo '<td class="currency">' . $arusKasAktivasiPendanaan . '</td>';
                    ?> 
                </tr>
                <tr style="background-color: rgba(128, 128, 128, 0.7)">
                    <td></td>
                    <td colspan="2">
                    <strong>Kenaikan/Penurunan Kas</strong></td>
                    <?php
                    $kenaikanPenurunanKas = $arusKasAktivasiOperasi + $arusKasAktivasiInvestasi + $arusKasAktivasiPendanaan;
                    echo '<td class="currency">' . $kenaikanPenurunanKas . '</td>';
                    ?>
                </tr>
                <tr style="background-color: rgba(128, 128, 128, 0.7)">
                    <td></td>
                    <td colspan="2">
                    <strong>Saldo Awal Kas</strong></td>
                    <?php
                    $SaldoAwalKas = 25000000;
                    echo '<td class="currency">' . $SaldoAwalKas . '</td>';
                    ?>
                </tr>
                <tr style="background-color: rgba(128, 128, 128, 0.7)">
                    <td></td>
                    <td colspan="2">
                    <strong>Saldo Akhir Kas</strong></td>
                    <?php
                    $SaldoAkhirKas = $kenaikanPenurunanKas + $SaldoAwalKas;
                    echo '<td class="currency">' . $SaldoAkhirKas . '</td>';
                    ?>
                </tr>
            </tbody>
            <tfoot class = "total">
            </tfoot>

        </table>
        @include('report.signature')
