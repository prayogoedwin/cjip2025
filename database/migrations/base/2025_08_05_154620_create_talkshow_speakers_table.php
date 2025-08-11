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
        Schema::create('talkshow_speakers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama')->nullable();
            $table->string('jabatan')->nullable();
            $table->longText('tema')->nullable();
            $table->string('foto')->nullable();
            $table->timestamps();
            $table->integer('event_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('talkshow_speakers');
    }
};
