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
        Schema::create('proyek_investasis', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama')->nullable();
            $table->unsignedBigInteger('sektor_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('profile_kabkota_id')->nullable();
            $table->unsignedBigInteger('kab_kota_id')->nullable();
            $table->unsignedBigInteger('market_id')->nullable();
            $table->longText('latar_belakang')->nullable();
            $table->longText('lokasi')->nullable();
            $table->geometry('location')->nullable();
            $table->longText('lingkup_pekerjaan')->nullable();
            $table->longText('eksisting')->nullable();
            $table->string('luas_lahan')->nullable();
            $table->longText('status_kepemilikan')->nullable();
            $table->longText('nilai_investasi')->nullable();
            $table->longText('skema_investasi')->nullable();
            $table->longText('npv')->nullable();
            $table->string('irr')->nullable();
            $table->string('bc_ratio')->nullable();
            $table->longText('playback_period')->nullable();
            $table->string('cp_nama')->nullable();
            $table->string('cp_email')->nullable();
            $table->string('cp_alamat')->nullable();
            $table->string('cp_hp')->nullable();
            $table->longText('file_kajian')->nullable();
            $table->longText('foto')->nullable();
            $table->longText('file_keuangan')->nullable();
            $table->boolean('status')->nullable();
            $table->longText('ketersediaan_pasar')->nullable();
            $table->longText('ketersediaan_sd')->nullable();
            $table->longText('desain_layout_proyek')->nullable();
            $table->longText('rincian_investasi')->nullable();
            $table->longText('desc_luas_lahan')->nullable();
            $table->timestamps();
            $table->text('lat')->nullable();
            $table->text('lng')->nullable();
            $table->text('sumber_air')->nullable();
            $table->text('kelistrikan')->nullable();
            $table->text('telekomunikasi')->nullable();
            $table->boolean('is_cjibf')->nullable();
            $table->text('url_video')->nullable();
            $table->text('jaringan_jalan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proyek_investasis');
    }
};
