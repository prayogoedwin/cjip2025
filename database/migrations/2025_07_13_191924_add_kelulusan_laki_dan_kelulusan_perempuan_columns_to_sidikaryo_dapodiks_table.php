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
            $table->integer('kelulusan_laki')->nullable()->before('total_jumlah_potensi')->default(0)->nullable();
            $table->integer('kelulusan_perempuan')->nullable()->after('kelulusan_laki')->default(0)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sidikaryo_dapodiks', function (Blueprint $table) {
             $table->dropColumn(['kelulusan_laki', 'kelulusan_perempuan']);
        });
    }
};
