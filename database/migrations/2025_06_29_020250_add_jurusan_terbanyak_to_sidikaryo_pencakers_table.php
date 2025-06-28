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
            $table->string('jurusan_terbanyak')->nullable()->after('lulusan_sarjana_keatas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sidikaryo_pencakers', function (Blueprint $table) {
            $table->dropColumn('jurusan_terbanyak');
        });
    }
};
