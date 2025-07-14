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
             $table->string('dataperiode')->nullable()->after('kabkota_id')->default(null)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sidikaryo_dapodiks', function (Blueprint $table) {
             $table->dropColumn('dataperiode');
        });
    }
};
