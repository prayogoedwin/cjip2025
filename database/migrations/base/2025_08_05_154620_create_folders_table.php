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
        Schema::create('folders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('model_type')->nullable();
            $table->unsignedBigInteger('model_id')->nullable();
            $table->string('name')->index();
            $table->string('collection')->nullable()->index();
            $table->string('description')->nullable();
            $table->string('icon')->nullable();
            $table->string('color')->nullable();
            $table->boolean('is_protected')->nullable()->default(false);
            $table->string('password')->nullable();
            $table->boolean('is_hidden')->nullable()->default(false);
            $table->boolean('is_favorite')->nullable()->default(false);
            $table->timestamps();
            $table->boolean('is_public')->nullable()->default(true);
            $table->boolean('has_user_access')->nullable()->default(false);
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('user_type')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('folders');
    }
};
