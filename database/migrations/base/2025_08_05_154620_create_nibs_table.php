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
        Schema::create('nibs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamp('day_of_tanggal_terbit_oss')->nullable()->index();
            $table->string('nama_perusahaan', 191)->nullable()->index();
            $table->string('status_penanaman_modal', 191)->nullable();
            $table->string('flag_umk', 191)->nullable();
            $table->string('uraian_jenis_perusahaan', 191)->nullable()->index();
            $table->string('alamat_perusahaan', 191)->nullable();
            $table->string('kab_kota', 191)->nullable();
            $table->string('email', 191)->nullable();
            $table->unsignedBigInteger('kab_kota_id')->nullable();
            $table->timestamps();
            $table->string('nib', 191)->index();
            $table->boolean('is_jateng')->default(true);
            $table->string('tanggal_awal', 191)->nullable();
            $table->string('tanggal_akhir', 191)->nullable();
            $table->string('nomor_telp', 191)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nibs');
    }
};
