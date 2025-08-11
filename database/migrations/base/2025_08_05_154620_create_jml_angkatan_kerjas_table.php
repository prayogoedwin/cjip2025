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
        Schema::create('jml_angkatan_kerjas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('kab_kota_id')->nullable();
            $table->string('tahun')->nullable();
            $table->string('pria')->nullable();
            $table->string('wanita')->nullable();
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
        Schema::dropIfExists('jml_angkatan_kerjas');
    }
};
