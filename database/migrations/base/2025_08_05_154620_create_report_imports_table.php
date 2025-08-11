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
        Schema::create('report_imports', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('file', 191)->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->boolean('status')->default(false);
            $table->timestamps();
            $table->string('tanggal_awal', 191);
            $table->string('tanggal_akhir', 191);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('report_imports');
    }
};
