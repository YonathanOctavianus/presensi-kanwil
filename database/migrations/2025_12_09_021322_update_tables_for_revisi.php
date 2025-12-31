<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Update Tabel Pegawai (Tambah Status: Pegawai / Magang)
        Schema::table('pegawais', function (Blueprint $table) {
            $table->enum('jenis_pegawai', ['pegawai', 'magang'])->default('pegawai')->after('nama');
        });

        // 2. Update Tabel Presensi (Tambah Jenis Kegiatan)
        Schema::table('presensis', function (Blueprint $table) {
            // Jenis: Apel, Masuk (Harian), Pulang (Harian)
            $table->enum('jenis_presensi', ['apel_pagi', 'harian_masuk', 'harian_pulang'])->default('apel_pagi')->after('pegawai_id');
            
            // Kita ubah kolom status agar bisa menampung 'hadir' (untuk apel yang tidak ada telatnya)
            // Karena enum susah diubah di sebagian database, kita biarkan saja, tapi nanti di kodingan
            // Jika Apel -> kita set 'tepat_waktu' saja (dianggap Hadir).
        });
    }

    public function down(): void
    {
        Schema::table('pegawais', function (Blueprint $table) {
            $table->dropColumn('jenis_pegawai');
        });
        Schema::table('presensis', function (Blueprint $table) {
            $table->dropColumn('jenis_presensi');
        });
    }
};