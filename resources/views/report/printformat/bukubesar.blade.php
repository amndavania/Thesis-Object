@include('report.kop')
        <h2 class="title">
            Laporan Buku Besar
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
                    <th style="width: 15%;">Tanggal</th>
                    <th style="width: 35%;">Keterangan</th>
                    <th style="width: 5%;">ID Akun</th>
                    <th style="width: 10%;">Ref</th>
                    <th style="width: 15%;">Debit</th>
                    <th style="width: 15%;">Kredit</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $data = [
                    ['2023-05-01', 'Beli Baju', 'ID 1', 'Ref 1', 100000000, 0],
                    ['2023-05-02', 'Beli Sendal', 'ID 2', 'Ref 2', 0, 500000000],
                    ['2023-05-03', 'Beli Tas', 'ID 3', 'Ref 3', 80, 0],
                    ['2023-05-04', 'Beli Laptop', 'ID 4', 'Ref 4', 0, 70],
                    ['2023-05-05', 'Beli Jam tangan', 'ID 5', 'Ref 5', 60, 0],
                    ['2023-05-05', 'Beli Charger laptop', 'ID 6', 'Ref 6', 60, 0],
                    ['2023-05-05', 'Beli Buku tulis', 'ID 7', 'Ref 7', 60, 0],
                    ['2023-05-05', 'Beli Celana', 'ID 8', 'Ref 8', 60, 90],
                    ['2023-05-05', 'Beli Kaos', 'ID 9', 'Ref 9', 60, 70],
                    ['2023-05-05', 'Beli Mobil', 'ID 10', 'Ref 10', 60, 0]
                ];
                $jumlahDebit = 0;
                $jumlahKredit = 0;
                foreach ($data as $row) {
                    $Tanggal = $row[0];
                    $Keterangan = $row[1];
                    $ID_Akun = $row[2];
                    $Ref = $row[3];
                    $Debit = $row[4];
                    $Kredit = $row[5];

                    $jumlahDebit += $Debit;
                    $jumlahKredit += $Kredit;

                    echo '<tr>';
                    echo '<td>' . $Tanggal . '</td>';
                    echo '<td>' . $Keterangan . '</td>';
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
                    <td colspan="4" style="text-align: center; background-color: rgba(128, 128, 128, 0.4)">
                    <strong>Jumlah Total</strong>
                    </td>
                    <?php
                    echo '<td class="currency">' . $jumlahDebit . '</td>';
                    ?>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="4" style="text-align: center; background-color: rgba(128, 128, 128, 0.4)">
                    <strong>Grand Total</strong>
                    </td>
                    <?php
                    echo '<td class="currency">' . $jumlahDebit . '</td>';
                    echo '<td class="currency">' . $jumlahKredit . '</td>';
                    ?>
                </tr>
            </tfoot>
            </div>
        </table>
        @include('report.signature')
