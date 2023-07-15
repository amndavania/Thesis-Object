<x-guest-layout>
    <x-slot name="title">
      Membuat Akun Baru
    </x-slot>
    <div class="register-box">
        <div class="card card-outline card-primary">
          <div class="card-header text-center">
            {{-- <a href="index2.html" class="h1"><b>Admin</b>LTE</a> --}}
             <div class="text-center">
              <img src='../../img/logo.webp' class="rounded shadow" alt="IAI IBRAHIMY" style="max-height: 150px;">
            </div>
          </div>
          <div class="card-body">
            <p class="login-box-msg">Membuat pengguna baru</p>
            <form method="POST" action="{{ route('register') }}" novalidate>
              @csrf
              <div class="input-group mb-3">
                <x-text-input id="name" type="text" name="name" placeholder="Full Name" :value="old('name')" required autofocus autocomplete="name" />
                <x-icon-input icon="fas fa-user"/>
              </div>
              <x-input-error :messages="$errors->get('name')" class="mt-1" />
              <div class="input-group mb-3">
                <x-text-input id="email" placeholder="Email" type="email" name="email" :value="old('email')" required autocomplete="username" />
                <x-icon-input icon="fas fa-envelope"/>
              </div>
              <x-input-error :messages="$errors->get('email')" class="mt-1" />
              <div class="input-group mb-3">
               <select class="form-control" id="role" name="role">
                  <option>Role</option>
                  <option value="super admin">Super Admin</option>
                  <option value="admin keuangan">Admin Keuangan</option>
               </select>
              </div>
              <div class="input-group mb-3">
                <x-text-input id="password" placeholder="Password" type="password" name="password" required autocomplete="new-password" />
                <x-icon-input icon="fas fa-lock"/>
              </div>
              <x-input-error :messages="$errors->get('password')" class="mt-1" />
              <div class="input-group mb-3">
                <x-text-input id="password_confirmation"  placeholder="Retype password" type="password" name="password_confirmation"  required autocomplete="new-password" />
                <x-icon-input icon="fas fa-lock"/>
              </div>
              <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
              <div class="row">
                <div class="col-8">
                  <div class="icheck-primary">
                    <input type="checkbox" id="agreeTerms" name="terms" value="agree">
                    <label for="agreeTerms">
                    Yakin ingin membuat akun ini?
                    </label>
                  </div>
                </div>
                <!-- /.col -->
                <div class="col-4">
                  <x-primary-button>
                    {{ __('Daftar') }}
                </x-primary-button>
                </div>
                <!-- /.col -->
              </div>
            </form>
            <a class="text-center" href="{{ route('login') }}">
              {{ __('Kembali ke Dashboard') }}
          </a>
          </div>
          <!-- /.form-box -->
        </div><!-- /.card -->
      </div>
</x-guest-layout>
