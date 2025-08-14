<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('sidikaryo_perusahaans', function (Blueprint $table) {
            // Tambah kolom kebutuhan_l setelah jumlah_lowongan
            $table->integer('kebutuhan_l')->nullable()->after('jumlah_lowongan')->default(0)->nullable();
            
            // Tambah kolom kebutuhan_p setelah kebutuhan_l
            $table->integer('kebutuhan_p')->nullable()->after('kebutuhan_l')->default(0)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('sidikaryo_perusahaans', function (Blueprint $table) {
            $table->dropColumn(['kebutuhan_l', 'kebutuhan_p']);
        });
    }
};