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
        Schema::create('timex_categories', function (Blueprint $table) {
            $table->char('id', 36)->primary();
            $table->string('value', 191);
            $table->string('icon', 191)->nullable();
            $table->string('color', 191)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('timex_categories');
    }
};
