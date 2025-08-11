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
        Schema::create('rilis', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('id_laporan', 191);
            $table->string('periode_tahap', 191)->nullable();
            $table->string('sektor_utama', 191)->nullable();
            $table->string('23_sektor', 191)->nullable();
            $table->timestamp('tanggal_laporan')->nullable();
            $table->timestamp('tanggal_approve_laporan')->nullable();
            $table->string('jenis_badan_usaha', 191)->nullable();
            $table->string('nama_perusahaan', 191)->nullable();
            $table->string('email', 191)->nullable();
            $table->string('alamat', 191)->nullable();
            $table->string('cetak_lokasi', 191)->nullable();
            $table->string('sektor', 191)->nullable();
            $table->string('deskripsi_kbli', 191)->nullable();
            $table->string('wilayah', 191)->nullable();
            $table->string('provinsi', 191)->nullable();
            $table->string('kabkot', 191)->nullable();
            $table->string('negara', 191)->nullable();
            $table->string('no_izin', 191)->nullable();
            $table->string('tambahan_investasi_dalam_rp_juta', 191)->nullable();
            $table->string('tambahan_investasi_dalam_us_ribu', 191)->nullable();
            $table->string('proyek', 191)->nullable();
            $table->string('tki', 191)->nullable();
            $table->string('tka', 191)->nullable();
            $table->string('status', 191)->nullable();
            $table->string('triwulan', 191)->nullable();
            $table->string('tahun', 191)->nullable();
            $table->unsignedBigInteger('proyek_id')->nullable();
            $table->unsignedBigInteger('kab_kota_id')->nullable();
            $table->timestamps();
            $table->string('status_pm', 191);
            $table->string('tanggal_awal', 191);
            $table->string('tanggal_akhir', 191);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rilis');
    }
};
