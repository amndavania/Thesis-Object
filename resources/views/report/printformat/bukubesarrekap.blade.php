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
                <td>{{ $datepicker }}</td>
            </tr>
            <tr>
                <td>
                    Tanggal Dicetak
                </td>
                <td>:</td>
                <td>{{ $today }}</td>
            </tr>
        </table>
        <table class="content">
            <thead>
                <tr>
                    <th style="width: 5%;">No</th>
                    <th style="width: 10%;">ID</th>
                    <th style="width: 20%;">Nama</th>
                    <th style="width: 50%;">Deskripsi</th>
                    <th style="width: 15%;">Saldo</th>
                </tr>
            </thead>
            <tbody>
               @php
                                $totalSaldo = 0;
                                
                                @endphp
                    @foreach ($data as $row)
                         <tr>
                              <th>{{ $loop->iteration }}</th>
                              <td style="text-align: center;">{{ $row->id }}</td>
                              <td>{{ $row->name }}</td>
                              <td>{{ $row->description }}</td>
                              <td style="@if (($row->balance) < 0) color: red; @endif; text-align: center; width:20%" colspan="2">
                            @if (($row->balance) < 0)
                                (Rp {{ number_format(abs(($row->balance)), 2, ',', '.') }})
                            @elseif (($row->balance) > 0 || ($row->balance) == 0)
                                Rp {{ number_format(($row->balance), 2, ',', '.') }}
                            @else
                                -
                            @endif
                        </td>
                         </tr>                              
                         @php
                    $totalSaldo += $row->balance;
                    @endphp
                    @endforeach
               </tbody>
               <tfoot class="table-dark">
                <tr>
                        <td colspan="4">
                             <strong>Total balance</strong>
                        </td>
                        <td style="@if (($totalSaldo) < 0) color: red; @endif; text-align: center;" colspan="2">
                            @if (($totalSaldo) < 0)
                                (Rp {{ number_format(abs(($totalSaldo)), 2, ',', '.') }})
                            @elseif (($totalSaldo) > 0 || ($totalSaldo) == 0)
                                Rp {{ number_format(($totalSaldo), 2, ',', '.') }}
                            @else
                                -
                            @endif
                        </td>
                    </tr>
                </tfoot>
            </div>
        </table>
        @include('report.signature')
