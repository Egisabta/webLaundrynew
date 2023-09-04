<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend\paketController;

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
});
