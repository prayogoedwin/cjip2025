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
        Schema::create('profil_kep_provs', function (Blueprint $table) {
            $table->increments('id');
            $table->longText('profil')->nullable();
            $table->string('foto_kadin')->nullable();
            $table->string('nama_kadin')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profil_kep_provs');
    }
};
