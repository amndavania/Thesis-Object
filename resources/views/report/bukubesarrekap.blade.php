<x-app-layout>
    <x-slot name="title">
      Buku Besar
    </x-slot>
    <div class="card">
     <div class="card-header">
          <div class="d-flex align-items-center">
          <form class="form-inline" action="{{ route('bukubesarrekap.index') }}" method="GET">

    <input type="text" class="form-control mb-2 mr-sm-2" id="datepicker" name="datepicker" placeholder="Pilih Bulan" readonly>
    <button type="submit" class="btn btn-primary mb-2">Cari</button>
</form>
@if (!empty($data))
              <button onclick="window.open('{{ url('bukubesarrekap/export') }}?datepicker={{ $datepicker }}', '_blank')" class="btn btn-sm btn-primary ml-auto p-2">
                <i class="fas fa-print"></i> Export PDF
            </button>
              @endif
          </div>
     </div>
         <div class="card-body">
            <h5>
                @if (!empty($datepicker))
                    <span class="badge bg-warning">{{ $datepicker  }}</span>
                @endif
            </h5>
          <table class="table table-striped ">
               <thead class="table-dark">
               <tr>
                         <th>No</th>
                         <td>Kode Akun</td>
                         <td>Nama</td>
                         <td>Deskripsi</td>
                         <td>Debit</td>
                         <td>Kredit</td>
                    </tr>
               </thead>
               <tbody>
                   @php
                $totalDebit = 0;
                $totalKredit = 0;
                @endphp

                @foreach ($data as $row)
                <tr onclick="window.open('{{ route('bukubesar.index') }}?search_account={{ $row['id'] }}&datepicker={{ $datepicker }}', '_blank')"
                        style="cursor: pointer; background-color: #f5f5f5;" onmouseover="this.style.backgroundColor='#e9e9e9';" onmouseout="this.style.backgroundColor='#f5f5f5';">
                    <th>{{ $loop->iteration }}</th>
                    <td>{{ $row['id'] }}</td>
                    <td>{{ $row['name'] }}</td>
                    <td>{{ $row['description'] }}</td>
                    <td style="@if ($row['debit'] < 0) color: red; @endif; width:20%">
                        @if ($row['debit'] < 0)
                            (Rp {{ number_format(abs($row['debit']), 2, ',', '.') }})
                        @elseif ($row['debit'] > 0 || $row['debit'] == 0)
                            Rp {{ number_format($row['debit'], 2, ',', '.') }}
                        @else
                            -
                        @endif
                    </td>
                    <td style="@if ($row['kredit'] < 0) color: red; @endif; width:20%">
                        @if ($row['kredit'] < 0)
                            (Rp {{ number_format(abs($row['kredit']), 2, ',', '.') }})
                        @elseif ($row['kredit'] > 0 || $row['kredit'] == 0)
                            Rp {{ number_format($row['kredit'], 2, ',', '.') }}
                        @else
                            -
                        @endif
                    </td>
                </tr>
                @php
                $totalDebit += $row['debit'];
                $totalKredit += $row['kredit'];
                @endphp
            @endforeach
               </tbody>
               <tfoot class="table-dark">
                <tr>
                        <td colspan="4">
                             <strong>Total</strong>
                        </td>
                        <td style="@if (($totalDebit) < 0) color: red; @endif;">
                            @if (($totalDebit) < 0)
                                (Rp {{ number_format(abs(($totalDebit)), 2, ',', '.') }})
                            @elseif (($totalDebit) > 0 || ($totalDebit) == 0)
                                Rp {{ number_format(($totalDebit), 2, ',', '.') }}
                            @else
                                -
                            @endif
                        </td>
                        <td style="@if (($totalKredit) < 0) color: red; @endif;">
                            @if (($totalKredit) < 0)
                                (Rp {{ number_format(abs(($totalKredit)), 2, ',', '.') }})
                            @elseif (($totalKredit) > 0 || ($totalKredit) == 0)
                                Rp {{ number_format(($totalKredit), 2, ',', '.') }}
                            @else
                                -
                            @endif
                        </td>
                    </tr>
                <tr>
                        <td colspan="4">
                             <strong>Total</strong>
                        </td>
                        <td style="@if (($totalDebit - $totalKredit) < 0) color: red; @endif; text-align: center;" colspan="2">
                            @if (($totalDebit - $totalKredit) < 0)
                                (Rp {{ number_format(abs(($totalDebit - $totalKredit)), 2, ',', '.') }})
                            @elseif (($totalDebit - $totalKredit) > 0 || ($totalDebit - $totalKredit) == 0)
                                Rp {{ number_format(($totalDebit - $totalKredit), 2, ',', '.') }}
                            @else
                                -
                            @endif
                        </td>
                    </tr>
                </tfoot>
          </table>
     </div>
    </div>
</x-app-layout>
