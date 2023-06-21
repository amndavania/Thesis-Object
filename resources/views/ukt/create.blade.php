<x-app-layout>
    <x-slot name="title">
        Pembayaran Mahasiswa
    </x-slot>
    <div class="card">
     <div class="card-header">
          <div class="text-center">
               <h4>Tambah Data</h4>
          </div>
     </div>
     <div class="card-body">
        @include('message.form-message')
          <form class="mx-2 p-4" action="{{ route('ukt.store') }}" method="POST">
               @csrf
          <div class="form-group">
               <label for="students_id">Mahasiswa</label>
               <select class="form-control selectpicker" name="students_id" id="students_id" data-live-search="true">
                <option value="">Pilih Mahasiswa</option>
                @foreach ($student as $student)
                    <option value="{{ $student->id }}">{{ $student->nim . ' / ' . $student->name }}</option>
                @endforeach
            </select>
          </div>
          <div class="form-group">
               <label for="semester">Semester</label>
               <select class="form-control" id="semester" name="semester">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                    <option value="13">13</option>
                    <option value="14">14</option>
               </select>
          </div>
          <div class="form-group">
               <label for="type">Jenis</label>
               <select class="form-control" id="type" name="type">
                    <option value="DPP">DPP</option>
                    <option value="UKT">UKT</option>
                    <option value="WISUDA">WISUDA</option>
               </select>
          </div>
          <div class="form-group">
               <label for="reference_number">Reference Number</label>
               <input type="number" class="form-control" id="reference_number" name="reference_number" placeholder="Reference Number..." value="{{ old('reference_number') }}">
          </div>
          <div class="form-group">
               <label for="amount">Jumlah</label>
               <input type="number" class="form-control" id="amount" name="amount" placeholder="Jumlah..." value="{{ old('amount') }}">
          </div>
          {{-- <div class="form-group">
               <label for="total">Total</label>
               <input type="number" class="form-control" id="total" name="total" placeholder="Total..." value="{{ old('total') }}">
          </div> --}}
          {{-- <div class="form-group">
               <label for="status">Status</label>
               <select class="form-control" id="status" name="status">
                    <option value="lunas">Lunas</option>
                    <option value="dispensasi">Dispensasi</option>
                    <option value="belum bayar">Belum bayar</option>
           </select>
          </div> --}}
          {{-- <div class="form-group">
               <label for="transaction_accounts_id">Akun Transaksi</label>
               <select class="form-control" id="transaction_accounts_id" name="transaction_accounts_id">
                    @foreach ($transaction_account as $item)
                         <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
               </select>
          </div> --}}
          <div class="d-flex justify-content-end">
               <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
          </form>
     </div>
    </div>
</x-app-layout>
