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
        Schema::create('lois', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('kab_kota_id')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('proyek_investasi_id')->nullable();
            $table->string('nama_perusahaan');
            $table->string('alamat_perusahaan');
            $table->string('bidang_usaha');
            $table->string('nama_pengusaha');
            $table->string('jabatan_pengusaha')->nullable();
            $table->string('phone')->nullable();
            $table->string('email');
            $table->string('lokasi')->nullable();
            $table->timestamp('tgl_ttd')->nullable();
            $table->boolean('is_cjibf')->default(false);
            $table->string('status_proses');
            $table->string('asal_negara')->nullable();
            $table->string('nilai_usd')->nullable();
            $table->string('nilai_rp')->nullable();
            $table->timestamps();
            $table->string('parent_company', 191)->nullable();
            $table->string('investment_status', 191);
            $table->string('rencana_tki', 191);
            $table->string('rencana_tka', 191);
            $table->string('eksisting_tki', 191);
            $table->string('eksisting_tka', 191);
            $table->unsignedBigInteger('proyek_id')->nullable();
            $table->string('timeline_proyek', 191)->nullable();
            $table->string('signed_loi', 191)->nullable();
            $table->string('doc_loi', 191)->nullable();
            $table->unsignedBigInteger('event_id')->nullable();
            $table->unsignedBigInteger('user_lo')->nullable();
            $table->string('rencana_bidang_usaha', 191);
            $table->boolean('is_proyek_jateng')->default(false);
            $table->boolean('mata_uang')->default(false);
            $table->unsignedBigInteger('kawasan_industri_id')->nullable();
            $table->boolean('is_kawasan');
            $table->string('deskripsi_proyek', 191)->nullable();
            $table->string('sektor', 191);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lois');
    }
};
