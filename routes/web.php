<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountingGroupController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\DpaAcademicController;
use App\Http\Controllers\DpaController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudyProgramController;
use App\Http\Controllers\UktController;
use App\Http\Controllers\TransactionAccountController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\StudentTypeController;
use App\Http\Controllers\Report\JurnalController;
use App\Http\Controllers\Report\BukuBesarController;
use App\Http\Controllers\Report\BukuBesarRekapController;
use App\Http\Controllers\Report\CashFlowController;
use App\Http\Controllers\Report\NeracaController;
use App\Http\Controllers\Report\PerubahanModalController;
use App\Http\Controllers\Report\LabaRugiController;
use App\Http\Controllers\Report\UktDetailController;
use App\Http\Controllers\ExamCardController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\CekPembayaranController;
use App\Http\Controllers\KrsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    if (!Auth::check()) {
        return redirect('/cekpembayaran');
    } elseif (Auth::user()->role == 'DPA'){
        return redirect('/daftar_mahasiswa');
    } elseif (Auth::user()->role == 'akademik'){
        return redirect('/dpa');
    } else {
        return redirect('/dashboard');
    }
});

Route::get('cekpembayaran', [CekPembayaranController::class, 'index'])->name('cekpembayaran.index');
Route::get('databayar', [CekPembayaranController::class, 'data'])->name('cekpembayaran.data');
Route::get('databayar/export', [CekPembayaranController::class, 'export'])->name('cekpembayaran.export');
Route::get('databayar/exportLBS', [CekPembayaranController::class, 'exportLBS'])->name('cekpembayaran.exportLBS');
Route::get('databayar/lihatKartu', [CekPembayaranController::class, 'lihatKartu'])->name('cekpembayaran.lihatKartu');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::middleware('admin:super admin,admin keuangan')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::resource('transaction', TransactionController::class)->except(['show']);
        Route::resource('transaction_account', TransactionAccountController::class)->except(['show']);
        Route::resource('accounting_group', AccountingGroupController::class)->except(['show']);

        Route::resource('jurnal', JurnalController::class)->except(['show']);
        Route::resource('bukubesarrekap', BukuBesarRekapController::class)->except(['show']);
        Route::resource('bukubesar', BukuBesarController::class)->except(['show']);
        Route::resource('cashflow', CashFlowController::class)->except(['show']);
        Route::resource('labarugi', LabaRugiController::class)->except(['show']);
        Route::resource('neraca', NeracaController::class)->except(['show']);
        Route::resource('perubahanmodal', PerubahanModalController::class)->except(['show']);
        Route::resource('uktdetail', UktDetailController::class)->except(['show']);
        Route::resource('examcard', ExamCardController::class)->except(['show']);

        Route::get('jurnal/export', [JurnalController::class, 'export']);
        Route::get('bukubesar/export', [BukuBesarController::class, 'export'])->name('bukubesar.export');
        Route::get('bukubesarrekap/export', [BukuBesarRekapController::class, 'export'])->name('bukubesarrekap.export');
        Route::get('cashflow/export', [CashFlowController::class, 'export'])->name('cashflow.export');
        Route::get('labarugi/export', [LabaRugiController::class, 'export'])->name('labarugi.export');
        Route::get('neraca/export', [NeracaController::class, 'export'])->name('neraca.export');
        Route::get('perubahanmodal/export', [PerubahanModalController::class, 'export'])->name('perubahanmodal.export');
        Route::get('uktdetail/export', [UktDetailController::class, 'export'])->name('uktdetail.export');

        Route::resource('ukt', UktController::class)->except(['show']);
    }); 

    Route::middleware('admin:super admin,DPA')->group(function () {
        Route::get('daftar_mahasiswa', [DpaAcademicController::class, 'getMahasiswa'])->name('daftar_mahasiswa'); //this for testing dpaacademic
        Route::get('daftar_mahasiswa/export', [DpaAcademicController::class, 'export'])->name('daftar_mahasiswa.export'); //this for testing dpaacademic
    });

    Route::middleware('admin:super admin,akademik')->group(function () {
        Route::resource('faculty', FacultyController::class)->except(['show']);
        Route::resource('study_program', StudyProgramController::class)->except(['show']);
        Route::resource('dpa', DpaController::class)->except(['show']); //this

    });

    Route::middleware('admin:super admin,akademik,admin keuangan')->group(function () {
        Route::resource('student', StudentController::class)->except(['show']);
    });


    Route::middleware('admin:super admin')->group(function () {
        Route::resource('student_type', StudentTypeController::class)->except(['show']);

        Route::get('examcard/show', [ExamCardController::class, 'show']);
        Route::resource('pengguna', PenggunaController::class)->except((['show','update','edit']));
        Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
        Route::post('register', [RegisteredUserController::class, 'store']);

        Route::resource('bimbinganstudi', KrsController::class)->except(['show']);
        Route::get('bimbinganstudi/export', [KrsController::class, 'export'])->name('krs.export');;

    });
});


require __DIR__.'/auth.php';
