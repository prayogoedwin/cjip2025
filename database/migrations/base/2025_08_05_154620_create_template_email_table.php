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
        Schema::create('template_email', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('status', 191);
            $table->string('subject', 191);
            $table->longText('content');
            $table->string('modul', 191);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('template_email');
    }
};
