<?php

use App\Http\Controllers\AnggaranController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DecisionController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\KibController;
use App\Http\Controllers\KwitansiController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PajakKwitansiController;
use App\Http\Controllers\PenerimaContoller;
use App\Http\Controllers\PptkContoller;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\RekeningController;
use App\Http\Controllers\SkController;
use App\Http\Controllers\SpdController;
use App\Http\Controllers\SpdRinciController;
use App\Http\Controllers\SubController;
use App\Http\Controllers\TempKwitansiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ViewDataController;
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

Route::get('/', function () {
    if(auth()->check()) {
        return redirect('/home');
    }
    return view('pages.auth.login');
})->name('/');

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('user', UserController::class)->middleware('userAccess:admin');
    Route::resource('program', ProgramController::class)->middleware('userAccess:user,admin');
    Route::resource('kegiatan', KegiatanController::class)->middleware('userAccess:user,admin');
    Route::resource('sub', SubController::class)->middleware('userAccess:user,admin');
    Route::resource('rekening', RekeningController::class)->middleware('userAccess:user,admin');
    Route::resource('anggaran', AnggaranController::class);
    Route::resource('kib', KibController::class);
    Route::resource('spd', SpdController::class);
    Route::resource('pptk', PptkContoller::class);
    Route::resource('penerima', PenerimaContoller::class);
    Route::resource('pengelola', DecisionController::class);
    Route::resource('kwitansi', KwitansiController::class);
    Route::resource('tempkwitansi', TempKwitansiController::class);
    Route::resource('spdrinci', SpdRinciController::class);
    Route::resource('laporan', LaporanController::class);
    Route::post('/laporanbendahara', [LaporanController::class, 'laporanBendahara'])->name('laporan.bendahara');
    Route::get('/laporanrealisasi', [LaporanController::class, 'laporanRealisasi'])->name('laporan.realisasi');
    Route::post('/laporan-pajak-pusat', [LaporanController::class, 'laporanPajakPusat'])->name('laporan.pajak');
    Route::post('/laporan-pajak-daerah', [LaporanController::class, 'laporanPajakDaerah'])->name('laporan.pajakdaerah');
    Route::get('/laporan-spd', [LaporanController::class, 'laporanSpd'])->name('laporan.spd');
    Route::get('/modalcaripagu', [KwitansiController::class, 'modalCariPagu']);
    Route::get('/modalcaripenerima', [KwitansiController::class, 'modalCariPenerima']);
    Route::post('/kwitansi/generate-pajak-daerah', [KwitansiController::class, 'generatePajakDaerah'])->name('kwitansi.generatePajakDaerah');
    Route::get('/detail/{id}', [SpdController::class, 'detail'])->name('detail');
    Route::get('/pajak/{id}', [KwitansiController::class, 'pajak'])->name('pajak');
    Route::get('/view-kwitansi', [ViewDataController::class, 'index'])->name('view.kwitansi');
    Route::resource('pajak-kwitansi', PajakKwitansiController::class);
    Route::get('/tax/{id}', [SpdController::class, 'tax'])->name('tax');
    Route::get('/pajak-spd/{id}', [PajakKwitansiController::class, 'pajakSpd'])->name('pajak-spd');
    Route::resource('sk', SkController::class)->middleware('userAccess:user,admin');
    Route::post('/kib/upload', [KibController::class, 'upload'])->name('kib.upload');
    Route::get('/laporan-realisasi/export', [LaporanController::class, 'exportExcel'])->name('laporan.realisasi.export');
});
