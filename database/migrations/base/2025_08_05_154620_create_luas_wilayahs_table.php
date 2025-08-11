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
        Schema::create('luas_wilayahs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('kab_kota_id')->nullable();
            $table->string('nama_kecamatan')->nullable();
            $table->string('luas_wilayah')->nullable();
            $table->string('jml_kelurahan')->nullable();
            $table->string('sumber_data')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('luas_wilayahs');
    }
};
