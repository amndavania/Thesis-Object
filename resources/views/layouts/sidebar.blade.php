<div class="sidebar">
    <!-- Sidebar user panel (optional) -->
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
                Dasbor
              </p>
            </a>
          </li>
          @endif

          @if(Auth::user()->role == 'super admin' || Auth::user()->role == 'admin penerimaan')
          {{-- menu sub--}}
          <li class="nav-item has-treeview menu-closed">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-money-bill-wave-alt"></i>
              <p>
                Pemasukan
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('ukt.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>UKT Mahasiswa</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('pemasukan.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pemasukan lain</p>
                </a>
              </li>
            </ul>
          </li>
          @endif

          @if(Auth::user()->role == 'super admin' || Auth::user()->role == 'admin pengeluaran')
          {{-- menu --}}
          <li class="nav-item has-treeview">
            <a href="{{ route('pengeluaran.index') }}" class="nav-link">
              <i class="nav-icon fas fa-coins"></i>
              <p>
                Pengeluaran
              </p>
            </a>
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
                <a href="{{ route('bukubesar.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Buku Besar</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('cashflow.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Cash Flow</p>
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
                <a href="{{ route('perubahanmodal.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Perubahan Modal</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('uktdetail.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Detail UKT</p>
                </a>
              </li>
            </ul>
          </li>
          {{-- menu --}}
          <li class="nav-item has-treeview">
            <a href="{{ route('transaction_account.index') }}" class="nav-link">
              <i class="nav-icon fas fa-wallet"></i>
              <p>
                Akun Transaksi
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="{{ route('accounting_group.index') }}" class="nav-link">
              <i class="nav-icon fas fa-wallet"></i>
              <p>
                Grup Akun Transaksi
              </p>
            </a>
          </li>

          @if(Auth::user()->role == 'super admin')
          {{-- menu sub--}}
          <li class="nav-item has-treeview menu-closed">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user-graduate"></i>
              <p>
                Akademik
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('student.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Mahasiswa</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('study_program.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Program Studi</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('faculty.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Fakultas</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('student_type.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Beasiswa</p>
                </a>
              </li>
            </ul>
          </li>
        @endif

        {{-- menu --}}
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Dasbor Mahasiswa
              </p>
            </a>
          </li>

          {{-- menu --}}
          <li class="nav-item has-treeview">
            <a href="{{ route('profile.edit') }}" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Pengguna
              </p>
            </a>
          </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->

  </div>
