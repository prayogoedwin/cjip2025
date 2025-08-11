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
        Schema::create('cjibf_tables', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('jenis_meja')->nullable();
            $table->integer('kabkota_id')->nullable();
            $table->string('kode_meja')->nullable();
            $table->integer('sisa')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cjibf_tables');
    }
};
