<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Presensi; // Penting: Panggil Model Presensi

class Pegawai extends Model
{
    use HasFactory;

    protected $fillable = [
        'nip',
        'nama',
        'jenis_pegawai',
        'jabatan',
        'divisi',
        'foto_path',
    ];

    // --- RELASI BARU (PENTING UNTUK DASHBOARD) ---
    // Fungsi ini memberitahu Laravel bahwa: "Satu Pegawai bisa punya banyak data Presensi"
    public function presensis()
    {
        return $this->hasMany(Presensi::class);
    }
}