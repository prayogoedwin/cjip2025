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
        Schema::create('cjibf_register_o3ms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('event_id');
            $table->string('name', 191);
            $table->string('company_name', 191);
            $table->string('mobile_phone', 191);
            $table->unsignedBigInteger('o3m_interest_id');
            $table->unsignedBigInteger('kawasan_id')->nullable();
            $table->unsignedBigInteger('kab_kota_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cjibf_register_o3ms');
    }
};
