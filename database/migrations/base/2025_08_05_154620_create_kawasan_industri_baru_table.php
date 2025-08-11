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
        Schema::create('kawasan_industri_baru', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('profil')->nullable();
            $table->geometry('lokasi')->nullable();
            $table->longText('masterplan')->nullable();
            $table->longText('produk')->nullable();
            $table->longText('infrastruktur_industri')->nullable();
            $table->longText('infrastruktur_penunjang')->nullable();
            $table->longText('infrastruktur_dasar')->nullable();
            $table->longText('fasilitas_lain')->nullable();
            $table->longText('tenant')->nullable();
            $table->timestamps();
            $table->string('url_video')->nullable();
            $table->string('nama_kawasan_industri')->nullable();
            $table->string('foto');
            $table->bigInteger('user_id');
            $table->bigInteger('jenis_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kawasan_industri_baru');
    }
};
