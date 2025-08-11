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
        Schema::create('report_rilis', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('file', 191)->nullable();
            $table->integer('user_id')->nullable();
            $table->boolean('status')->nullable();
            $table->string('tanggal_awal', 191)->nullable();
            $table->string('tanggal_akhir', 191)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('report_rilis');
    }
};
