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
        Schema::create('loi_interests', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('profile_id');
            $table->integer('user_id');
            $table->integer('kab_kota_id');
            $table->string('nilai_usd');
            $table->string('nilai_rp');
            $table->string('lokasi_investasi');
            $table->timestamps();
            $table->string('sektor_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loi_interests');
    }
};
