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
        Schema::create('vm_kab_kotas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('kab_kota_id')->nullable();
            $table->longText('visi_misi')->nullable();
            $table->string('foto_bupati')->nullable();
            $table->string('nama_bupati')->nullable();
            $table->string('foto_wabup')->nullable();
            $table->string('nama_wabup')->nullable();
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
        Schema::dropIfExists('vm_kab_kotas');
    }
};
