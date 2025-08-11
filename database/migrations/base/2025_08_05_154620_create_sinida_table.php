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
        Schema::create('sinida', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->index('sinida_user_id_foreign');
            $table->string('file_1', 191);
            $table->string('file_2', 191);
            $table->string('file_ktp', 191);
            $table->string('file_permohonan_direktur', 191);
            $table->boolean('kirim_kepala_dinas')->nullable()->default(false);
            $table->unsignedBigInteger('status_id')->index('sinida_status_id_foreign');
            $table->date('menerima_diterima')->nullable();
            $table->string('kesatu_insentif', 191)->nullable();
            $table->string('kesatu_sebesar', 191)->nullable();
            $table->longText('kedua')->nullable();
            $table->longText('ketiga')->nullable();
            $table->longText('keempat')->nullable();
            $table->longText('disposisi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sinida');
    }
};
