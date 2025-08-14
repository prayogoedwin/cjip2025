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
        Schema::create('sidikaryo_penempatans', function (Blueprint $table) {
            $table->id();
            $table->string('id_kota', 10);
            $table->string('kota', 100);
            $table->integer('cjip_kota_id');
            $table->integer('jmllaki')->comment('Jumlah Laki-laki');
            $table->integer('jmlperempuan')->comment('Jumlah Perempuan');
            $table->integer('total')->comment('Total');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sidikaryo_penempatans');
    }
};
