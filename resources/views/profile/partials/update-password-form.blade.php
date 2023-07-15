<!-- Main content -->
<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header p-2">
                <h5>Perbarui Password</h5>
            </div><!-- /.card-header -->
            <div class="card-body">
                <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6" autocomplete="off" >
                    @csrf
                    @method('put')
                    <div class="form-group row">
                        <x-input-label for="current_password" :value="__('Password saat ini')" />
                        <div class="col-sm-10">
                            <x-text-input id="current_password" placeholder="Password saat ini" name="current_password" type="password" autocomplete="new-password" />
                            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <x-input-label for="password" :value="__('Password Baru')" />
                        <div class="col-sm-10">
                            <x-text-input id="password" name="password" type="password" placeholder="New Password" autocomplete="new-password" />
                            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" />
                        <div class="col-sm-10">
                            <x-text-input id="password_confirmation" name="password_confirmation" type="password" placeholder="Confirm Password" autocomplete="new-password" />
                            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
                        </div>
                    </div>
                    

                    <div class="form-group row">
                      <div class="offset-sm-2 col-sm-10">
                        <x-primary-button>{{ __('Save') }}</x-primary-button>
                        @if (session('status') === 'password-updated')
                          <h5 class="text text-success mt-2">Password telah diperbarui!</h5>
                        @endif
                      </div>
                    </div>
                  </form>
            </div><!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->