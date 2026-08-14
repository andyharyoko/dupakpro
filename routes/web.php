<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::resource('pendidikan', App\Http\Controllers\PendidikanController::class);
    Route::resource('penelitian', App\Http\Controllers\PenelitianController::class);
    Route::resource('pengabdian', App\Http\Controllers\PengabdianController::class);
    Route::resource('penunjang', App\Http\Controllers\PenunjangController::class);
    Route::resource('bukti', App\Http\Controllers\BuktiController::class)->only(['store', 'destroy']);
    Route::get('/rekap', [App\Http\Controllers\RekapController::class, 'index'])->name('rekap.index');
    Route::post('/rekap/export-excel', [App\Http\Controllers\RekapController::class, 'exportExcel'])->name('rekap.exportExcel');
});

require __DIR__.'/auth.php';
