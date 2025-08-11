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
        Schema::create('beritas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('author_id')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->longText('title')->nullable();
            $table->longText('seo_title')->nullable();
            $table->longText('excerpt')->nullable();
            $table->longText('body')->nullable();
            $table->text('image')->nullable();
            $table->longText('slug')->nullable();
            $table->longText('meta_description')->nullable();
            $table->longText('meta_keyword')->nullable();
            $table->boolean('status')->nullable();
            $table->string('featured')->nullable();
            $table->timestamps();
            $table->string('kab_kota_id', 191)->nullable();
            $table->string('count', 191)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('beritas');
    }
};
