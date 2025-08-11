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
        Schema::create('profile_jatengs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('desc')->nullable();
            $table->longText('sdm')->nullable();
            $table->longText('umk')->nullable();
            $table->longText('biaya_investasi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profile_jatengs');
    }
};
