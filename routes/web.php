<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AngsuranController;
use App\Http\Controllers\BungaController;
use App\Http\Controllers\PinjamanController;
use App\Models\Bunga;

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
    return view('welcome');
});
Auth::routes();
Route::middleware('auth')->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/baru', [HomeController::class, 'pengajuan'])->name('pinjaman.baru');
    Route::post('/baru', [HomeController::class, 'daftar'])->name('daftar.pinjaman');
    Route::get('profil/{id}', [HomeController::class, 'profil'])->name('profil');
    Route::post('/angsuran/{id}/upload', [HomeController::class, 'upload'])->name('upload.file');

    Route::middleware('admin')->group(function(){

        Route::get('/angsuran/{id}', [AngsuranController::class, 'index'])->name('detail.angsuran');
        route::post('/angsuran/{angsuran}/update', [AngsuranController::class, 'update'])->name('update.angsuran');
        Route::get('angsuran/{pinjaman}/export', [AngsuranController::class, 'export'])->name('angsuran.export');

        route::get('/bunga',[BungaController::class,'index'])->name('bunga.index');
        route::get('/bunga/{bunga}',[BungaController::class, 'edit'])->name('bunga.edit');
        route::post('/bunga/{bunga}',[BungaController::class, 'update'])->name('bunga.update');

        route::resource('pinjaman', PinjamanController::class);
        Route::get('pinjaman/export', [PinjamanController::class, 'export'])->name('pinjaman.export');
        route::post('pinjaman/{pinjaman}/status', [PinjamanController::class, 'status'])-> name('pinjaman.status');
    });
});


