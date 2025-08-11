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
        Schema::create('perusahaan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->index('perusahaan_user_id_foreign');
            $table->string('nama_perusahaan', 191)->nullable();
            $table->string('telepon_perusahaan', 191)->nullable();
            $table->longText('alamat_perusahaan')->nullable();
            $table->string('jenis_usaha', 191)->nullable();
            $table->string('nib', 191)->nullable();
            $table->string('negara_asal', 191)->nullable();
            $table->string('induk_perusahaan', 191)->nullable();
            $table->string('nama_pimpinan', 191)->nullable();
            $table->string('telepon_pimpinan', 191)->nullable();
            $table->longText('alamat_pimpinan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perusahaan');
    }
};
