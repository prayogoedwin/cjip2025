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
        Schema::create('campaignable_templates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('mail_campaign_id')->index('campaignable_templates_mail_campaign_id_foreign');
            $table->unsignedBigInteger('mail_template_id')->index('campaignable_templates_mail_template_id_foreign');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campaignable_templates');
    }
};
