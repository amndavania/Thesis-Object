<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BalanceController;
use App\Http\Controllers\FacultyController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/balance', [BalanceController::class, 'index'])->name('balance.index');

    // Route::get('/faculty', [FacultyController::class, 'index'])->name('faculty.index');
    // Route::get('/faculty/create', [FacultyController::class, 'create'])->name('faculty.create');
    // Route::post('/faculty', [FacultyController::class, 'store'])->name('faculty.store');

    Route::resource('faculty', FacultyController::class)->except(['show']);

});

// Route::controller(FacultyController::class)->group(function () {
//     Route::get('/faculty', 'index')->name('faculty.index');
//     Route::get('/faculty/create', 'create')->name('faculty.create');
//     Route::post('/faculty','store')->name('faculty.store');
// })->middleware(['auth', 'verified']);

// Route::resource('faculty', FacultyController::class)->except(['show']);

require __DIR__.'/auth.php';
