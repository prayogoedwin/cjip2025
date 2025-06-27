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
        Schema::create('sidikaryo_pencakers', function (Blueprint $table) {
            $table->id();
            $table->string('id_kota', 10);
            $table->string('kota', 100);
            $table->integer('cjip_kota_id');
            $table->integer('l')->comment('Jumlah laki-laki');
            $table->integer('p')->comment('Jumlah perempuan');
            $table->integer('lulusan_sma_smk')->comment('Lulusan SMA/SMK');
            $table->integer('lulusan_dibawah_sma_smk')->comment('Lulusan di bawah SMA/SMK');
            $table->integer('lulusan_sarjana_keatas')->comment('Lulusan sarjana ke atas');
            $table->timestamps();
            $table->softDeletes();
            
            // Tambahkan index jika diperlukan
            $table->index('id_kota');
            $table->index('cjip_kota_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sidikaryo_pencakers');
    }
};
