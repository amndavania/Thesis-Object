<x-app-layout>
    <x-slot name="title">
        Dashboard Mahasiswa
    </x-slot>
        <!-- Main content -->
        <div class="content">
          <div class="container-fluid">
            <div class="row justify-content-between">
                <div class="col d-flex">
                  <div class="info-box">
                    <span class="info-box-icon bg-success elevation-1"><i class="fas fa-arrow-up"></i></span>

                    <div class="info-box-content">
                      <span class="info-box-text">UKT telah lunas</span>
                      <span class="info-box-number text-lg">
                        {{ $uktLunas }}
                      </span>
                      {{-- <span class="info-box-number text-lg">
                        {{ 'Rp ' . number_format(10000000, 2, ',', '.') }}
                      </span> --}}
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                  <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col d-flex">
                  <div class="info-box mb-3">
                    {{-- @if ($labarugi < 0)
                        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-arrow-down"></i></span>
                    @else
                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-arrow-up"></i></span>
                    @endif --}}
                    <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-arrow-down"></i></span>
                    <div class="info-box-content">
                      <span class="info-box-text">UKT Belum Lunas</span>
                      <span class="info-box-number text-lg">
                        {{-- {{ 'Rp ' . number_format($labarugi, 2, ',', '.') }} --}}
                        {{ $uktBelumLunas }}
                      </span>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                  <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col d-flex">
                  <div class="info-box mb-3">
                    <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-user-graduate"></i></span>

                    <div class="info-box-content">
                      <span class="info-box-text">Jumlah Mahasiswa</span>
                      {{-- <span class="info-box-number text-lg">{{ $students }}</span> --}}
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                  <!-- /.info-box -->
                </div>
                <!-- /.col -->
              </div>

                {{-- <div class="card">
                  <div class="card-header border-0">
                    <div class="d-flex justify-content-between">
                      <h3 class="card-title">Keuangan</h3>
                      <a href="javascript:void(0);">Lihat Laporan</a>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="d-flex">
                      <p class="d-flex flex-column">
                        <span class="text-bold text-lg">Rp {{ number_format($saldoBulanLalu, 2, ',', '.') }}</span>
                        <span>Perkembangan keuangan</span>
                      </p>
                      <p class="ml-auto d-flex flex-column text-right">
                        <span class="text-success">
                            @if ($growPercentage[0] > $growPercentage[1])
                                <i class="fas fa-arrow-up"></i> {{$growPercentage[0]}}%
                            @else
                                <i class="fas fa-arrow-down"></i> {{$growPercentage[0]}}%
                            @endif
                        </span>
                        <span class="text-muted">Bulan lalu</span>
                      </p>
                    </div>
                    <!-- /.d-flex -->

                    <div class="position-relative mb-4">
                        <canvas id="balance-chart" height="200"></canvas>
                    </div>
                    
                    <script>
                        var trendKeuangan = {!! json_encode($trendKeuangan) !!};
                    </script>
                    
                    <div class="d-flex flex-row justify-content-end">
                      <span class="mr-2">
                        <i class="fas fa-square text-primary"></i> Tahun ini
                      </span>

                      <span>
                        <i class="fas fa-square text-gray"></i> Tahun lalu
                      </span>
                    </div>
                  </div>
                </div> --}}

            {{-- <div class="row">
              <div class="col-lg-6">
                <div class="card">
                  <div class="card-header border-0">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title">Transaksi Terbaru</h3>
                        <a href="{{ route('transaction.index') }}">Lihat Semua Transaksi</a>
                      </div>
                  </div>
                  <div class="card-body table-responsive p-0">
                    <table class="table table-striped table-valign-middle">
                      <thead>
                      <tr>
                        <th>Deskripsi</th>
                        <th>Akun Transaksi</th>
                        <th>Tipe</th>
                        <th>Nominal</th>
                      </tr>
                      </thead>
                      <tbody>
                      <tr>
                        @foreach ($transactions as $row)
                         <tr>
                              <td>{{ $row->description }}</td>
                              <td>{{ $row->transactionaccount->name }}</td>
                              <td>{{ $row->type }}</td>
                              <td>{{ 'Rp ' . number_format($row->amount, 2, ',', '.') }}</td>
                         </tr>
                    @endforeach
                      </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
                <!-- /.card -->
              </div>
              <!-- /.col-md-6 -->
              <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">Pembayaran UKT Mahasiswa</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-8">

                          <div class="chart-responsive">
                            <canvas id="pieChart" height="150"></canvas>
                          </div>

                          <script>
                            var statusUKT = {!! json_encode($statusUKT) !!};
                        </script>

                          <!-- ./chart-responsive -->
                        </div>
                        <!-- /.col -->
                        <div class="col-md-4">
                          <ul class="chart-legend clearfix">
                            <li><i class="far fa-circle text-success"></i> Lunas</li>
                            <li><i class="far fa-circle text-warning"></i> Belum Lunas</li>
                            <li><i class="far fa-circle text-danger"></i> Belum Bayar</li>
                          </ul>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->
                    </div>
                    <!-- /.card-body -->
                  </div>
                <!-- /.card -->
              </div>
              <!-- /.col-md-6 -->
            </div> --}}
            <!-- /.row -->
          </div>
          <!-- /.container-fluid -->
        </div>
        <!-- /.content -->
</x-app-layout>
