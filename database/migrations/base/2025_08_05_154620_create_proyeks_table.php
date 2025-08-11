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
        Schema::create('proyeks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('nib_id')->nullable()->index();
            $table->boolean('is_tambahan')->default(false);
            $table->string('id_proyek')->unique();
            $table->string('kbli')->index();
            $table->string('judul_kbli')->nullable();
            $table->string('flag')->nullable();
            $table->string('uraian_risiko_proyek')->nullable()->index();
            $table->string('uraian_skala_usaha')->nullable()->index();
            $table->string('alamat_usaha')->nullable();
            $table->string('kelurahan_usaha')->nullable();
            $table->string('kecamatan_usaha')->nullable();
            $table->string('kab_kota_usaha')->nullable();
            $table->string('provinsi_usaha')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('tanggal_terbit_oss')->nullable();
            $table->string('tki')->nullable()->index();
            $table->string('tka')->nullable()->index();
            $table->string('tahun')->nullable()->index();
            $table->string('triwulan')->nullable()->index();
            $table->string('mesin_peralatan')->nullable();
            $table->string('mesin_peralatan_impor')->nullable();
            $table->string('pembelian_pematangan_tanah')->nullable();
            $table->string('modal_kerja')->nullable();
            $table->string('lain_lain')->nullable();
            $table->string('jumlah_investasi')->nullable()->index();
            $table->unsignedBigInteger('kab_kota_id')->nullable()->index();
            $table->unsignedBigInteger('user_id');
            $table->string('klsektor_pembina')->nullable();
            $table->unsignedBigInteger('last_edited_by_id')->nullable();
            $table->timestamps();
            $table->string('sektor')->nullable();
            $table->unsignedBigInteger('sektor_id')->nullable();
            $table->timestamp('periode_start')->nullable();
            $table->timestamp('periode_end')->nullable();
            $table->unsignedBigInteger('rules_id')->nullable();
            $table->string('nib')->index();
            $table->boolean('is_anomaly')->nullable()->index();
            $table->string('total_investasi')->index();
            $table->string('nama_perusahaan')->nullable()->index();
            $table->string('npwp_perusahaan')->nullable();
            $table->string('uraian_status_penanaman_modal')->nullable()->index();
            $table->string('nama_user')->nullable();
            $table->string('nomor_identitas_user')->nullable();
            $table->string('email')->nullable();
            $table->string('alamat')->nullable();
            $table->string('nomor_telp')->nullable();
            $table->string('nib_count')->nullable();
            $table->string('bangunan_gedung', 191)->nullable();
            $table->string('kl_sektor_pembina', 191)->nullable();
            $table->boolean('is_jateng')->default(false);
            $table->boolean('is_lapor_tw1')->nullable();
            $table->boolean('is_lapor_tw2')->nullable();
            $table->boolean('is_lapor_tw3')->nullable();
            $table->boolean('is_lapor_tw4')->nullable();
            $table->unsignedBigInteger('pengawasan_id')->nullable();
            $table->string('tahun_rilis', 191)->nullable();
            $table->longText('rilis')->nullable();
            $table->boolean('is_terfasilitasi')->nullable()->default(false);
            $table->boolean('is_terbina')->nullable()->default(false);
            $table->string('luas_tanah', 191)->nullable();
            $table->string('satuan_tanah', 191)->nullable();
            $table->boolean('dikecualikan')->default(false);
            $table->string('day_of_tanggal_pengajuan_proyek', 191)->nullable();
            $table->boolean('is_mapping');
            $table->integer('mapping_kbli_id')->nullable();
            $table->string('nama_23_sektor', 191)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proyeks');
    }
};
