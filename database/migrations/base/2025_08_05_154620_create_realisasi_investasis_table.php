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
        Schema::create('realisasi_investasis', function (Blueprint $table) {
            $table->increments('id');
            $table->double('target')->nullable();
            $table->string('tahun')->nullable();
            $table->integer('pma_jml_proyek')->nullable();
            $table->integer('pmdn_jml_proyek')->nullable();
            $table->bigInteger('pma_nilai_investasi')->nullable();
            $table->bigInteger('pmdn_nilai_investasi')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('realisasi_investasis');
    }
};
