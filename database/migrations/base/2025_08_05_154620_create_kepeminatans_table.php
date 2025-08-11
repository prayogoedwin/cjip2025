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
        Schema::create('kepeminatans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->index('kepeminatans_user_id_foreign');
            $table->string('rencana_bidang_usaha', 191)->nullable();
            $table->integer('status_investasi')->default(0);
            $table->longText('prefensi_lokasi')->nullable();
            $table->string('nilai_investasi', 191)->nullable();
            $table->string('nilai_investasi_rupiah', 191)->nullable();
            $table->integer('local_plan')->default(0);
            $table->string('local_worker_plan', 191)->nullable();
            $table->integer('local_exis')->default(0);
            $table->string('local_worker_exis', 191)->nullable();
            $table->integer('foreign_plan')->default(0);
            $table->string('foreign_worker_plan', 191)->nullable();
            $table->integer('foreign_exis')->default(0);
            $table->string('foreign_worker_exis', 191)->nullable();
            $table->longText('deskripsi_proyek')->nullable();
            $table->dateTime('jadwal_proyek')->nullable();
            $table->longText('loi_signed')->nullable();
            $table->boolean('interest_invesment')->nullable()->default(false);
            $table->bigInteger('proyek_id')->nullable();
            $table->string('sektor', 191)->nullable();
            $table->unsignedBigInteger('status_id')->index('kepeminatans_status_id_foreign');
            $table->longText('other_information')->nullable();
            $table->timestamps();
            $table->longText('signature')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kepeminatans');
    }
};
