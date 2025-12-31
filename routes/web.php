<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PresensiController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| 1. RUTE PUBLIK
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('login');
});

// Rute Captcha (SVG)
Route::get('/captcha-image', function () {
    $code = substr(str_shuffle("ABCDEFGHJKLMNPQRSTUVWXYZ23456789"), 0, 5);
    session(['captcha_code' => $code]); 
    $svg = '<?xml version="1.0" standalone="no"?>
            <svg width="120" height="40" version="1.1" xmlns="http://www.w3.org/2000/svg">
              <rect width="100%" height="100%" fill="#07213D"/>
              <text x="50%" y="50%" dominant-baseline="middle" text-anchor="middle" fill="#EEBF63" font-family="monospace" font-size="20" font-weight="bold" letter-spacing="4">'.$code.'</text>
              <line x1="0" y1="0" x2="120" y2="40" stroke="#EEBF63" stroke-width="1" opacity="0.3"/>
              <line x1="120" y1="0" x2="0" y2="40" stroke="#EEBF63" stroke-width="1" opacity="0.3"/>
            </svg>';
    return response($svg, 200, ['Content-Type' => 'image/svg+xml']);
});

/*
|--------------------------------------------------------------------------
| 2. DASHBOARD
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

/*
|--------------------------------------------------------------------------
| 3. RUTE KHUSUS MEMBER (Harus Login Dulu)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    
    // --- MANAJEMEN PEGAWAI ---
    Route::get('/pegawai', [PegawaiController::class, 'index'])->name('pegawai.index');
    Route::get('/pegawai/magang', [PegawaiController::class, 'indexMagang'])->name('pegawai.magang');
    Route::get('/pegawai/tambah', [PegawaiController::class, 'create'])->name('pegawai.create');
    Route::post('/pegawai/simpan', [PegawaiController::class, 'store'])->name('pegawai.store');
    Route::delete('/pegawai/{id}', [PegawaiController::class, 'destroy'])->name('pegawai.destroy');
    
    // CETAK
    Route::get('/pegawai/{id}/cetak', [PegawaiController::class, 'cetakKartu'])->name('pegawai.cetak');
    Route::get('/pegawai/{id}/cetak-qr', [PegawaiController::class, 'cetakQr'])->name('pegawai.cetak-qr');

    // --- PRESENSI ---
    Route::get('/presensi/scan', [PresensiController::class, 'index'])->name('presensi.scan');
    Route::post('/presensi/store', [PresensiController::class, 'store'])->name('presensi.store');
    
    // HALAMAN REKAP (HANYA ADMIN)
    Route::get('/presensi/rekap', [PresensiController::class, 'halamanRekap'])
        ->name('presensi.rekap');

    
    // EXPORT PRESENSI - DUA VERSI
    // Versi 1: Dengan parameter format (default ke CSV)
    Route::get('/presensi/export', [PresensiController::class, 'export'])
        ->name('presensi.export');

    
    // Versi 2: Langsung ke HTML/Excel (alternatif)
    Route::get('/presensi/export-html', [PresensiController::class, 'exportExcelHtml'])
        ->name('presensi.export.html');

    
    // Versi 3: Langsung ke CSV (alternatif)
    Route::get('/presensi/export-csv', [PresensiController::class, 'exportExcel'])
        ->name('presensi.export.csv');
  

    // --- PROFILE ---
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/test-timezone', function() {
    echo "PHP time(): " . date('Y-m-d H:i:s') . "<br>";
    echo "date_default_timezone_get(): " . date_default_timezone_get() . "<br>";
    echo "config('app.timezone'): " . config('app.timezone') . "<br>";
    echo "Carbon UTC: " . \Carbon\Carbon::now('UTC')->format('Y-m-d H:i:s') . "<br>";
    echo "Carbon Jakarta: " . \Carbon\Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s') . "<br>";
    
    // Test database time - PERBAIKI INI:
    try {
        $dbTime = \Illuminate\Support\Facades\DB::select('SELECT NOW() as now, @@global.time_zone as global_tz, @@session.time_zone as session_tz')[0];
        echo "MySQL NOW(): " . $dbTime->now . "<br>";
        echo "MySQL Global Timezone: " . $dbTime->global_tz . "<br>";
        echo "MySQL Session Timezone: " . $dbTime->session_tz . "<br>";
    } catch (\Exception $e) {
        echo "Database error: " . $e->getMessage() . "<br>";
    }
    
    return "Time test completed";
});

    // // Route khusus untuk scanner eksternal (POST request)
    Route::post('/scan-external', [PresensiController::class, 'scanExternal'])->name('presensi.scan-external');

    // Route untuk generate QR Code
    Route::get('/qrcode/{nip}', [PresensiController::class, 'generateQRCode'])->name('presensi.qrcode');

});

// Middleware khusus admin (jika belum ada, tambahkan di App\Http\Kernel.php)
// Atau gunakan middleware role checking di controller

/*
|--------------------------------------------------------------------------
| 4. RUTE TAMBAHAN UNTUK FITUR LAINNYA (OPTIONAL)
|--------------------------------------------------------------------------
*/

// Jika Anda memiliki middleware 'admin' yang sudah dibuat
// Route::middleware(['auth', 'admin'])->group(function () {
//     // Semua rute admin bisa ditempatkan di sini
//     Route::get('/admin/rekap', [PresensiController::class, 'halamanRekap'])->name('admin.rekap');
//     Route::get('/admin/export', [PresensiController::class, 'export'])->name('admin.export');
// });

// Memanggil rute otentikasi (login, register, dll)
require __DIR__.'/auth.php';