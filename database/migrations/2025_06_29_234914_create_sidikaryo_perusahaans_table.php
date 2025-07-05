<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sidikaryo_perusahaans', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('id_emakaryo')->nullable();
            $table->string('name')->nullable();
            $table->text('deskripsi')->nullable();
            $table->string('jenis_perusahaan')->nullable();
            $table->string('nib')->nullable();
            $table->string('email')->nullable();
            $table->string('telpon')->nullable();
            $table->string('hp')->nullable();
            $table->string('website')->nullable();
            $table->string('provinsi')->nullable();
            $table->string('kabkota')->nullable();
            $table->integer('kabkota_kode')->nullable();
            $table->integer('cjip_kota_id')->nullable();
            $table->string('kecamatan')->nullable();
            $table->text('alamat')->nullable();
            $table->string('kodepos')->nullable();
            $table->integer('jumlah_lowongan')->default(0)->nullable();
            $table->integer('jumlah_lamaran_menunggu')->default(0)->nullable();
            $table->integer('jumlah_lamaran_proses')->default(0)->nullable();
            $table->integer('jumlah_lamaran_diterima')->default(0)->nullable();
            $table->datetime('tanggal_daftar')->nullable()->default(null);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sidikaryo_perusahaans');
    }
};