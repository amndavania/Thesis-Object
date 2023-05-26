<?php

use App\Http\Controllers\AccountingGroupController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudyProgramController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

    Route::resource('accounting_group', AccountingGroupController::class)->except(['show']);

    Route::middleware(['admin:admin penerimaan', 'admin:super admin'])->group(function () {
        // 
    });

    Route::middleware(['admin:admin pengeluaran', 'admin:super admin'])->group(function () {
        // 
    });

    Route::middleware('admin:super admin')->group(function () {
        Route::resource('faculty', FacultyController::class)->except(['show']);
        Route::resource('study_program', StudyProgramController::class)->except(['show']);
        Route::resource('student', StudentController::class)->except(['show']);
    });
});


require __DIR__.'/auth.php';
