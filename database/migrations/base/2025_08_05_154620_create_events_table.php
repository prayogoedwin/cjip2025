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
        Schema::create('events', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama', 191);
            $table->timestamp('start_date')->useCurrentOnUpdate()->useCurrent();
            $table->timestamp('end_date')->useCurrentOnUpdate()->useCurrent();
            $table->string('kurs_dollar', 191);
            $table->string('logo', 191)->nullable();
            $table->string('banner', 191)->nullable();
            $table->string('jumlah_peserta', 191)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
