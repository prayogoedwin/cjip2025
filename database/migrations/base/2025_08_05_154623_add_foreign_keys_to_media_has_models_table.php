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
        Schema::table('media_has_models', function (Blueprint $table) {
            $table->foreign(['media_id'])->references(['id'])->on('media')->onUpdate('restrict')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('media_has_models', function (Blueprint $table) {
            $table->dropForeign('media_has_models_media_id_foreign');
        });
    }
};
