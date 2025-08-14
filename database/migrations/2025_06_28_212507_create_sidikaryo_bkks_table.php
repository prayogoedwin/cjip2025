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
        Schema::create('sidikaryo_bkks', function (Blueprint $table) {
            $table->id();
            $table->string('nama_sekolah');
            $table->string('nama_bkk');
            $table->string('id_kota');
            $table->string('telpon')->nullable();
            $table->string('hp')->nullable();
            $table->string('email')->nullable();
            $table->string('website')->nullable();
            $table->string('contact_person')->nullable();
            $table->string('jabatan')->nullable();
            $table->text('alamat')->nullable();
            $table->string('kota')->nullable();
            $table->unsignedBigInteger('cjip_kota_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sidikaryo_bkks');
    }
};
