<div class="sidebar" style="position: fixed;">
    <!-- Sidebar user panel (optional) -->
    <a href="/" class="brand-link">
  <img src='../../img/logo.webp' alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
  <h5 class="font-weight-light">IAI Ibrahimy</h5>
</a>
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="info">
        <h5 class="d-block brand-text text-light">Selamat Datang, <b>{{ strtok(Auth::user()->name, ' ') }}</b>!</h5>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

        @if(Auth::user()->role == 'super admin')
          {{-- menu --}}
          <li class="nav-item has-treeview">
            <a href="{{ route('dashboard') }}" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          @endif

          @if(Auth::user()->role == 'super admin' || Auth::user()->role == 'admin keuangan')
          {{-- menu sub--}}
          <li class="nav-item has-treeview menu-closed">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-coins"></i>
              <p>
                Transaksi
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('transaction.index') }}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Data Transaksi</p>
                    </a>
                  </li>
                <li class="nav-item">
                    <a href="{{ route('transaction_account.index') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                      <p>
                        Akun Transaksi
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('accounting_group.index') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                      <p>
                        Grup Akun Transaksi
                      </p>
                    </a>
                  </li>
            </ul>
          </li>
          @endif

          {{-- menu sub--}}
          <li class="nav-item has-treeview menu-closed">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-file-invoice-dollar"></i>
              <p>
                Laporan Keuangan
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('jurnal.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Jurnal</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('bukubesarrekap.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Buku Besar</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('labarugi.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Laba Rugi</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('neraca.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Neraca</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('cashflow.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Cash Flow</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('perubahanmodal.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Perubahan Modal</p>
                </a>
              </li>
            </ul>
          </li>

          @if(Auth::user()->role == 'super admin')
          {{-- menu sub--}}
          <li class="nav-item has-treeview menu-closed">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-university"></i>
              <p>
                Akademik
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('dpa.index') }}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>DPA</p>
                    </a>
                  </li>
                <li class="nav-item">
                    <a href="{{ route('faculty.index') }}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Fakultas</p>
                    </a>
                  </li>
              <li class="nav-item">
                <a href="{{ route('study_program.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Program Studi</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('student_type.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Skema Pembayaran</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview menu-closed">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-school"></i>
              <p>
                Kemahasiswaan
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('student.index') }}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Daftar Mahasiswa</p>
                    </a>
                  </li>
                <li class="nav-item">
                    <a href="{{ route('ukt.index') }}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Pembayaran Mahasiswa</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('uktdetail.index') }}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Detail Pembayaran</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('bimbinganstudi.index') }}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Lembar Bimbingan Studi</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('examcard.index') }}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Kartu Ujian</p>
                    </a>
                  </li>
            </ul>
          </li>

          @if(Auth::user()->role == 'super admin' || Auth::user()->role == 'dpa')
          {{-- menu sub--}}
          <li class="nav-item has-treeview menu-closed">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-coins"></i>
              <p>
                DPA
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('transaction.index') }}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Daftar Mahasiswa</p>
                    </a>
                  </li>
                <li class="nav-item">
                    <a href="{{ route('transaction_account.index') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                      <p>
                        Detail Mahasiswa
                      </p>
                    </a>
                  </li>
            </ul>
          </li>
          @endif

        {{-- menu --}}
          <li class="nav-item has-treeview">
            <a href="{{ route('dashboardmhs') }}" class="nav-link">
              <i class="nav-icon fas fa-user-graduate"></i>
              <p>
                Dasbor Mahasiswa
              </p>
            </a>
          </li>
        {{-- menu --}}
          <li class="nav-item has-treeview">
            <a href="{{ route('pengguna.index') }}" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Pengguna
              </p>
            </a>
          </li>
        @endif

        {{-- menu sub--}}
        
          {{-- menu --}}
          <li class="nav-item has-treeview">
            <a href="{{ route('profile.edit') }}" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Profile
              </p>
            </a>
          </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->

  </div>
