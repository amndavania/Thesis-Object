<x-app-layout>
    <x-slot name="title">
        Dashboard
    </x-slot>
        <!-- Main content -->
        <div class="content">
          <div class="container-fluid">
            <div class="row justify-content-between">
                <div class="col d-flex">
                  <div class="info-box">
                    <span class="info-box-icon bg-info elevation-1"><i class="fas fa-coins"></i></span>

                    <div class="info-box-content">
                      <span class="info-box-text">Total Saldo</span>
                      <span class="info-box-number text-lg">
                        {{ 'Rp ' . number_format($saldo, 2, ',', '.') }}
                      </span>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                  <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col d-flex">
                  <div class="info-box mb-3">
                    @if ($labarugi < 0)
                        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-arrow-down"></i></span>
                    @else
                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-arrow-up"></i></span>
                    @endif
                    
                    <div class="info-box-content">
                      <span class="info-box-text">Laba / Rugi</span>
                      <span class="info-box-number text-lg">
                        {{ 'Rp ' . number_format($labarugi, 2, ',', '.') }}
                      </span>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                  <!-- /.info-box -->
                </div>
                <!-- /.col -->

                <!-- fix for small devices only -->
                {{-- <div class="clearfix hidden-md-up"></div>

                <div class="col-12 col-sm-6 col-md-3">
                  <div class="info-box mb-3">
                    <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

                    <div class="info-box-content">
                      <span class="info-box-text">Sales</span>
                      <span class="info-box-number">760</span>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                  <!-- /.info-box -->
                </div> --}}
                <!-- /.col -->
                <div class="col d-flex">
                  <div class="info-box mb-3">
                    <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-user-graduate"></i></span>

                    <div class="info-box-content">
                      <span class="info-box-text">Jumlah Mahasiswa</span>
                      <span class="info-box-number text-lg">{{ $students }}</span>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                  <!-- /.info-box -->
                </div>
                <!-- /.col -->
              </div>
            
                <div class="card">
                  <div class="card-header border-0">
                    <div class="d-flex justify-content-between">
                      <h3 class="card-title">Keuangan</h3>
                      <a href="javascript:void(0);">Lihat Laporan</a>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="d-flex">
                      <p class="d-flex flex-column">
                        <span class="text-bold text-lg">$18,230.00</span>
                        <span>Perkembangan keuangan</span>
                      </p>
                      <p class="ml-auto d-flex flex-column text-right">
                        <span class="text-success">
                          <i class="fas fa-arrow-up"></i> 33.1%
                        </span>
                        <span class="text-muted">Sejak bulan lalu</span>
                      </p>
                    </div>
                    <!-- /.d-flex -->

                    <div class="position-relative mb-4">
                      <canvas id="balance-chart" height="200"></canvas>
                    </div>

                    <div class="d-flex flex-row justify-content-end">
                      <span class="mr-2">
                        <i class="fas fa-square text-primary"></i> Tahun ini
                      </span>

                      <span>
                        <i class="fas fa-square text-gray"></i> Tahun lalu
                      </span>
                    </div>
                  </div>
                </div>

            <div class="row">
              <div class="col-lg-6">
                {{-- <div class="card">
                  <div class="card-header border-0">
                    <div class="d-flex justify-content-between">
                      <h3 class="card-title">Online Store Visitors</h3>
                      <a href="javascript:void(0);">View Report</a>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="d-flex">
                      <p class="d-flex flex-column">
                        <span class="text-bold text-lg">820</span>
                        <span>Visitors Over Time</span>
                      </p>
                      <p class="ml-auto d-flex flex-column text-right">
                        <span class="text-success">
                          <i class="fas fa-arrow-up"></i> 12.5%
                        </span>
                        <span class="text-muted">Since last week</span>
                      </p>
                    </div>
                    <!-- /.d-flex -->

                    <div class="position-relative mb-4">
                      <canvas id="visitors-chart" height="200"></canvas>
                    </div>

                    <div class="d-flex flex-row justify-content-end">
                      <span class="mr-2">
                        <i class="fas fa-square text-primary"></i> This Week
                      </span>
                      <span>
                        <i class="fas fa-square text-gray"></i> Last Week
                      </span>
                    </div>
                  </div>
                </div> --}}
                <!-- /.card -->

                <div class="card">
                  <div class="card-header border-0">
                    <h3 class="card-title">Akun transaksi yang sering digunakan</h3>
                    <div class="card-tools">
                      <a href="#" class="btn btn-tool btn-sm">
                        <i class="fas fa-download"></i>
                      </a>
                      <a href="#" class="btn btn-tool btn-sm">
                        <i class="fas fa-bars"></i>
                      </a>
                    </div>
                  </div>
                  <div class="card-body table-responsive p-0">
                    <table class="table table-striped table-valign-middle">
                      <thead>
                      <tr>
                        <th>Mahasiswa</th>
                        <th>Jenis</th>
                        <th>Nominal</th>
                        <th>Status</th>
                      </tr>
                      </thead>
                      <tbody>
                      <tr>
                        <td>
                          <img src={{asset('vendor/dist/img/default-150x150.png')}} alt="Product 1" class="img-circle img-size-32 mr-2">
                          Some Product
                        </td>
                        <td>$13 USD</td>
                        <td>
                          <small class="text-success mr-1">
                            <i class="fas fa-arrow-up"></i>
                            12%
                          </small>
                          12,000 Sold
                        </td>
                        <td>
                          <a href="#" class="text-muted">
                            <i class="fas fa-search"></i>
                          </a>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <img src={{asset('vendor/dist/img/default-150x150.png')}} alt="Product 1" class="img-circle img-size-32 mr-2">
                          Another Product
                        </td>
                        <td>$29 USD</td>
                        <td>
                          <small class="text-warning mr-1">
                            <i class="fas fa-arrow-down"></i>
                            0.5%
                          </small>
                          123,234 Sold
                        </td>
                        <td>
                          <a href="#" class="text-muted">
                            <i class="fas fa-search"></i>
                          </a>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <img src={{asset('vendor/dist/img/default-150x150.png')}} alt="Product 1" class="img-circle img-size-32 mr-2">
                          Amazing Product
                        </td>
                        <td>$1,230 USD</td>
                        <td>
                          <small class="text-danger mr-1">
                            <i class="fas fa-arrow-down"></i>
                            3%
                          </small>
                          198 Sold
                        </td>
                        <td>
                          <a href="#" class="text-muted">
                            <i class="fas fa-search"></i>
                          </a>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <img src={{asset('vendor/dist/img/default-150x150.png')}} alt="Product 1" class="img-circle img-size-32 mr-2">
                          Perfect Item
                          <span class="badge bg-danger">NEW</span>
                        </td>
                        <td>$199 USD</td>
                        <td>
                          <small class="text-success mr-1">
                            <i class="fas fa-arrow-up"></i>
                            63%
                          </small>
                          87 Sold
                        </td>
                        <td>
                          <a href="#" class="text-muted">
                            <i class="fas fa-search"></i>
                          </a>
                        </td>
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
      
                      <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                          <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                          <i class="fas fa-times"></i>
                        </button>
                      </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-8">
                          <div class="chart-responsive">
                            <canvas id="pieChart" height="150"></canvas>
                          </div>
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
                    <div class="card-footer p-0">
                      <ul class="nav nav-pills flex-column">
                        <li class="nav-item">
                          <a href="#" class="nav-link">
                            United States of America
                            <span class="float-right text-danger">
                              <i class="fas fa-arrow-down text-sm"></i>
                              12%</span>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a href="#" class="nav-link">
                            India
                            <span class="float-right text-success">
                              <i class="fas fa-arrow-up text-sm"></i> 4%
                            </span>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a href="#" class="nav-link">
                            China
                            <span class="float-right text-warning">
                              <i class="fas fa-arrow-left text-sm"></i> 0%
                            </span>
                          </a>
                        </li>
                      </ul>
                    </div>
                    <!-- /.footer -->
                  </div>
                <!-- /.card -->

                {{-- <div class="card">
                  <div class="card-header border-0">
                    <h3 class="card-title">Transaksi Terbaru</h3>
                    <div class="card-tools">
                      <a href="#" class="btn btn-sm btn-tool">
                        <i class="fas fa-download"></i>
                      </a>
                      <a href="#" class="btn btn-sm btn-tool">
                        <i class="fas fa-bars"></i>
                      </a>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                      <p class="text-success text-xl">
                        <i class="ion ion-ios-refresh-empty"></i>
                      </p>
                      <p class="d-flex flex-column text-right">
                        <span class="font-weight-bold">
                          <i class="ion ion-android-arrow-up text-success"></i> 12%
                        </span>
                        <span class="text-muted">CONVERSION RATE</span>
                      </p>
                    </div>
                    <!-- /.d-flex -->
                    <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                      <p class="text-warning text-xl">
                        <i class="ion ion-ios-cart-outline"></i>
                      </p>
                      <p class="d-flex flex-column text-right">
                        <span class="font-weight-bold">
                          <i class="ion ion-android-arrow-up text-warning"></i> 0.8%
                        </span>
                        <span class="text-muted">SALES RATE</span>
                      </p>
                    </div>
                    <!-- /.d-flex -->
                    <div class="d-flex justify-content-between align-items-center mb-0">
                      <p class="text-danger text-xl">
                        <i class="ion ion-ios-people-outline"></i>
                      </p>
                      <p class="d-flex flex-column text-right">
                        <span class="font-weight-bold">
                          <i class="ion ion-android-arrow-down text-danger"></i> 1%
                        </span>
                        <span class="text-muted">REGISTRATION RATE</span>
                      </p>
                    </div>
                    <!-- /.d-flex -->
                  </div>
                </div> --}}
              </div>
              <!-- /.col-md-6 -->
            </div>
            <!-- /.row -->
          </div>
          <!-- /.container-fluid -->
        </div>
        <!-- /.content -->
</x-app-layout>
