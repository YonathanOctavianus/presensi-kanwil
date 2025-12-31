<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pegawai;

class Presensi extends Model
{
    use HasFactory;

    protected $fillable = [
        'pegawai_id',
        'jenis_presensi', // <--- BARU: Kolom pembeda (Apel/Harian Masuk/Harian Pulang)
        'tanggal',
        'jam_masuk',
        'status',
    ];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }
}