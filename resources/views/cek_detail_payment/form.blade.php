<x-guest-layout>
    <x-slot name="title">
        Cek Pembayaran Mahasiswa
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
            <p class="login-box-msg">Lihat data pembayaran Anda</p>
          <!-- Session Status -->
            
            <form action="{{ route('cekpembayaran.data') }}" method="GET">
                @csrf
                <div class="input-group mb-3">
                    <x-text-input id="name" placeholder="Nama Mahasiswa" type="text" name="name" :value="old('name')" required autocomplete="username" />
                    
                    {{-- <x-input-error :messages="$errors->get('email')" class="mt-2" /> --}}
                </div>
                <div class="input-group mb-3">
                    <x-text-input id="nim" placeholder="NIM Mahasiswa" type="number" name="nim" :value="old('nim')" required autocomplete="username" />
                    
                    {{-- <x-input-error :messages="$errors->get('email')" class="mt-2" /> --}}
                </div>
                <button type="submit" class="btn btn-block btn-primary">
                    Cari
                </button>
            </form>

          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
</x-guest-layout>
