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
        Schema::create('jadwals', function (Blueprint $table) {
            $table->char('id', 36)->primary();
            $table->longText('attachments')->nullable();
            $table->longText('body')->nullable();
            $table->string('category', 191)->nullable();
            $table->date('end');
            $table->time('endTime')->nullable();
            $table->boolean('isAllDay')->default(false);
            $table->char('organizer', 36);
            $table->longText('participants')->nullable();
            $table->longText('subject');
            $table->date('start');
            $table->time('startTime')->nullable();
            $table->timestamps();
            $table->longText('personil')->nullable();
            $table->string('tahun', 191)->nullable();
            $table->unsignedBigInteger('proyek_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwals');
    }
};
