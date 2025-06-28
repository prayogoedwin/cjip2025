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
        Schema::table('sidikaryo_pencakers', function (Blueprint $table) {
             $table->integer('l')->nullable()->default(0)->change();
            $table->integer('p')->nullable()->default(0)->change();
            $table->integer('lulusan_sma_smk')->nullable()->default(0)->change();
            $table->integer('lulusan_dibawah_sma_smk')->nullable()->default(0)->change();
            $table->integer('lulusan_sarjana_keatas')->nullable()->default(0)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sidikaryo_pencakers', function (Blueprint $table) {
             $table->integer('l')->nullable(false)->default(0)->change();
            $table->integer('p')->nullable(false)->default(0)->change();
            $table->integer('lulusan_sma_smk')->nullable(false)->default(0)->change();
            $table->integer('lulusan_dibawah_sma_smk')->nullable(false)->default(0)->change();
            $table->integer('lulusan_sarjana_keatas')->nullable(false)->default(0)->change();
        });
    }
};
