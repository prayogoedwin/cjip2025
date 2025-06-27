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
        Schema::create('bridging_kabkota', function (Blueprint $table) {
            $table->id();
            $table->string('kabkota_id', 10)->comment('ID Kabupaten/Kota dari sistem lama');
            $table->string('cjip_kabkota_id', 10)->comment('ID Kabupaten/Kota dari sistem CJIP');
            $table->string('nama_kota', 100)->comment('Nama Kabupaten/Kota');
            $table->timestamps();
            $table->softDeletes();
            
            // Tambahkan index untuk optimasi query
            $table->index('kabkota_id');
            $table->index('cjip_kabkota_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bridging_kabkota');
    }
};