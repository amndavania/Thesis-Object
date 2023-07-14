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
               <tr style="text-align: center;">
                         <th>No</th>
                         <td>Kode Akun</td>
                         <td>Nama</td>
                         <td>Deskripsi</td>
                         <td>Saldo</td>
                    </tr>
               </thead>
               <tbody>
               @php
                                $totalSaldo = 0;
                                
                                @endphp
                    @foreach ($data as $row)
                         <tr onclick="window.open('{{ route('bukubesar.index') }}?search_account={{ $row['id'] }}&datepicker={{ $datepicker }}', '_blank')" 
                         style="cursor: pointer; background-color: #f5f5f5;" onmouseover="this.style.backgroundColor='#e9e9e9';" onmouseout="this.style.backgroundColor='#f5f5f5';">
                              <th>{{ $loop->iteration }}</th>
                              <td>{{ $row['id'] }}</td>
                              <td>{{ $row['name'] }}</td>
                              <td>{{ $row['description'] }}</td>
                              <td style="@if (($row['balance']) < 0) color: red; @endif; text-align: right; width:20%" colspan="2">
                            @if (($row['balance']) < 0)
                                (Rp {{ number_format(abs(($row['balance'])), 2, ',', '.') }})
                            @elseif (($row['balance']) > 0 || ($row['balance']) == 0)
                                Rp {{ number_format(($row['balance']), 2, ',', '.') }}
                            @else
                                -
                            @endif
                        </td>
                         </tr>                              
                         @php
                    $totalSaldo += $row['balance'];
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
          </table>
     </div>
    </div>
</x-app-layout>
