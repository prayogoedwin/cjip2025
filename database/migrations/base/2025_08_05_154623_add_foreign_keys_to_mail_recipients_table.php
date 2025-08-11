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
        Schema::table('mail_recipients', function (Blueprint $table) {
            $table->foreign(['mail_campaign_id'])->references(['id'])->on('mail_campaigns')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign(['user_investor_id'])->references(['id'])->on('user_investors')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mail_recipients', function (Blueprint $table) {
            $table->dropForeign('mail_recipients_mail_campaign_id_foreign');
            $table->dropForeign('mail_recipients_user_investor_id_foreign');
        });
    }
};
