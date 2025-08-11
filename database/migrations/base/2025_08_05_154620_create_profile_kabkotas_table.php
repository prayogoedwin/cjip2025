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
        Schema::create('profile_kabkotas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('profil')->nullable();
            $table->longText('desc_profil')->nullable();
            $table->unsignedBigInteger('kab_kota_id')->nullable();
            $table->longText('foto')->nullable();
            $table->string('luas')->nullable();
            $table->longText('infrastruktur')->nullable();
            $table->string('jarak_ke_smg')->nullable();
            $table->longText('rtrw')->nullable();
            $table->longText('grdp')->nullable();
            $table->longText('pert_ekonomi')->nullable();
            $table->string('inflasi')->nullable();
            $table->string('populasi')->nullable();
            $table->string('angka_kerja')->nullable();
            $table->string('umr')->nullable();
            $table->longText('komp_usia')->nullable();
            $table->string('tahun')->nullable();
            $table->boolean('status')->nullable();
            $table->longText('proyek_kerja_sama')->nullable();
            $table->longText('proyek_investasi')->nullable();
            $table->timestamps();
            $table->longText('icon')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profile_kabkotas');
    }
};
