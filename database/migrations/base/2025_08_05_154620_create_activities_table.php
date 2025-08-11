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
        Schema::create('activities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('model_id')->nullable();
            $table->string('model_type')->nullable();
            $table->string('request_hash')->index();
            $table->string('http_version')->nullable();
            $table->double('response_time')->nullable();
            $table->integer('status')->nullable();
            $table->string('method')->nullable();
            $table->string('url')->nullable();
            $table->string('referer')->nullable();
            $table->json('query')->nullable();
            $table->string('remote_address')->nullable();
            $table->text('user_agent')->nullable();
            $table->json('response')->nullable();
            $table->string('level')->nullable()->default('info');
            $table->string('user')->nullable();
            $table->json('log')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activities');
    }
};
