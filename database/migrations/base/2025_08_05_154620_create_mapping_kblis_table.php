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
        Schema::create('mapping_kblis', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('kbli_2digit', 191);
            $table->string('nama_kbli_2digit', 191);
            $table->string('nama_23_sektor', 191);
            $table->string('gol_sektor_desc', 191);
            $table->string('min', 191);
            $table->string('max', 191);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mapping_kblis');
    }
};
