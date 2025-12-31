<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PresensiController;
use Illuminate\Support\Facades\Route;
use App\Models\Presensi;
use App\Models\Pegawai;
use Carbon\Carbon;

Route::get('/', function () {
    return redirect()->route('login');
});

// Dashboard (Mode Simulasi: Rabu 10 Des 2025)
Route::get('/dashboard', function () {
    // --- MODE SIMULASI AKTIF ---
    // Mengunci dashboard agar menampilkan data tanggal Rabu, 10 Des 2025
    // Ubah kembali menjadi Carbon::today() jika simulasi selesai.
    $today = Carbon::create(2025, 12, 10); 
    
    // 1. Statistik Global
    $totalPegawai = Pegawai::count();
    
    // Hitung total hadir hari ini (unik berdasarkan pegawai_id)
    $hadir = Presensi::whereDate('tanggal', $today)->distinct('pegawai_id')->count('pegawai_id');
    
    $terlambat = Presensi::whereDate('tanggal', $today)->where('status', 'terlambat')->count();
    $tepatWaktu = Presensi::whereDate('tanggal', $today)->where('status', 'tepat_waktu')->count();
    $belumHadir = $totalPegawai - $hadir;

    // 2. Data Tabel Riwayat (Apel & Magang)
    // Menggunakan tanggal simulasi ($today)
    $riwayatApel = Presensi::with('pegawai')
                    ->whereDate('tanggal', $today)
                    ->where('jenis_presensi', 'apel_pagi')
                    ->latest()
                    ->get();

    $riwayatMagang = Presensi::with('pegawai')
                    ->whereDate('tanggal', $today)
                    ->whereIn('jenis_presensi', ['harian_masuk', 'harian_pulang'])
                    ->latest()
                    ->get();

    // 3. Data Khusus Filter "Belum Hadir"
    $belumHadirList = [];
    if (request('filter') == 'belum_hadir') {
        // Cari pegawai yang ID-nya TIDAK ADA di tabel presensi pada tanggal simulasi
        $belumHadirList = Pegawai::whereDoesntHave('presensis', function($q) use ($today) {
            $q->whereDate('tanggal', $today);
        })->get();
    }

    return view('dashboard', compact(
        'totalPegawai', 'hadir', 'terlambat', 'tepatWaktu', 'belumHadir', 
        'riwayatApel', 'riwayatMagang', 'belumHadirList'
    ));
})->middleware(['auth', 'verified'])->name('dashboard');

// GRUP RUTE YANG BUTUH LOGIN
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
    Route::get('/presensi/rekap', [PresensiController::class, 'halamanRekap'])->name('presensi.rekap');
    Route::get('/presensi/export', [PresensiController::class, 'exportExcel'])->name('presensi.export');

    // --- PROFILE USER ---
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rute Autentikasi bawaan Breeze
require __DIR__.'/auth.php';