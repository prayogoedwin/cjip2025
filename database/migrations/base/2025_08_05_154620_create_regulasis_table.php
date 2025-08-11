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
        Schema::create('regulasis', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('kab_kota_id')->nullable();
            $table->integer('jns_peraturan_id')->nullable();
            $table->string('tahun')->nullable();
            $table->string('no')->nullable();
            $table->string('tentang')->nullable();
            $table->string('file')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->string('page_view_type');
            $table->unsignedBigInteger('page_view_id');
            $table->integer('like_count')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('regulasis');
    }
};
