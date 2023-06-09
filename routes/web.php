<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountingGroupController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\PemasukanController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudyProgramController;
use App\Http\Controllers\UktController;
use App\Http\Controllers\TransactionAccountController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\StudentTypeController;
use App\Http\Controllers\Report\JurnalController;
use App\Http\Controllers\Report\BukuBesarController;
use App\Http\Controllers\Report\CashFlowController;
use App\Http\Controllers\Report\NeracaController;
use App\Http\Controllers\Report\PerubahanModalController;
use App\Http\Controllers\Report\LabaRugiController;
use App\Http\Controllers\Report\UktDetailController;

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

Route::redirect('/', 'dashboard');

// Route::get('/', function () {
//     return view('welcome');
// });


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {return view('dashboard');})->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware(['admin:admin penerimaan', 'admin:super admin'])->group(function () {
        Route::resource('pemasukan', PemasukanController::class)->except(['show']);
    });

    Route::middleware(['admin:admin pengeluaran', 'admin:super admin'])->group(function () {
        Route::resource('pengeluaran', PengeluaranController::class)->except(['show']);
    });

    Route::middleware('admin:super admin')->group(function () {
        Route::resource('faculty', FacultyController::class)->except(['show']);
        Route::resource('study_program', StudyProgramController::class)->except(['show']);
        Route::resource('student', StudentController::class)->except(['show']);
        Route::resource('student_type', StudentTypeController::class)->except(['show']);
        Route::resource('accounting_group', AccountingGroupController::class)->except(['show']);
        Route::resource('ukt', UktController::class)->except(['show']);
        Route::resource('pengeluaran', PengeluaranController::class)->except(['show']);
        Route::resource('pemasukan', PemasukanController::class)->except(['show']);
        Route::resource('transaction_account', TransactionAccountController::class)->except(['show']);
        Route::resource('jurnal', JurnalController::class)->except(['show']);
        Route::resource('bukubesar', BukuBesarController::class)->except(['show']);
        Route::resource('cashflow', CashFlowController::class)->except(['show']);
        Route::resource('labarugi', LabaRugiController::class)->except(['show']);
        Route::resource('neraca', NeracaController::class)->except(['show']);
        Route::resource('perubahanmodal', PerubahanModalController::class)->except(['show']);
        Route::resource('uktdetail', UktDetailController::class)->except(['show']);

        Route::get('jurnal/export', [JurnalController::class, 'export']);
        Route::get('bukubesar/export', [BukuBesarController::class, 'export']);
        Route::get('cashflow/export', [CashFlowController::class, 'export']);
        Route::get('labarugi/export', [LabaRugiController::class, 'export']);
        Route::get('neraca/export', [NeracaController::class, 'export']);
        Route::get('perubahanmodal/export', [PerubahanModalController::class, 'export']);

        // Route::post('ukt/detail', [UktController::class, 'detail']);

        // Route::get('bukubesar/search', [BukuBesarController::class, 'search']);


    });
});


require __DIR__.'/auth.php';
