<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('sidikaryo_penempatans', function (Blueprint $table) {
            $table->timestamps(); // Menambahkan created_at dan updated_at
            $table->softDeletes(); // Menambahkan deleted_at untuk soft delete
        });
    }

    public function down()
    {
        Schema::table('sidikaryo_penempatans', function (Blueprint $table) {
            $table->dropColumn(['created_at', 'updated_at', 'deleted_at']);
        });
    }
};
