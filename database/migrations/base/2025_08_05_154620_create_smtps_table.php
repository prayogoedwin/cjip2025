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
        Schema::create('smtps', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('mail_mailer', 191);
            $table->string('mail_host', 191);
            $table->string('mail_port', 191);
            $table->string('mail_username', 191);
            $table->string('mail_password', 191);
            $table->string('mail_encryption', 191);
            $table->string('mail_from_address', 191);
            $table->string('mail_from_name', 191);
            $table->string('modul', 191);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('smtps');
    }
};
