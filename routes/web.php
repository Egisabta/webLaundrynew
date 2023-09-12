<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend\paketController;
use App\Http\Controllers\backend\pesananController;
use App\Http\Controllers\backend\pelangganController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('backend.index');
});

Route::prefix('paket')->group(function(){
Route::get('/view', [paketController::class, 'index'])->name('paket.index');
Route::get('/add', [paketController::class, 'add'])->name('paket.add');
Route::post('/store', [paketController::class, 'store'])->name('paket.store');
Route::get('/edit/{id}', [paketController::class, 'edit'])->name('paket.edit');
Route::post('/update/{id}', [paketController::class, 'update'])->name('paket.update');
Route::get('/delete/{id}', [paketController::class, 'delete'])->name('paket.delete');
});

Route::prefix('pesanan')->group(function(){
    Route::get('/view', [pesananController::class, 'index'])->name('pesanan.index');
    Route::get('/add', [pesananController::class, 'add'])->name('pesanan.add');
});

Route::prefix('pelanggan')->group(function(){
    Route::get('/view', [pelangganController::class, 'index'])->name('pelanggan.index');
    Route::get('/add', [pelangganController::class, 'add'])->name('pelanggan.add');
    Route::post('/store', [pelangganController::class, 'store'])->name('pelanggan.store');
    Route::get('/edit/{id}', [pelangganController::class, 'edit'])->name('pelanggan.edit');
    Route::post('/update/{id}', [pelangganController::class, 'update'])->name('pelanggan.update');
    Route::get('/delete/{id}', [pelangganController::class, 'delete'])->name('pelanggan.delete');
});