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
        Schema::create('feeds', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('feed_id')->nullable();
            $table->string('model_name')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->string('index');
            $table->string('city');
            $table->integer('likes_count')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feeds');
    }
};
