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
        Schema::create('profile_investors', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('investor_name');
            $table->string('jabatan');
            $table->string('phone');
            $table->string('nama_perusahaan');
            $table->string('bidang_usaha');
            $table->text('alamat');
            $table->timestamps();
            $table->text('country');
            $table->string('badan_hukum')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profile_investors');
    }
};
