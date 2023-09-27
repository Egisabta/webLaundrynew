<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend\paketController;
use App\Http\Controllers\backend\pesanController;
use App\Http\Controllers\backend\pelangganController;
use App\Http\Controllers\backend\jenisPembayaranController;



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
    Route::get('/view', [pesanController::class, 'index'])->name('pesanan.index');
    Route::get('/add', [pesanController::class, 'add'])->name('pesanan.add');
    Route::post('/store', [pesanController::class, 'store'])->name('pesanan.store');
});

Route::prefix('pelanggan')->group(function(){
    Route::get('/view', [pelangganController::class, 'index'])->name('pelanggan.index');
    Route::get('/add', [pelangganController::class, 'add'])->name('pelanggan.add');
    Route::post('/store', [pelangganController::class, 'store'])->name('pelanggan.store');
    Route::get('/edit/{id}', [pelangganController::class, 'edit'])->name('pelanggan.edit');
    Route::post('/update/{id}', [pelangganController::class, 'update'])->name('pelanggan.update');
    Route::get('/delete/{id}', [pelangganController::class, 'delete'])->name('pelanggan.delete');
});

Route::prefix('jenisPembayaran')->group(function(){
    Route::get('/view', [jenisPembayaranController::class, 'index'])->name('jenisPembayaran.index');
    Route::get('/add', [jenisPembayaranController::class, 'add'])->name('jenisPembayaran.add');
    Route::post('/store', [jenisPembayaranController::class, 'store'])->name('jenisPembayaran.store');
    Route::get('/edit/{id}', [jenisPembayaranController::class, 'edit'])->name('jenisPembayaran.edit');
    Route::post('/update/{id}', [jenisPembayaranController::class, 'update'])->name('jenisPembayaran.update');
    Route::get('/delete/{id}', [jenisPembayaranController::class, 'delete'])->name('jenisPembayaran.delete');

});