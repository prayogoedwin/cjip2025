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
        Schema::table('sidikaryo_dapodiks', function (Blueprint $table) {
            $table->integer('tahun_tarik')->nullable()->before('tahun_data')->default(0)->nullable();
            $table->integer('semester')->nullable()->after('tahun_tarik')->default(0)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sidikaryo_dapodiks', function (Blueprint $table) {
            $table->dropColumn(['tahun_tarik', 'semester']);
        });
    }
};
