<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/dashboard', function () {
    $userId = \Illuminate\Support\Facades\Auth::id();
    $stats = [
        'pendidikan' => \App\Models\Pendidikan::where('user_id', $userId)->count(),
        'penelitian' => \App\Models\Penelitian::where('user_id', $userId)->count(),
        'pengabdian' => \App\Models\Pengabdian::where('user_id', $userId)->count(),
        'penunjang' => \App\Models\Penunjang::where('user_id', $userId)->count(),
    ];
    return view('dashboard', compact('stats'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::resource('pendidikan', App\Http\Controllers\PendidikanController::class);
    Route::delete('pendidikan/semester/{semester}', [App\Http\Controllers\PendidikanController::class, 'destroySemester'])->name('pendidikan.destroySemester')->where('semester', '.*');
    
    Route::resource('penelitian', App\Http\Controllers\PenelitianController::class);
    Route::delete('penelitian/semester/{semester}', [App\Http\Controllers\PenelitianController::class, 'destroySemester'])->name('penelitian.destroySemester')->where('semester', '.*');
    
    Route::resource('pengabdian', App\Http\Controllers\PengabdianController::class);
    Route::delete('pengabdian/semester/{semester}', [App\Http\Controllers\PengabdianController::class, 'destroySemester'])->name('pengabdian.destroySemester')->where('semester', '.*');
    
    Route::resource('penunjang', App\Http\Controllers\PenunjangController::class);
    Route::delete('penunjang/semester/{semester}', [App\Http\Controllers\PenunjangController::class, 'destroySemester'])->name('penunjang.destroySemester')->where('semester', '.*');
    
    Route::resource('kewajibankhusus', App\Http\Controllers\KewajibanKhususController::class);
    Route::delete('kewajibankhusus/semester/{semester}', [App\Http\Controllers\KewajibanKhususController::class, 'destroySemester'])->name('kewajibankhusus.destroySemester')->where('semester', '.*');

    Route::resource('bukti', App\Http\Controllers\BuktiController::class)->only(['store', 'destroy']);
    Route::get('/import-lkd', [App\Http\Controllers\ImportController::class, 'index'])->name('import.index');
    Route::post('/import-lkd', [App\Http\Controllers\ImportController::class, 'store'])->name('import.store');
    
    Route::get('/rekap', [App\Http\Controllers\RekapController::class, 'index'])->name('rekap.index');
    Route::post('/rekap/export-excel', [App\Http\Controllers\RekapController::class, 'exportExcel'])->name('rekap.exportExcel');
    Route::get('/rekap/cetak-resmi', [App\Http\Controllers\RekapController::class, 'cetakResmi'])->name('rekap.cetakResmi');
    Route::delete('/rekap/semester/{semester}', [App\Http\Controllers\RekapController::class, 'destroySemester'])->name('rekap.destroySemester')->where('semester', '.*');

    // Sysadmin routes
    Route::middleware([\App\Http\Middleware\IsSysadmin::class])->group(function () {
        Route::get('/sysadmin/users', [App\Http\Controllers\SysadminController::class, 'index'])->name('sysadmin.users');
        Route::delete('/sysadmin/users/{id}', [App\Http\Controllers\SysadminController::class, 'destroy'])->name('sysadmin.users.destroy');
    });
});

require __DIR__.'/auth.php';
