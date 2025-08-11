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
        Schema::create('realisasi_investasi_sektors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_sektor')->nullable();
            $table->integer('jml_proyek')->nullable();
            $table->decimal('nilai_inv', 10, 0)->nullable();
            $table->integer('jml_tki')->nullable();
            $table->integer('jml_tka')->nullable();
            $table->string('triwulan')->nullable();
            $table->year('tahun')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('realisasi_investasi_sektors');
    }
};
