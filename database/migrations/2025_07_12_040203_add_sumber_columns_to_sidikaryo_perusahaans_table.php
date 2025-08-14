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
        Schema::table('sidikaryo_perusahaans', function (Blueprint $table) {
             $table->integer('sumber')->nullable()->after('kodepos')->default(0)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sidikaryo_perusahaans', function (Blueprint $table) {
               $table->dropColumn('sumber');
        });
    }
};
