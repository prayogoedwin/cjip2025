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
        Schema::create('upah_minimums', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('kab_kota_id')->nullable();
            $table->string('tahun')->nullable();
            $table->string('nilai_umr')->nullable();
            $table->text('sumber_data')->nullable();
            $table->string('delete_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('upah_minimums');
    }
};
