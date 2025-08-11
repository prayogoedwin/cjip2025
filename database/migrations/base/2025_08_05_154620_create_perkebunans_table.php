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
        Schema::create('perkebunans', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('kab_kota_id')->nullable();
            $table->integer('komoditas_id')->nullable();
            $table->string('luas_tanah')->nullable();
            $table->string('jml_produksi')->nullable();
            $table->string('produktifitas')->nullable();
            $table->string('sumber_data')->nullable();
            $table->string('tahun')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perkebunans');
    }
};
