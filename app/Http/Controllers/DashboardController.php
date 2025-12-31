<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pegawai;
use App\Models\Presensi;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // --- 1. Tentukan Tanggal (Filter atau Hari Ini) ---
        if ($request->has('tanggal') && !empty($request->tanggal)) {
            $selectedDate = Carbon::parse($request->tanggal)->setTimezone('Asia/Jakarta');
        } else {
            $selectedDate = Carbon::now('Asia/Jakarta');
        }
        
        $today = $selectedDate->toDateString();
        $dayName = $selectedDate->locale('id')->isoFormat('dddd');
        
        // --- 2. Tentukan Apakah Hari Apel ---
        $isApelDay = in_array($selectedDate->dayOfWeek, [1, 3, 5]);
        
        // --- 3. STATISTIK BARU: Pisahkan Magang dan Pegawai ---
        
        // A. Hitung total berdasarkan jenis
        $totalMagang = Pegawai::where('jenis_pegawai', 'magang')->count();
        $totalPegawaiTetap = Pegawai::where('jenis_pegawai', '!=', 'magang')->count();
        $totalSemuaPegawai = Pegawai::count();
        
        // B. STATISTIK MAGANG - Presensi Harian & Apel
        // Magang yang sudah presensi hari ini (apel atau harian)
        $magangHadirHariIni = Presensi::whereDate('tanggal', $today)
            ->whereHas('pegawai', function($q) {
                $q->where('jenis_pegawai', 'magang');
            })
            ->distinct('pegawai_id')
            ->pluck('pegawai_id')
            ->toArray();
        
        $hadirMagang = count($magangHadirHariIni);
        
        // Tepat waktu magang
        $tepatWaktuMagang = Presensi::whereDate('tanggal', $today)
            ->where('status', 'tepat_waktu')
            ->whereIn('jenis_presensi', ['harian_masuk', 'apel_pagi'])
            ->whereHas('pegawai', function($q) {
                $q->where('jenis_pegawai', 'magang');
            })
            ->count();
        
        // Terlambat magang
        $terlambatMagang = Presensi::whereDate('tanggal', $today)
            ->where('status', 'terlambat')
            ->whereIn('jenis_presensi', ['harian_masuk', 'apel_pagi'])
            ->whereHas('pegawai', function($q) {
                $q->where('jenis_pegawai', 'magang');
            })
            ->count();
        
        // Belum hadir magang
        $belumHadirMagang = $totalMagang - $hadirMagang;
        
        // C. STATISTIK PEGAWAI - Hanya Apel Pagi
        // Pegawai yang hadir apel
        $pegawaiHadirApel = Presensi::whereDate('tanggal', $today)
            ->where('jenis_presensi', 'apel_pagi')
            ->whereHas('pegawai', function($q) {
                $q->where('jenis_pegawai', '!=', 'magang');
            })
            ->distinct('pegawai_id')
            ->pluck('pegawai_id')
            ->toArray();
        
        $hadirApelPegawai = count($pegawaiHadirApel);
        $tidakHadirApelPegawai = $totalPegawaiTetap - $hadirApelPegawai;
        
        // D. STATISTIK UMUM (untuk view lama jika masih dipakai)
        $hadir = Presensi::whereDate('tanggal', $today)->distinct('pegawai_id')->count('pegawai_id');
        $tepatWaktu = Presensi::whereDate('tanggal', $today)
            ->where('status', 'tepat_waktu')
            ->where('jenis_presensi', '!=', 'harian_pulang')
            ->count();
        $terlambat = Presensi::whereDate('tanggal', $today)->where('status', 'terlambat')->count();
        $belumHadir = $totalSemuaPegawai - $hadir;

        // --- 4. DATA UNTUK TABEL DETAIL SETIAP FILTER ---
        
        // Inisialisasi semua variabel
        $belumHadirList = [];
        $totalMagangList = [];
        $totalPegawaiList = [];
        $tepatWaktuMagangList = [];
        $terlambatMagangList = [];
        $belumHadirMagangList = [];
        $hadirApelPegawaiList = [];
        $tidakHadirApelPegawaiList = [];
        
        // Tentukan filter aktif
        $activeFilter = $request->filter;
        
        // === FILTER UNTUK MAGANG ===
        
        // 1. TOTAL MAGANG
        if ($activeFilter == 'total_magang') {
            $totalMagangList = Pegawai::where('jenis_pegawai', 'magang')
                ->orderBy('nama')
                ->get();
        }
        
        // 2. TEPAT WAKTU MAGANG
        elseif ($activeFilter == 'tepat_waktu_magang') {
            $tepatWaktuMagangList = Presensi::with('pegawai')
                ->whereDate('tanggal', $today)
                ->where('status', 'tepat_waktu')
                ->whereIn('jenis_presensi', ['harian_masuk', 'apel_pagi'])
                ->whereHas('pegawai', function($q) {
                    $q->where('jenis_pegawai', 'magang');
                })
                ->orderBy('jam_masuk', 'asc')
                ->get();
        }
        
        // 3. TERLAMBAT MAGANG
        elseif ($activeFilter == 'terlambat_magang') {
            $terlambatMagangList = Presensi::with('pegawai')
                ->whereDate('tanggal', $today)
                ->where('status', 'terlambat')
                ->whereIn('jenis_presensi', ['harian_masuk', 'apel_pagi'])
                ->whereHas('pegawai', function($q) {
                    $q->where('jenis_pegawai', 'magang');
                })
                ->orderBy('jam_masuk', 'asc')
                ->get();
        }
        
        // 4. BELUM HADIR MAGANG
        elseif ($activeFilter == 'belum_hadir_magang') {
            $belumHadirMagangList = Pegawai::where('jenis_pegawai', 'magang')
                ->whereDoesntHave('presensis', function($q) use ($today) {
                    $q->whereDate('tanggal', $today);
                })
                ->orderBy('nama')
                ->get();
        }
        
        // === FILTER UNTUK PEGAWAI TETAP ===
        
        // 5. TOTAL PEGAWAI TETAP
        elseif ($activeFilter == 'total_pegawai') {
            $totalPegawaiList = Pegawai::where('jenis_pegawai', '!=', 'magang')
                ->orderBy('nama')
                ->get();
        }
        
        // 6. KEHADIRAN APEL PEGAWAI
        elseif ($activeFilter == 'kehadiran_apel_pegawai') {
            $hadirApelPegawaiList = Presensi::with('pegawai')
                ->whereDate('tanggal', $today)
                ->where('jenis_presensi', 'apel_pagi')
                ->whereHas('pegawai', function($q) {
                    $q->where('jenis_pegawai', '!=', 'magang');
                })
                ->orderBy('jam_masuk', 'asc')
                ->get();
        }
        
        // 7. TIDAK HADIR APEL PEGAWAI
        elseif ($activeFilter == 'tidak_hadir_apel_pegawai') {
            $tidakHadirApelPegawaiList = Pegawai::where('jenis_pegawai', '!=', 'magang')
                ->whereDoesntHave('presensis', function($q) use ($today) {
                    $q->whereDate('tanggal', $today)
                      ->where('jenis_presensi', 'apel_pagi');
                })
                ->orderBy('nama')
                ->get();
        }
        
        // === FILTER LAMA (untuk kompatibilitas) ===
        
        // 8. BELUM HADIR (SEMUA)
        elseif ($activeFilter == 'belum_hadir') {
            $belumHadirList = Pegawai::whereDoesntHave('presensis', function($q) use ($today) {
                $q->whereDate('tanggal', $today);
            })->get();
        }
        
        // 9. TEPAT WAKTU (SEMUA)
        elseif ($activeFilter == 'tepat_waktu') {
            // Logika lama untuk kompatibilitas
            $filteredLogs = Presensi::with('pegawai')
                ->whereDate('tanggal', $today)
                ->where('status', 'tepat_waktu')
                ->whereIn('jenis_presensi', ['apel_pagi', 'harian_masuk'])
                ->orderBy('jam_masuk', 'asc')
                ->get();
        }
        
        // 10. TERLAMBAT (SEMUA)
        elseif ($activeFilter == 'terlambat') {
            // Logika lama untuk kompatibilitas
            $filteredLogs = Presensi::with('pegawai')
                ->whereDate('tanggal', $today)
                ->where('status', 'terlambat')
                ->whereIn('jenis_presensi', ['apel_pagi', 'harian_masuk'])
                ->orderBy('jam_masuk', 'asc')
                ->get();
        }
        
        // 11. TOTAL SEMUA PEGAWAI (lama)
        elseif ($activeFilter == 'total_semua_pegawai') {
            $allPegawais = Pegawai::orderBy('nama')->get();
        }

        // --- 5. Data Riwayat untuk Tabel Utama ---
        
        // Data Apel (semua pegawai + magang)
        $riwayatApel = collect();
        if ($isApelDay) {
            $riwayatApel = Presensi::with('pegawai')
                ->whereDate('tanggal', $today)
                ->where('jenis_presensi', 'apel_pagi')
                ->orderBy('jam_masuk', 'asc')
                ->get();
        }
        
        // Data Magang Harian (hanya magang)
        $rawMagang = Presensi::with('pegawai')
            ->whereDate('tanggal', $today)
            ->whereIn('jenis_presensi', ['harian_masuk', 'harian_pulang'])
            ->whereHas('pegawai', function($q) {
                $q->where('jenis_pegawai', 'magang');
            })
            ->orderBy('jam_masuk', 'asc')
            ->get();
        
        $riwayatMagang = [];
        foreach ($rawMagang as $log) {
            $pegawaiId = $log->pegawai_id;
            
            if (!isset($riwayatMagang[$pegawaiId])) {
                $riwayatMagang[$pegawaiId] = [
                    'pegawai' => $log->pegawai,
                    'masuk' => '-',
                    'pulang' => '-',
                    'status' => 'Belum Masuk'
                ];
            }
            
            $jam = Carbon::parse($log->jam_masuk)->setTimezone('Asia/Jakarta')->format('H:i');
            
            if ($log->jenis_presensi == 'harian_masuk') {
                $riwayatMagang[$pegawaiId]['masuk'] = $jam;
                $riwayatMagang[$pegawaiId]['status'] = $log->status;
            } 
            elseif ($log->jenis_presensi == 'harian_pulang') {
                $riwayatMagang[$pegawaiId]['pulang'] = $jam;
            }
        }
        
        $riwayatMagang = array_values($riwayatMagang);

        // --- 6. Kirim Data ke View ---
        return view('dashboard', [
            // Data dasar
            'selectedDate' => $selectedDate,
            'dayName' => $dayName,
            'isApelDay' => $isApelDay,
            
            // Statistik LAMA (untuk view yang belum diupdate)
            'totalPegawai' => $totalSemuaPegawai,
            'hadir' => $hadir,
            'tepatWaktu' => $tepatWaktu,
            'terlambat' => $terlambat,
            'belumHadir' => $belumHadir,
            
            // Statistik BARU - MAGANG
            'totalMagang' => $totalMagang,
            'tepatWaktuMagang' => $tepatWaktuMagang,
            'terlambatMagang' => $terlambatMagang,
            'belumHadirMagang' => $belumHadirMagang,
            
            // Statistik BARU - PEGAWAI TETAP
            'totalPegawaiTetap' => $totalPegawaiTetap,
            'hadirApelPegawai' => $hadirApelPegawai,
            'tidakHadirApelPegawai' => $tidakHadirApelPegawai,
            
            // Data untuk tabel utama
            'riwayatApel' => $riwayatApel,
            'riwayatMagang' => $riwayatMagang,
            
            // Data untuk FILTER DETAIL
            'activeFilter' => $activeFilter,
            
            // Filter Magang
            'totalMagangList' => $totalMagangList,
            'tepatWaktuMagangList' => $tepatWaktuMagangList,
            'terlambatMagangList' => $terlambatMagangList,
            'belumHadirMagangList' => $belumHadirMagangList,
            
            // Filter Pegawai Tetap
            'totalPegawaiList' => $totalPegawaiList,
            'hadirApelPegawaiList' => $hadirApelPegawaiList,
            'tidakHadirApelPegawaiList' => $tidakHadirApelPegawaiList,
            
            // Filter Lama
            'belumHadirList' => $belumHadirList,
            'allPegawais' => $allPegawais ?? collect(),
        ]);
    }
}