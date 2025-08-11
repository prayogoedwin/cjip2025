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
        Schema::create('jadwal_vidcons', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('meeting_id');
            $table->string('passcode');
            $table->string('kab_kota_id');
            $table->string('time_start');
            $table->string('time_end');
            $table->date('tanggal');
            $table->timestamps();
            $table->integer('status');
            $table->string('link');
            $table->string('sesi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_vidcons');
    }
};
