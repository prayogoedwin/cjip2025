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
        Schema::create('count_interests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('model');
            $table->string('proyek_id');
            $table->string('user_id');
            $table->timestamps();
            $table->string('kab_kota_id');
            $table->string('group');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('count_interests');
    }
};
