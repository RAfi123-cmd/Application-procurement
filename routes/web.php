<?php

use App\Http\Controllers\PengajuanPembelianBarangController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SupplierController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::resource('supplier', SupplierController::class)->except(['show']);
    Route::put('pengajuan-pembelian-barang/batal/{pengajuan_pembelian_barang}', [PengajuanPembelianBarangController::class, 'batal'])->name('pengajuan-pembelian-barang.batal');
    Route::resource('pengajuan-pembelian-barang', PengajuanPembelianBarangController::class)->except(['destroy']);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
