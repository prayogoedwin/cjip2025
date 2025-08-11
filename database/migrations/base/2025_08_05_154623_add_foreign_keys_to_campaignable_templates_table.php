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
        Schema::table('campaignable_templates', function (Blueprint $table) {
            $table->foreign(['mail_campaign_id'])->references(['id'])->on('mail_campaigns')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign(['mail_template_id'])->references(['id'])->on('mail_templates')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('campaignable_templates', function (Blueprint $table) {
            $table->dropForeign('campaignable_templates_mail_campaign_id_foreign');
            $table->dropForeign('campaignable_templates_mail_template_id_foreign');
        });
    }
};
