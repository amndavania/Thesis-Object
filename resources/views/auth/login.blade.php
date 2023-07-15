<x-guest-layout>
    <x-slot name="title">
        Masuk Sistem
    </x-slot>
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
          <div class="card-header text-center bg-light">
            {{-- <a href="../../index2.html" class="h1"><b>Admin</b>LTE</a> --}}
            {{-- bug here --}}
            <div class="text-center">
              <img src='../../img/logo.webp' class="rounded shadow" alt="IAI IBRAHIMY" style="max-height: 200px;">
            </div>
          </div>
          <div class="card-body">
            <p class="login-box-msg">Masuk untuk memulai sesi Anda</p>
          <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="input-group mb-3">
                    <x-text-input id="email" placeholder="Email" type="email" name="email" :value="old('email')" required autocomplete="username" />
                    <x-icon-input icon="fas fa-envelope"/>
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                  </div>
                  <div class="input-group mb-3">
                    <x-text-input id="password" 
                                  placeholder="Password"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
                  <x-icon-input icon="fas fa-lock"/>
                  <x-input-error :messages="$errors->get('password')" class="mt-2" />
                  </div>
              <div class="row">
                <div class="col-8">
                  <div class="icheck-primary">
                    <input type="checkbox" id="remember">
                    <label for="remember">
                      Ingat Saya
                    </label>
                  </div>
                </div>
                <!-- /.col -->
                <div class="col-4">
                    <x-primary-button>
                      {{ __('Masuk') }}
                  </x-primary-button>
                  </div>
                <!-- /.col -->
              </div>
            </form>

            
        @if (Route::has('password.request'))
            <p class="mb-1">
              <a href="{{ route('password.request') }}">{{ __('Lupa Password?') }}</a>
            </p>
            @endif
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
</x-guest-layout>