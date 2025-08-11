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
        Schema::create('vm_provs', function (Blueprint $table) {
            $table->increments('id');
            $table->longText('visi_misi')->nullable();
            $table->longText('program_unggulan')->nullable();
            $table->string('foto_gub')->nullable();
            $table->string('nama_gub')->nullable();
            $table->string('foto_wagub')->nullable();
            $table->string('nama_wagub')->nullable();
            $table->string('sumber_data')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vm_provs');
    }
};
