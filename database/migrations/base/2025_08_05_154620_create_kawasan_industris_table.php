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
        Schema::create('kawasan_industris', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('foto')->nullable();
            $table->string('nama')->nullable();
            $table->unsignedBigInteger('jenis_kawasan_id')->nullable();
            $table->longText('profil')->nullable();
            $table->longText('lokasi')->nullable();
            $table->longText('masterplan')->nullable();
            $table->longText('produk')->nullable();
            $table->longText('infrastruktur_dasar')->nullable();
            $table->longText('infrastruktur_industri')->nullable();
            $table->longText('infrastruktur_penunjang')->nullable();
            $table->longText('fasilitas')->nullable();
            $table->longText('tenant')->nullable();
            $table->string('url_video')->nullable();
            $table->string('user_id');
            $table->timestamps();
            $table->longText('perusahaan')->nullable();
            $table->longText('kawasan')->nullable();
            $table->longText('image_masterplan')->nullable();
            $table->longText('image_produk')->nullable();
            $table->longText('lahan_siap_bangun')->nullable();
            $table->longText('image_lahan_siap_bangun')->nullable();
            $table->longText('bangun_pabrik_siap_pakai')->nullable();
            $table->longText('image_pabrik_siap_pakai')->nullable();
            $table->longText('produk_lainnya')->nullable();
            $table->longText('image_produk_lainnya')->nullable();
            $table->longText('jaringan_energi_listrik')->nullable();
            $table->longText('image_jaringan_energi_listrik')->nullable();
            $table->longText('jaringan_telekomunikasi')->nullable();
            $table->longText('image_jaringan_telekomunikasi')->nullable();
            $table->longText('jaringan_sda')->nullable();
            $table->longText('image_sda')->nullable();
            $table->longText('sanitasi')->nullable();
            $table->longText('image_sanitasi')->nullable();
            $table->longText('jaringan_transportasi')->nullable();
            $table->longText('image_transportasi')->nullable();
            $table->longText('perumahan')->nullable();
            $table->longText('image_perumahan')->nullable();
            $table->longText('pendidikan_pelatihan')->nullable();
            $table->longText('image_pendidikan_pelatihan')->nullable();
            $table->longText('penelitian_pengembangan')->nullable();
            $table->longText('image_penelitian_pengembangan')->nullable();
            $table->longText('kesehatan')->nullable();
            $table->longText('image_kesehatan')->nullable();
            $table->longText('pemadam_kebakaran')->nullable();
            $table->longText('image_pemadam_kebakaran')->nullable();
            $table->longText('tempat_pembuangan_sampah')->nullable();
            $table->longText('image_tempat_pembuangan_sampah')->nullable();
            $table->longText('instalasi_pengelolaan_air_baku')->nullable();
            $table->longText('image_instalasi_pengelolaan_air_baku')->nullable();
            $table->longText('instalasi_pengelolaan_air_limbah')->nullable();
            $table->longText('image_instalasi_pengelolaan_air_limbah')->nullable();
            $table->longText('saluran_drainase')->nullable();
            $table->longText('image_saluran_drainase')->nullable();
            $table->longText('instalasi_penerangan_jalan')->nullable();
            $table->longText('image_instalasi_penerangan_jalan')->nullable();
            $table->longText('jaringan_jalan')->nullable();
            $table->longText('image_jaringan_jalan')->nullable();
            $table->longText('image_fasilitas')->nullable();
            $table->longText('tenant_en')->nullable();
            $table->boolean('status')->nullable();
            $table->text('lat')->nullable();
            $table->text('lng')->nullable();
            $table->integer('kawasan_id')->nullable();
            $table->string('url_website', 191)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kawasan_industris');
    }
};
