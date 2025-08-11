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
        Schema::create('loi_docs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('logo_header')->nullable();
            $table->string('header')->nullable();
            $table->string('subheader')->nullable();
            $table->string('nama_ttd')->nullable();
            $table->string('jabatan_ttd')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->integer('kab_kota_id')->nullable();
            $table->string('tempat_ttd')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loi_docs');
    }
};
