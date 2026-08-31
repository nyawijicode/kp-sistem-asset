<?php

use App\Http\Controllers\LaporanController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::get('/laporan/aset', [LaporanController::class, 'aset'])->name('laporan.aset');
    Route::get('/laporan/aset-masuk', [LaporanController::class, 'assetMasuk'])->name('laporan.aset-masuk');
    Route::get('/laporan/aset-keluar', [LaporanController::class, 'assetKeluar'])->name('laporan.aset-keluar');
});
