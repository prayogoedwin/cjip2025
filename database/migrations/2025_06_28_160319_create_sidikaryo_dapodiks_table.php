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
        Schema::create('sidikaryo_dapodiks', function (Blueprint $table) {
            $table->id();
            $table->integer('tahun_data');
            $table->string('kode_kabkota');
            $table->string('kab_kota');
            $table->string('nama_sma_smk');
            $table->integer('jumlah_laki_laki');
            $table->integer('jumlah_perempuan');
            $table->integer('siswa_laki12');
            $table->integer('siswa_perempuan12');
            $table->integer('siswa_laki13');
            $table->integer('siswa_perempuan13');
            $table->string('jurusan');
            $table->integer('total_jumlah_potensi');
            $table->unsignedBigInteger('cjip_kota_id')->nullable();
            $table->unsignedBigInteger('kabkota_id')->nullable();
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sidikaryo_dapodiks');
    }
};
