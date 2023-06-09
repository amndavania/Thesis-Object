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
            <thead class="thead">
                <tr>
                    <th style="width: 10%;">ID_Akun</th>
                    <th style="width: 30%;">Nama_Akun</th>
                    <th style="width: 20%;">Jumlah</th>
                    <th style="width: 20%;">Total</th>
                </tr>
            </thead>
            <tbody>
                <tr style="background-color: rgba(128, 128, 128, 0.4)">
                    <td colspan="4"><strong>AKTIVITAS OPERASI</strong></td>
                </tr>
                <tr style="background-color: #f2f2f2">
                    <td colspan="4"><strong>Arus Kas Masuk</strong></td>
                </tr>
                @php
               $totalArusKasMasuk = 0;
               @endphp
                    @foreach ($dataA as $row)
                         <tr>
                              <td>{{ $row->id }}</td>
                              <td>{{ $row->name }}</td>
                              <td class="currency">{{ $row->ammount_debit - $row->ammount_kredit }}</td>
                              <td></td>
                         </tr>
                         @php
                         $totalArusKasMasuk += $row->ammount_debit - $row->ammount_kredit;
                         @endphp
                    @endforeach
                    <tr>
                    <td colspan="3">
                         <strong>Total Arus Kas Masuk</strong>
                    </td>
                    <td class="currency">{{ $totalArusKasMasuk }}</td>
                </tr>
                <tr style="background-color: #f2f2f2">
                    <td colspan="4"><strong>Arus Kas Keluar</strong></td>
                </tr>
                <tr>
                @php
               $totalArusKasKeluar = 0;
               @endphp
                    @foreach ($dataB as $row)
                         <tr>
                              <td>{{ $row->id }}</td>
                              <td>{{ $row->name }}</td>
                              <td class="currency">{{ $row->ammount_debit - $row->ammount_kredit }}</td>
                              <td></td>
                         </tr>
                         @php
                         $totalArusKasKeluar += $row->ammount_debit - $row->ammount_kredit;
                         @endphp
                    @endforeach
                </tr>
                <tr>
                    <td colspan="3">
                         <strong>Total Arus Kas Keluar</strong>
                    </td>
                    <td class="currency">{{ $totalArusKasKeluar }}</td>
                </tr>
                <tr>
                    <td colspan="3">
                    <strong>ARUS KAS DARI AKTIVITAS OPERASI</strong>
                    </td>
                    @php
                         $totalArusKasAktivitasOperasi = $totalArusKasMasuk - $totalArusKasKeluar;
                    @endphp
                    <td class="currency">{{ $totalArusKasAktivitasOperasi }}</td>
                </tr>

                <tr style="background-color: rgba(128, 128, 128, 0.4)">
                    <td colspan="4"><strong>Aktivasi Investasi</strong></td>
                </tr>
                <tr style="background-color: #f2f2f2">
                    <td colspan="4"><strong>Penjualan Aset</strong></td>
                </tr>
                <tr>
                @php
               $totalPenjualanAset = 0;
               @endphp
                    @foreach ($dataC as $row)
                         <tr>
                              <td>{{ $row->id }}</td>
                              <td>{{ $row->name }}</td>
                              <td class="currency">{{ $row->ammount_debit - $row->ammount_kredit }}</td>
                              <td></td>
                         </tr>
                         @php
                         $totalPenjualanAset += $row->ammount_debit - $row->ammount_kredit;
                         @endphp
                    @endforeach
                    <tr>
                    <td colspan="3">
                         <strong>Total Penjualan Aset</strong>
                    </td>
                    <td class="currency">{{ $totalPenjualanAset }}</td>
                </tr>
                <tr style="background-color: #f2f2f2">
                    <td colspan="4"><strong>Pembelian Aset</strong></td>
                </tr>
                <tr>
                @php
               $totalPembelianAset = 0;
               @endphp
                    @foreach ($dataD as $row)
                         <tr>
                              <td>{{ $row->id }}</td>
                              <td>{{ $row->name }}</td>
                              <td class="currency">{{ $row->ammount_debit - $row->ammount_kredit }}</td>
                              <td></td>
                         </tr>
                         @php
                         $totalPembelianAset += $row->ammount_debit - $row->ammount_kredit;
                         @endphp
                    @endforeach
                    <tr>
                    <td colspan="3">
                         <strong>Total Pembelian Aset</strong>
                    </td>
                    <td class="currency">{{ $totalPembelianAset }}</td>
                </tr>
                <tr>
                    <td colspan="3">
                    <strong>ARUS KAS DARI AKTIVITAS INVESTASI</strong>
                    </td>
                    @php
                         $totalArusKasAktivitasInvestasi = $totalPenjualanAset - $totalPembelianAset;
                    @endphp
                    <td class="currency">{{ $totalArusKasAktivitasInvestasi }}</td>
                </tr>
                <tr style="background-color: rgba(128, 128, 128, 0.4)">
                    <td colspan="4"><strong>Aktivasi Pendanaan</strong></td>
                </tr>
                <tr style="background-color: #f2f2f2">
                    <td><strong>Penambahan Dana</strong></td>
                </tr>
                <tr>
                @php
               $totalPenambahanDana = 0;
               @endphp
                    @foreach ($dataE as $row)
                         <tr>
                              <td>{{ $row->id }}</td>
                              <td>{{ $row->name }}</td>
                              <td class="currency">{{ $row->ammount_debit - $row->ammount_kredit }}</td>
                              <td></td>
                         </tr>
                         @php
                         $totalPenambahanDana += $row->ammount_debit - $row->ammount_kredit;
                         @endphp
                    @endforeach
                    <tr>
                    <td colspan="3">
                         <strong>Total Penambahan Dana</strong>
                    </td>
                    <td class="currency">{{ $totalPenambahanDana }}</td>
                </tr>
                <tr style="background-color: #f2f2f2">
                    <td colspan="4"><strong>Pengurangan Dana</strong></td>
                </tr>
                <tr>
                @php
               $totalPenguranganDana = 0;
               @endphp
                    @foreach ($dataF as $row)
                         <tr>
                              <td>{{ $row->id }}</td>
                              <td>{{ $row->name }}</td>
                              <td class="currency">{{ $row->ammount_debit - $row->ammount_kredit }}</td>
                              <td></td>
                         </tr>
                         @php
                         $totalPenguranganDana += $row->ammount_debit - $row->ammount_kredit;
                         @endphp
                    @endforeach
                    <tr>
                    <td colspan="3">
                         <strong>Total Pengurangan Dana</strong>
                    </td>
                    <td class="currency">{{ $totalPenguranganDana }}</td>
                </tr>
                <tr>
                    <td colspan="3">
                         <strong>ARUS KAS DARI AKTIVITAS PENDANAAN</strong>
                    </td>
                    @php
                         $totalArusKasAktivitasPendanaan = $totalPenambahanDana - $totalPenguranganDana;
                    @endphp
                    <td class="currency">{{ $totalArusKasAktivitasPendanaan }}</td>
                </tr>
                <tr>
                    <td colspan="3">
                         <strong>Kenaikan / Penurunan Kas</strong>
                    </td>
                    @php
                         $totalKenaikanPenurunanKas = $totalArusKasAktivitasOperasi + $totalArusKasAktivitasInvestasi + $totalArusKasAktivitasPendanaan;
                    @endphp
                    <td class="currency">{{ $totalKenaikanPenurunanKas }}</td>
                </tr>
                <tr>
                    <td colspan="3">
                         <strong>Saldo Awal Kas</strong>
                    </td>
                    @php
                         $totalAwalKas = "Saldo awal ini darimana?";
                    @endphp
                    <td class="currency">{{ $totalAwalKas }}</td>
                </tr>
                <tr>
                    <td colspan="3">
                         <strong>Saldo Akhir Kas</strong>
                    </td>
                    @php
                         $totalAkhirKas = "$totalKenaikanPenurunanKas + $totalAwalKas";
                    @endphp
                    <td class="currency">{{ $totalAkhirKas }}</td>
                </tr>
            </tbody>
            <tfoot class = "total">
            </tfoot>

        </table>
        @include('report.signature')
