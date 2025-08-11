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
        Schema::create('jenis_ppp', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama', 191)->nullable();
            $table->bigInteger('kode')->nullable();
            $table->bigInteger('kode_data')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jenis_ppp');
    }
};
