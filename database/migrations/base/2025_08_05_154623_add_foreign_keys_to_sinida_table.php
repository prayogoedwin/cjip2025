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
        Schema::table('sinida', function (Blueprint $table) {
            $table->foreign(['status_id'])->references(['id'])->on('template_email')->onUpdate('restrict')->onDelete('cascade');
            $table->foreign(['user_id'])->references(['id'])->on('users')->onUpdate('restrict')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sinida', function (Blueprint $table) {
            $table->dropForeign('sinida_status_id_foreign');
            $table->dropForeign('sinida_user_id_foreign');
        });
    }
};
