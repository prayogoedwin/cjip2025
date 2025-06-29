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
        Schema::create('sidikaryo_integrasi', function (Blueprint $table) {
            $table->id();
            $table->string('nama_app')->nullable();
            $table->string('username')->nullable();
            $table->string('password')->nullable();
            $table->string('apikey')->nullable();
            $table->string('token')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
         Schema::dropIfExists('sidikaryo_integrasi');
    }
};
