<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pegawai;
use App\Models\Presensi;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PresensiController extends Controller
{
    public function index() 
    { 
        return view('presensi.scan'); 
    }

    // --- TAMBAHKAN METHOD INI ---
    private function getJenisPresensiLabel($jenisPresensi)
    {
        $labels = [
            'apel_pagi' => 'Apel Pagi',
            'harian_masuk' => 'Masuk Harian',
            'harian_pulang' => 'Pulang Harian'
        ];
        
        return $labels[$jenisPresensi] ?? $jenisPresensi;
    }

    // --- HALAMAN REKAP (METHOD YANG DIPERLUKAN) ---
    public function halamanRekap()
    {
        // Validasi admin
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        // Ambil tanggal hari ini
        $hariIni = Carbon::now('Asia/Jakarta')->toDateString();
        
        // Ambil semua pegawai
        $pegawai = Pegawai::orderBy('nama')->get();
        
        // Inisialisasi array untuk menyimpan rekap
        $rekapHarian = [];
        
        foreach ($pegawai as $p) {
            // Cari presensi untuk hari ini
            $presensi = Presensi::where('pegawai_id', $p->id)
                ->whereDate('tanggal', $hariIni)
                ->get();
            
            // Inisialisasi waktu
            $apel = '-';
            $masuk = '-';
            $pulang = '-';
            $status = 'Tanpa Keterangan';
            
            // Proses data presensi jika ada
            if ($presensi->isNotEmpty()) {
                $status = 'Tepat Waktu';
                
                foreach ($presensi as $log) {
                    // PERBAIKAN INI: Tambahkan setTimezone()
                    $jam = Carbon::parse($log->jam_masuk)->setTimezone('Asia/Jakarta')->format('H:i');
                    
                    if ($log->jenis_presensi == 'apel_pagi') {
                        $apel = $jam;
                    }
                    if ($log->jenis_presensi == 'harian_masuk') {
                        $masuk = $jam;
                        if ($log->status == 'terlambat') {
                            $status = 'Terlambat';
                        }
                    }
                    if ($log->jenis_presensi == 'harian_pulang') {
                        $pulang = $jam;
                    }
                }
            }
            
            // Tambahkan ke array rekap
            $rekapHarian[] = [
                'pegawai' => $p,
                'apel' => $apel,
                'masuk' => $masuk,
                'pulang' => $pulang,
                'status' => $status
            ];
        }
        
        // Kirim data ke view
        return view('presensi.rekap', compact('rekapHarian'));
    }

    // --- METHOD UNTUK STORE PRESENSI YANG DIPERBAIKI ---
    public function store(Request $request)
    {
        // SET TIMEZONE SECARA PAKSA DI AWAL METHOD
        date_default_timezone_set('Asia/Jakarta');
        
        try {
            // Validasi input
            $validated = $request->validate([
                'nip' => 'required|string',
                'jenis_presensi' => 'required|in:apel_pagi,harian_masuk,harian_pulang',
            ]);
            
            // AMBIL WAKTU SEKARANG - PAKAI CARA YANG PASTI BENAR
            $timestamp = time(); // Unix timestamp
            $jamSekarang = Carbon::createFromTimestamp($timestamp, 'Asia/Jakarta');
            
            // LOG UNTUK DEBUG
            Log::info('========== DEBUG TIME PRESENSI ==========');
            Log::info('Unix Timestamp: ' . $timestamp);
            Log::info('Date (Y-m-d H:i:s): ' . date('Y-m-d H:i:s', $timestamp));
            Log::info('Carbon Jakarta: ' . $jamSekarang->format('Y-m-d H:i:s'));
            Log::info('Config Timezone: ' . config('app.timezone'));
            Log::info('PHP Default Timezone: ' . date_default_timezone_get());
            
            // Cari pegawai berdasarkan NIP
            $pegawai = Pegawai::where('nip', $validated['nip'])->first();
            
            if (!$pegawai) {
                Log::warning('Pegawai tidak ditemukan dengan NIP: ' . $validated['nip']);
                
                return response()->json([
                    'success' => false,
                    'message' => 'Data pegawai tidak ditemukan. Periksa NIP Anda.'
                ], 404);
            }
            
            // Format waktu untuk display dan database
            $waktuDisplay = $jamSekarang->format('H:i');        // 07:56
            $waktuFull = $jamSekarang->format('H:i:s');         // 07:56:00
            $tanggalDisplay = $jamSekarang->format('d-m-Y');    // 15-12-2024
            $tanggalDatabase = $jamSekarang->format('Y-m-d');   // 2024-12-15
            
            Log::info('========== INFO PRESENSI ==========');
            Log::info('NIP: ' . $pegawai->nip);
            Log::info('Nama: ' . $pegawai->nama);
            Log::info('Jenis Pegawai: ' . $pegawai->jenis_pegawai);
            Log::info('Jenis Presensi: ' . $validated['jenis_presensi']);
            Log::info('Waktu Display: ' . $waktuDisplay);
            Log::info('Waktu Full: ' . $waktuFull);
            Log::info('Tanggal Display: ' . $tanggalDisplay);
            Log::info('Tanggal Database: ' . $tanggalDatabase);
            
            // VALIDASI KHUSUS: Presensi Pulang untuk Magang (15:45 WIB)
            if ($validated['jenis_presensi'] == 'harian_pulang' && $pegawai->jenis_pegawai == 'magang') {
                // Buat waktu 15:45 WIB
                $waktuMulaiPulang = Carbon::createFromTime(15, 45, 0, 'Asia/Jakarta');
                
                Log::info('--- Validasi Pulang Magang ---');
                Log::info('Waktu Sekarang: ' . $jamSekarang->format('H:i:s'));
                Log::info('Waktu Minimal Pulang: ' . $waktuMulaiPulang->format('H:i:s'));
                Log::info('Boleh Pulang? ' . ($jamSekarang->greaterThanOrEqualTo($waktuMulaiPulang) ? 'YA' : 'TIDAK'));
                
                if ($jamSekarang->lessThan($waktuMulaiPulang)) {
                    $selisihMenit = $jamSekarang->diffInMinutes($waktuMulaiPulang);
                    
                    return response()->json([
                        'success' => false,
                        'message' => 'Presensi pulang untuk peserta magang dimulai pukul 15:45 WIB. Silakan kembali ' . $selisihMenit . ' menit lagi.'
                    ], 400);
                }
            }
            
            // Cek apakah sudah presensi hari ini dengan jenis yang sama
            $presensiHariIni = Presensi::where('pegawai_id', $pegawai->id)
                ->whereDate('tanggal', $tanggalDatabase)
                ->where('jenis_presensi', $validated['jenis_presensi'])
                ->first();
            
            if ($presensiHariIni) {
                $jenisLabel = $this->getJenisPresensiLabel($validated['jenis_presensi']);
                
                return response()->json([
                    'success' => false,
                    'message' => 'Anda sudah melakukan presensi ' . $jenisLabel . ' hari ini'
                ], 400);
            }
            
            // Tentukan status berdasarkan jenis presensi dan waktu
            $status = 'tepat_waktu';
            $menitTerlambat = 0;
            
            if ($validated['jenis_presensi'] == 'harian_masuk') {
                // Batas waktu masuk adalah 07:30 WIB
                $batasWaktu = Carbon::createFromTime(7, 30, 0, 'Asia/Jakarta');
                if ($jamSekarang->greaterThan($batasWaktu)) {
                    $status = 'terlambat';
                    $menitTerlambat = $jamSekarang->diffInMinutes($batasWaktu);
                    Log::info('Terlambat masuk: ' . $menitTerlambat . ' menit');
                }
            } elseif ($validated['jenis_presensi'] == 'apel_pagi') {
                // Batas waktu apel adalah 07:15 WIB
                $batasWaktu = Carbon::createFromTime(7, 15, 0, 'Asia/Jakarta');
                if ($jamSekarang->greaterThan($batasWaktu)) {
                    $status = 'terlambat';
                    $menitTerlambat = $jamSekarang->diffInMinutes($batasWaktu);
                    Log::info('Terlambat apel: ' . $menitTerlambat . ' menit');
                }
            }
            
            // Simpan presensi - PAKAI WAKTU DENGAN TIMEZONE JAKARTA
            $presensi = Presensi::create([
                'pegawai_id' => $pegawai->id,
                'tanggal' => $tanggalDatabase,
                'jam_masuk' => $jamSekarang, // Carbon instance dengan timezone
                'jenis_presensi' => $validated['jenis_presensi'],
                'status' => $status,
            ]);
            
            Log::info('========== PRESENSI BERHASIL ==========');
            Log::info('ID Presensi: ' . $presensi->id);
            Log::info('Status: ' . $status);
            Log::info('Waktu Tersimpan: ' . $jamSekarang->format('Y-m-d H:i:s'));
            Log::info('=======================================');
            
            // Response sukses
            return response()->json([
                'success' => true,
                'message' => 'Presensi berhasil direkam',
                'debug_info' => [ // Untuk debugging saja
                    'unix_timestamp' => $timestamp,
                    'server_time_jakarta' => $jamSekarang->format('Y-m-d H:i:s'),
                    'timezone_used' => 'Asia/Jakarta'
                ],
                'data' => [
                    'nama' => $pegawai->nama,
                    'nip' => $pegawai->nip,
                    'jenis_pegawai' => $pegawai->jenis_pegawai,
                    'jabatan' => $pegawai->jabatan,
                    'jenis_presensi' => $this->getJenisPresensiLabel($validated['jenis_presensi']),
                    'waktu' => $waktuFull,
                    'waktu_display' => $waktuDisplay,
                    'tanggal' => $tanggalDisplay,
                    'status' => $status == 'tepat_waktu' ? 'Tepat Waktu' : 'Terlambat (' . $menitTerlambat . ' menit)',
                    'menit_terlambat' => $menitTerlambat
                ]
            ]);
            
        } catch (\Exception $e) {
            Log::error('Presensi error: ' . $e->getMessage(), [
                'exception' => $e,
                'request' => $request->all()
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan sistem. Silakan coba lagi.'
            ], 500);
        }
    }

    // --- METHOD UNTUK MEMPERBAIKI DATA PRESENSI LAMA ---
    public function perbaikiDataPresensi()
    {
        // Validasi admin
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }
        
        // Ambil semua presensi
        $presensis = Presensi::all();
        $diperbaiki = 0;
        
        foreach ($presensis as $presensi) {
            if ($presensi->jam_masuk) {
                // Asumsi: waktu di database adalah UTC (+7 jam dari WIB)
                // Contoh: 14:22 di database = 07:22 WIB (salah)
                // Seharusnya: 07:22 di database = 07:22 WIB
                
                $jamDiDatabase = Carbon::parse($presensi->jam_masuk);
                
                // LOG sebelum perbaikan
                Log::info('Sebelum: ' . $jamDiDatabase->format('Y-m-d H:i:s'));
                
                // KOREKSI: Jika jam > 12, kemungkinan salah
                if ($jamDiDatabase->hour >= 12) {
                    // Kurangi 7 jam
                    $jamYangBenar = $jamDiDatabase->copy()->subHours(7);
                    
                    // Update ke database
                    $presensi->jam_masuk = $jamYangBenar;
                    $presensi->save();
                    
                    $diperbaiki++;
                    
                    Log::info('Setelah: ' . $jamYangBenar->format('Y-m-d H:i:s'));
                }
            }
        }
        
        return redirect()->back()->with('success', 
            'Berhasil memperbaiki ' . $diperbaiki . ' data presensi.');
    }

    // --- FUNGSI PEMBANTU: ESCAPE VALUE UNTUK CSV ---
    private function escapeCsvValue($value)
    {
        if (is_null($value)) {
            return '';
        }
        
        if (strpos($value, ',') !== false || 
            strpos($value, '"') !== false || 
            strpos($value, "\n") !== false || 
            strpos($value, "\r") !== false) {
            
            $value = str_replace('"', '""', $value);
            return '"' . $value . '"';
        }
        
        return $value;
    }

    // --- FUNGSI TAMBAHAN: GENERATE EXCEL DENGAN TEMPLATE HTML ---
    public function exportExcelHtml(Request $request)
    {
        // Validasi admin
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        $tglMulai = $request->query('tgl_mulai');
        $tglSelesai = $request->query('tgl_selesai');
        
        if (!$tglMulai || !$tglSelesai) {
            return redirect()->back()->with('error', 'Tanggal harus diisi!');
        }

        $hariDipilih = $request->query('hari');
        $jenisPegawai = $request->query('jenis_pegawai');

        // Ambil data
        $qPegawai = Pegawai::orderBy('nama');
        if ($jenisPegawai) {
            $qPegawai->where('jenis_pegawai', $jenisPegawai);
        }
        $pegawais = $qPegawai->get();
        
        $presensis = Presensi::whereBetween('tanggal', [$tglMulai, $tglSelesai])->get();
        
        // Generate HTML table
        $html = '<!DOCTYPE html>
        <html>
        <head>
            <meta charset="UTF-8">
            <title>Rekap Presensi</title>
            <style>
                table { border-collapse: collapse; width: 100%; }
                th { background-color: #2D3748; color: white; padding: 8px; text-align: center; }
                td { border: 1px solid #ddd; padding: 8px; }
                tr:nth-child(even) { background-color: #f2f2f2; }
                .nip { mso-number-format: "\\@"; }
            </style>
        </head>
        <body>
            <h2>Rekap Presensi ' . $tglMulai . ' s/d ' . $tglSelesai . '</h2>
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Hari</th>
                        <th>Tanggal</th>
                        <th>NIP</th>
                        <th>Nama Pegawai</th>
                        <th>Jabatan</th>
                        <th>Status Peg.</th>
                        <th>Jam Apel</th>
                        <th>Jam Masuk</th>
                        <th>Jam Pulang</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>';
        
        $no = 1;
        $period = CarbonPeriod::create($tglMulai, $tglSelesai);
        
        foreach ($period as $date) {
            $currentDate = $date->format('Y-m-d');
            $dayOfWeek = $date->dayOfWeek;
            
            // Filter hari
            if ($hariDipilih && !empty($hariDipilih)) {
                $dayMap = ['Senin'=>1, 'Selasa'=>2, 'Rabu'=>3, 'Kamis'=>4, 'Jumat'=>5, 'Sabtu'=>6, 'Minggu'=>0];
                if (isset($dayMap[$hariDipilih]) && $dayOfWeek != $dayMap[$hariDipilih]) continue;
            }
            
            foreach ($pegawais as $pegawai) {
                $logs = $presensis->where('tanggal', $currentDate)
                                  ->where('pegawai_id', $pegawai->id);
                
                $apel = '-'; $masuk = '-'; $pulang = '-';
                $statusAkhir = ($dayOfWeek == 0 || $dayOfWeek == 6) ? 'Libur' : 'Tanpa Keterangan';
                
                if ($logs->isNotEmpty()) {
                    $statusAkhir = 'Tepat Waktu';
                    foreach ($logs as $log) {
                        $jam = Carbon::parse($log->jam_masuk)->format('H:i');
                        if ($log->jenis_presensi == 'apel_pagi') $apel = $jam;
                        if ($log->jenis_presensi == 'harian_masuk') {
                            $masuk = $jam;
                            if ($log->status == 'terlambat') $statusAkhir = 'Terlambat';
                        }
                        if ($log->jenis_presensi == 'harian_pulang') $pulang = $jam;
                    }
                }
                
                $html .= '<tr>
                    <td>' . $no++ . '</td>
                    <td>' . $date->locale('id')->isoFormat('dddd') . '</td>
                    <td>' . $date->format('d-m-Y') . '</td>
                    <td class="nip">' . htmlspecialchars($pegawai->nip) . '</td>
                    <td>' . htmlspecialchars($pegawai->nama) . '</td>
                    <td>' . htmlspecialchars($pegawai->jabatan) . '</td>
                    <td>' . ($pegawai->jenis_pegawai == 'magang' ? 'Magang' : 'Pegawai') . '</td>
                    <td>' . $apel . '</td>
                    <td>' . $masuk . '</td>
                    <td>' . $pulang . '</td>
                    <td>' . $statusAkhir . '</td>
                </tr>';
            }
        }
        
        $html .= '</tbody></table></body></html>';
        
        $filename = 'Rekap-Presensi-' . $tglMulai . '-sd-' . $tglSelesai . '.xls';
        
        return response($html)
            ->header('Content-Type', 'application/vnd.ms-excel')
            ->header('Content-Disposition', 'attachment; filename="' . $filename . '"')
            ->header('Pragma', 'no-cache')
            ->header('Expires', '0');
    }

    // --- METHOD TAMBAHAN: UNTUK ROUTE ALTERNATIF ---
    public function export(Request $request)
    {
        $format = $request->query('format', 'csv');
        
        if ($format === 'html') {
            return $this->exportExcelHtml($request);
        }
        
        // TAMBAHKAN METHOD exportExcel YANG HILANG
        return $this->exportExcel($request);
    }
    
    // --- TAMBAHKAN METHOD exportExcel YANG HILANG ---
    public function exportExcel(Request $request)
    {
        // Validasi admin
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        $tglMulai = $request->query('tgl_mulai');
        $tglSelesai = $request->query('tgl_selesai');
        
        if (!$tglMulai || !$tglSelesai) {
            return redirect()->back()->with('error', 'Tanggal harus diisi!');
        }

        $hariDipilih = $request->query('hari');
        $jenisPegawai = $request->query('jenis_pegawai');

        // Ambil data
        $qPegawai = Pegawai::orderBy('nama');
        if ($jenisPegawai) {
            $qPegawai->where('jenis_pegawai', $jenisPegawai);
        }
        $pegawais = $qPegawai->get();
        
        $presensis = Presensi::whereBetween('tanggal', [$tglMulai, $tglSelesai])->get();
        
        // Generate CSV
        $filename = 'Rekap-Presensi-' . $tglMulai . '-sd-' . $tglSelesai . '.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0'
        ];
        
        $callback = function() use ($tglMulai, $tglSelesai, $hariDipilih, $pegawais, $presensis) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['No', 'Hari', 'Tanggal', 'NIP', 'Nama Pegawai', 'Jabatan', 'Status Peg.', 'Jam Apel', 'Jam Masuk', 'Jam Pulang', 'Status']);
            
            $no = 1;
            $period = CarbonPeriod::create($tglMulai, $tglSelesai);
            
            foreach ($period as $date) {
                $currentDate = $date->format('Y-m-d');
                $dayOfWeek = $date->dayOfWeek;
                
                // Filter hari
                if ($hariDipilih && !empty($hariDipilih)) {
                    $dayMap = ['Senin'=>1, 'Selasa'=>2, 'Rabu'=>3, 'Kamis'=>4, 'Jumat'=>5, 'Sabtu'=>6, 'Minggu'=>0];
                    if (isset($dayMap[$hariDipilih]) && $dayOfWeek != $dayMap[$hariDipilih]) continue;
                }
                
                foreach ($pegawais as $pegawai) {
                    $logs = $presensis->where('tanggal', $currentDate)
                                      ->where('pegawai_id', $pegawai->id);
                    
                    $apel = '-'; $masuk = '-'; $pulang = '-';
                    $statusAkhir = ($dayOfWeek == 0 || $dayOfWeek == 6) ? 'Libur' : 'Tanpa Keterangan';
                    
                    if ($logs->isNotEmpty()) {
                        $statusAkhir = 'Tepat Waktu';
                        foreach ($logs as $log) {
                            $jam = Carbon::parse($log->jam_masuk)->format('H:i');
                            if ($log->jenis_presensi == 'apel_pagi') $apel = $jam;
                            if ($log->jenis_presensi == 'harian_masuk') {
                                $masuk = $jam;
                                if ($log->status == 'terlambat') $statusAkhir = 'Terlambat';
                            }
                            if ($log->jenis_presensi == 'harian_pulang') $pulang = $jam;
                        }
                    }
                    
                    fputcsv($file, [
                        $no++,
                        $date->locale('id')->isoFormat('dddd'),
                        $date->format('d-m-Y'),
                        $this->escapeCsvValue($pegawai->nip),
                        $this->escapeCsvValue($pegawai->nama),
                        $this->escapeCsvValue($pegawai->jabatan),
                        $pegawai->jenis_pegawai == 'magang' ? 'Magang' : 'Pegawai',
                        $apel,
                        $masuk,
                        $pulang,
                        $statusAkhir
                    ]);
                }
            }
            
            fclose($file);
        };
        
        return response()->stream($callback, 200, $headers);
    }

    public function generateQRCode($nip)
{
    $pegawai = Pegawai::where('nip', $nip)->first();
    
    if (!$pegawai) {
        return response()->json([
            'success' => false,
            'message' => 'Pegawai tidak ditemukan'
        ], 404);
    }
    
    // Data untuk QR Code
    $qrData = [
        'nip' => $pegawai->nip,
        'nama' => $pegawai->nama,
        'timestamp' => now()->timestamp,
        'type' => 'presensi'
    ];
    
    // Encode ke JSON
    $qrContent = json_encode($qrData);
    
    // Anda bisa menggunakan library QR Code seperti simplesoftwareio/simple-qrcode
    // atau membangkitkan QR Code di frontend
    
    return response()->json([
        'success' => true,
        'data' => [
            'qr_content' => $qrContent,
            'pegawai' => $pegawai
        ]
    ]);
}

/**
 * Endpoint khusus untuk scanner eksternal
 */
public function scanExternal(Request $request)
{
    // Validasi input khusus scanner
    $validated = $request->validate([
        'data' => 'required|string',
        'scanner_id' => 'nullable|string', // ID scanner jika ada
    ]);
    
    $data = $validated['data'];
    
    // Coba parse sebagai JSON
    $nip = $data;
    try {
        $qrData = json_decode($data, true);
        if (isset($qrData['nip'])) {
            $nip = $qrData['nip'];
        }
    } catch (\Exception $e) {
        // Jika bukan JSON, gunakan sebagai NIP langsung
        $nip = $data;
    }
    
    // Lanjutkan dengan proses presensi normal
    $request->merge(['nip' => $nip, 'jenis_presensi' => 'apel_pagi']);
    
    return $this->store($request);
}
}