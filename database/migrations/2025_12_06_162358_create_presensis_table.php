<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('presensis', function (Blueprint $table) {
            $table->id();
            // Relasi: Data ini milik Pegawai siapa?
            $table->foreignId('pegawai_id')->constrained('pegawais')->onDelete('cascade');
            
            $table->date('tanggal');      // Tanggal Scan
            $table->time('jam_masuk');    // Jam Scan
            $table->enum('status', ['tepat_waktu', 'terlambat']); // Status otomatis
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('presensis');
    }
};
