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
        Schema::create('kajian_peluangs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_doc')->nullable();
            $table->string('penyusun')->nullable();
            $table->string('sektor_id')->nullable();
            $table->string('tahun')->nullable();
            $table->string('file')->nullable();
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
        Schema::dropIfExists('kajian_peluangs');
    }
};
