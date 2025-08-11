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
        Schema::create('pariwisatas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('kab_kota_id')->nullable();
            $table->string('nama_wisata')->nullable();
            $table->string('lokasi')->nullable();
            $table->string('luas')->nullable();
            $table->string('sarpras')->nullable();
            $table->longText('keterangan')->nullable();
            $table->string('fotos')->nullable();
            $table->string('sumber_data')->nullable();
            $table->string('status')->nullable();
            $table->geometry('coordinate')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pariwisatas');
    }
};
