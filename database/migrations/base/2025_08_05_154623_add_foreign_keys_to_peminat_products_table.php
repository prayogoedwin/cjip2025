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
        Schema::table('peminat_products', function (Blueprint $table) {
            $table->foreign(['peminat_id'])->references(['id'])->on('users')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign(['product_id'])->references(['id'])->on('products')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('peminat_products', function (Blueprint $table) {
            $table->dropForeign('peminat_products_peminat_id_foreign');
            $table->dropForeign('peminat_products_product_id_foreign');
        });
    }
};
