<x-guest-layout>
    <div class="login-box">
        <div class="card card-outline card-primary">
          <div class="card-header text-center">
            <div class="text-center">
              <img src='../../img/logo.webp' class="rounded shadow" alt="IAI IBRAHIMY" style="max-height: 200px;">
            </div>
          </div>
          <div class="card-body">
            <p class="login-box-msg">Anda lupa kata sandi Anda? Di sini Anda dapat dengan mudah mengambil kata sandi baru.</p>
                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />
            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="input-group mb-3">
                    <x-text-input id="email" placeholder="Email" type="email" name="email" :value="old('email')" required autocomplete="username" />
                    <x-icon-input icon="fas fa-envelope"/>
                </div>
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
              <div class="row">
                <div class="col-12">
                    <x-primary-button>
                        {{ __('Request new password') }}
                    </x-primary-button>
                </div>
                <!-- /.col -->
              </div>
            </form>
            <p class="mt-3 mb-1">
                <a href="{{ route('login') }}">{{ __('Login') }}</a>
            </p>
          </div>
          <!-- /.login-card-body -->
        </div>
      </div>
</x-guest-layout>
