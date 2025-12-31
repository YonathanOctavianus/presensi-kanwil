<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;

class PegawaiController extends Controller
{
    // 1. DAFTAR PEGAWAI TETAP (Hanya jenis_pegawai = 'pegawai')
    public function index()
    {
        $pegawais = Pegawai::where('jenis_pegawai', 'pegawai')->latest()->get();
        return view('pegawai.index', compact('pegawais'));
    }

    // 1.B. DAFTAR PESERTA MAGANG (BARU: Hanya jenis_pegawai = 'magang')
    public function indexMagang()
    {
        $pegawais = Pegawai::where('jenis_pegawai', 'magang')->latest()->get();
        return view('pegawai.index_magang', compact('pegawais'));
    }

    // 2. Halaman Tambah (Bisa mendeteksi mau nambah magang atau pegawai)
    public function create(Request $request)
    {
        // Ambil parameter type dari URL (misal: ?type=magang)
        $type = $request->query('type', 'pegawai'); 
        return view('pegawai.create', compact('type'));
    }

    // 3. Simpan Data
    public function store(Request $request)
    {
        $request->validate([
            'nip' => 'required|unique:pegawais|numeric',
            'nama' => 'required',
            'jenis_pegawai' => 'required',
            'jabatan' => 'required',
            'divisi' => 'required',
        ]);

        Pegawai::create([
            'nip' => $request->nip,
            'nama' => $request->nama,
            'jenis_pegawai' => $request->jenis_pegawai,
            'jabatan' => $request->jabatan,
            'divisi' => $request->divisi,
        ]);

        // Redirect pintar: Kalau magang balik ke menu magang, kalau pegawai balik ke pegawai
        if ($request->jenis_pegawai == 'magang') {
            return redirect()->route('pegawai.magang')->with('success', 'Peserta Magang berhasil ditambahkan!');
        }

        return redirect()->route('pegawai.index')->with('success', 'Pegawai berhasil ditambahkan!');
    }

    // 4. Hapus
    public function destroy($id)
    {
        $pegawai = Pegawai::findOrFail($id);
        $jenis = $pegawai->jenis_pegawai; // Simpan jenis sebelum dihapus
        
        $pegawai->delete();

        // Redirect kembali ke halaman yang sesuai
        if ($jenis == 'magang') {
            return redirect()->route('pegawai.magang')->with('success', 'Data magang dihapus.');
        }
        return redirect()->route('pegawai.index')->with('success', 'Data pegawai dihapus.');
    }

    // 5. CETAK ID CARD
    public function cetakKartu($id)
    {
        $pegawai = Pegawai::findOrFail($id);
        $qrcode = QrCode::size(120)->generate($pegawai->nip);
        return view('pegawai.cetak', compact('pegawai', 'qrcode'));
    }

    // 6. CETAK QR SAJA
    public function cetakQr($id)
    {
        $pegawai = Pegawai::findOrFail($id);
        $qrcode = QrCode::size(300)->generate($pegawai->nip);
        return view('pegawai.cetak_qr', compact('pegawai', 'qrcode'));
    }
}