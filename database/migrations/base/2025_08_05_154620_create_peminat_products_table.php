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
        Schema::create('peminat_products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('peminat_id')->index('peminat_products_peminat_id_foreign');
            $table->unsignedBigInteger('product_id')->index('peminat_products_product_id_foreign');
            $table->string('rencana_nilai_pekerjaan', 191)->nullable();
            $table->boolean('status')->nullable()->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminat_products');
    }
};
