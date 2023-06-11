<x-app-layout>
    <x-slot name="title">
      Neraca
    </x-slot>
    <div class="card">
        <div class="card-header">
            <div class="d-flex">
              <form class="form-inline" action="{{ route('neraca.index') }}" method="GET">
                    <input type="text" class="form-control mb-2 mr-sm-2" id="datepicker" name="datepicker" placeholder="Pilih Bulan" readonly>
                    <button type="submit" class="btn btn-primary mb-2">Cari</button>
                </form>
                <button onclick="window.open('{{ url('neraca/export') }}?datepicker={{ $datepicker }}', '_blank')" class="btn btn-sm btn-primary ml-auto p-2">Export PDF</button>
            </div>
       </div>
         <div class="card-body">
            <h5>Periode : {{ !empty($datepicker) ? $datepicker : '-' }}</h5>
          <table class="table table-striped ">
               <thead class="table-dark">
                    <tr>
                         <td>ID Akun</td>
                         <td>Nama Akun</td>
                         <td>Saldo</td>
                    </tr>
               </thead>
               <tbody>
               <tr>
                    <td colspan="3">
                         <strong>AKTIVA</strong>
                    </td>
                </tr>
               <tr>
                    <td colspan="3">
                         <strong>Aktiva Lancar</strong>
                    </td>
                </tr>
               @php
               $totalAktivaLancar = 0;
               @endphp
                    @foreach ($dataA as $row)
                         <tr>
                              <td>{{ $row->id }}</td>
                              <td>{{ $row->name }}</td>
                              @php
                                  $saldo = $row->ammount_debit - $row->ammount_kredit;
                              @endphp
                              <td>
                                @if ($saldo < 0)
                                    (Rp {{ number_format(abs($saldo), 2, ',', '.') }})
                                @elseif ($saldo > 0)
                                    Rp {{ number_format($saldo, 2, ',', '.') }}
                                @else
                                    -
                                @endif
                            </td>
                         </tr>
                         @php
                         $totalAktivaLancar += $row->ammount_debit - $row->ammount_kredit;
                         @endphp
                    @endforeach
               <tr>
                    <td colspan="3">
                    <strong>Aktiva Tetap</strong>
                    </td>
                </tr>
               @php
               $totalAktivaTetap = 0;
               @endphp
                    @foreach ($dataB as $row)
                         <tr>
                              <td>{{ $row->id }}</td>
                              <td>{{ $row->name }}</td>
                              @php
                                  $saldo = $row->ammount_debit - $row->ammount_kredit;
                              @endphp
                              <td>
                                @if ($saldo < 0)
                                    (Rp {{ number_format(abs($saldo), 2, ',', '.') }})
                                @elseif ($saldo > 0)
                                    Rp {{ number_format($saldo, 2, ',', '.') }}
                                @else
                                    -
                                @endif
                            </td>
                         </tr>
                         @php
                         $totalAktivaTetap += $row->ammount_debit - $row->ammount_kredit;
                         @endphp
                    @endforeach
               <tr>
                    <td colspan="2">
                         <strong>Total Aktiva</strong>
                    </td>
                    @php
                        $totalAktiva = $totalAktivaLancar + $totalAktivaTetap;
                    @endphp
                    <td>
                        @if ($totalAktiva < 0)
                            (Rp {{ number_format(abs($totalAktiva), 2, ',', '.') }})
                        @elseif ($totalAktiva > 0)
                            Rp {{ number_format($totalAktiva, 2, ',', '.') }}
                        @else
                            -
                        @endif
                    </td>
                </tr>
               <tr>
                    <td colspan="3">
                    <strong>PASIVA</strong>
                    </td>
                </tr>
               <tr>
                    <td colspan="3">
                    <strong>Hutang Lancar</strong>
                    </td>
                </tr>
               @php
               $totalHutangLancar = 0;
               @endphp
                    @foreach ($dataC as $row)
                         <tr>
                              <td>{{ $row->id }}</td>
                              <td>{{ $row->name }}</td>
                              @php
                                  $saldo = $row->ammount_debit - $row->ammount_kredit;
                              @endphp
                              <td>
                                @if ($saldo < 0)
                                    (Rp {{ number_format(abs($saldo), 2, ',', '.') }})
                                @elseif ($saldo > 0)
                                    Rp {{ number_format($saldo, 2, ',', '.') }}
                                @else
                                    -
                                @endif
                            </td>
                         </tr>
                         @php
                         $totalHutangLancar += $row->ammount_debit - $row->ammount_kredit;
                         @endphp
                    @endforeach
               <tr>
                    <td colspan="3">
                    <strong>Hutang Jangka Panjang</strong>
                    </td>
                </tr>
               @php
               $totalHutangJangkaPanjang = 0;
               @endphp
                    @foreach ($dataD as $row)
                         <tr>
                              <td>{{ $row->id }}</td>
                              <td>{{ $row->name }}</td>
                              @php
                                  $saldo = $row->ammount_debit - $row->ammount_kredit;
                              @endphp
                              <td>
                                @if ($saldo < 0)
                                    (Rp {{ number_format(abs($saldo), 2, ',', '.') }})
                                @elseif ($saldo > 0)
                                    Rp {{ number_format($saldo, 2, ',', '.') }}
                                @else
                                    -
                                @endif
                            </td>
                         </tr>
                         @php
                         $totalHutangJangkaPanjang += $row->ammount_debit - $row->ammount_kredit;
                         @endphp
                    @endforeach
               <tr>
                    <td colspan="2">
                         <strong>Total Hutang</strong>
                    </td>
                    @php
                        $totalHutang = $totalHutangLancar + $totalHutangJangkaPanjang;
                    @endphp
                    <td>
                        @if ($totalHutang < 0)
                            (Rp {{ number_format(abs($totalHutang), 2, ',', '.') }})
                        @elseif ($totalHutang > 0)
                            Rp {{ number_format($totalHutang, 2, ',', '.') }}
                        @else
                            -
                        @endif
                    </td>
                </tr>
               <tr>
                    <td colspan="3">
                    <strong>Modal</strong>
                    </td>
                </tr>
               @php
               $totalModal = 0;
               @endphp
                    @foreach ($dataE as $row)
                         <tr>
                              <td>{{ $row->id }}</td>
                              <td>{{ $row->name }}</td>
                              @php
                                  $saldo = $row->ammount_debit - $row->ammount_kredit;
                              @endphp
                              <td>
                                @if ($saldo < 0)
                                    (Rp {{ number_format(abs($saldo), 2, ',', '.') }})
                                @elseif ($saldo > 0)
                                    Rp {{ number_format($saldo, 2, ',', '.') }}
                                @else
                                    -
                                @endif
                            </td>
                         </tr>
                         @php
                         $totalModal += $row->ammount_debit - $row->ammount_kredit;
                         @endphp
                    @endforeach
               <tr>
                    <td colspan="2">
                         <strong>Total Modal</strong>
                    </td>
                    <td>
                        @if ($totalModal < 0)
                            (Rp {{ number_format(abs($totalModal), 2, ',', '.') }})
                        @elseif ($totalModal > 0)
                            Rp {{ number_format($totalModal, 2, ',', '.') }}
                        @else
                            -
                        @endif
                    </td>
                </tr>
                </tbody>
          </table>
     </div>
    </div>
</x-app-layout>
