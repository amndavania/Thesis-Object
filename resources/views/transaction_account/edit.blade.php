<x-app-layout>
    <x-slot name="title">
        Akun Akuntansi
    </x-slot>
    <div class="card">
     <div class="card-header">
          <div class="text-center">
               <h4>Ubah Data</h4>
          </div>
     </div>
     <div class="card-body">
            @include('message.form-message')
          <form method="post" class="mx-2 p-4" action="{{ route('transaction_account.update', $transaction_account->id) }}">
               @csrf
               @method('put')
          <div class="form-group">
               <label for="id">ID Akun</label>
               <input type="text" class="form-control" name="id" id="id" placeholder="Masukkan ID Akun" value="{{ old('id', $transaction_account->id) }}" readonly>
          </div>
          <div class="form-group">
               <label for="name">Nama Akun</label>
               <input type="text" class="form-control" name="name" id="name" placeholder="Masukkan nama akun" value="{{ old('name', $transaction_account->name) }}">
          </div>
          <div class="form-group">
               <label for="description">Deskripsi</label>
               <input type="text" class="form-control" name="description" id="description" placeholder="Masukkan deskripsi" value="{{ old('description', $transaction_account->description) }}">
          </div>
          <div class="form-group">
            <label for="lajurSaldo">Lajur Saldo</label>
            <select class="form-control" id="lajurSaldo" name="lajurSaldo" value="{{ old('lajurSaldo', $transaction_account->lajurSaldo) }}">
               <option value="debit">Debit</option>
               <option value="kredit">Kredit</option>
            </select>
        </div>
        <div class="form-group">
            <label for="lajurLaporan">Lajur Laporan</label>
            <select class="form-control" id="lajurLaporan" name="lajurLaporan" value="{{ old('lajurLaporan', $transaction_account->lajurLaporan) }}">
               <option value="neraca">Neraca</option>
               <option value="labaRugi">Laba Rugi</option>
            </select>
        </div>
          <div class="form-group">
            <label for="accounting_group_id">Grup</label>
            <select class="form-control" id="accounting_group_id" name="accounting_group_id[]" multiple>
                @foreach ($accounting_group as $item)
                <option value="{{ $item->id }}" {{ in_array($item->id, $transaction_account->accountinggroup->pluck('id')->toArray()) ? 'selected' : '' }}>
                    {{ $item->name }}
                </option>
                @endforeach
           </select>
          </div>
          <div class="d-flex justify-content-end">
            <button type="button" class="btn btn-outline-danger mr-2" onclick="window.location='{{ route('transaction_account.index') }}'">Batal</button>
               <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
          </form>
     </div>
    </div>
</x-app-layout>
