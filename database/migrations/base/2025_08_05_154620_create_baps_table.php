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
        Schema::create('baps', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('proyek_id');
            $table->string('nib', 191);
            $table->boolean('is_punya_ss')->default(true);
            $table->string('status_riil', 191)->nullable();
            $table->date('tanggal_konstruksi_selesai')->nullable();
            $table->date('tanggal_mulai_operasi')->nullable();
            $table->longText('detail_ss')->nullable();
            $table->string('rencana_investasi', 191)->nullable();
            $table->string('realisasi_investasi', 191)->nullable();
            $table->longText('sumber_listriks')->nullable();
            $table->longText('tanah')->nullable();
            $table->boolean('kesusaian_investasi')->default(false);
            $table->string('keterangan_investasi_tidak_sesuai', 191)->nullable();
            $table->boolean('is_lapor_lkpm')->default(false);
            $table->longText('potensi_investasi')->nullable();
            $table->longText('tk')->nullable();
            $table->longText('jenis_kapasitas_produksi')->nullable();
            $table->boolean('is_mengajukan_fasilitas')->default(false);
            $table->longText('jenis_fasilitas');
            $table->boolean('is_bermitra')->default(false);
            $table->longText('kemitraan')->nullable();
            $table->boolean('is_bpjs')->default(false);
            $table->string('no_bpjs_ketenagakerjaan', 191)->nullable();
            $table->boolean('is_csr')->default(false);
            $table->string('alokasi_dana_csr', 191)->nullable();
            $table->string('objek_csr', 191)->nullable();
            $table->string('program_csr', 191)->nullable();
            $table->string('dokumen_lingkungan', 191)->nullable();
            $table->string('mateial_lingkungan', 191)->nullable();
            $table->string('ipal', 191)->nullable();
            $table->string('jumlah_unit', 191)->nullable();
            $table->string('fungsi_unit', 191)->nullable();
            $table->string('jenis_pelatihan', 191)->nullable();
            $table->string('jumlah_pelatihan', 191)->nullable();
            $table->longText('rekomendasi')->nullable();
            $table->longText('tindak_lanjut')->nullable();
            $table->longText('foto_proyek')->nullable();
            $table->string('nama', 191)->nullable();
            $table->string('jabatan', 191)->nullable();
            $table->string('no_hp', 191)->nullable();
            $table->longText('summary')->nullable();
            $table->timestamps();
            $table->date('tanggal_bap')->nullable();
            $table->string('badan_hukum', 191)->nullable();
            $table->string('nama_perusahaan', 191)->nullable();
            $table->string('status_perusahaan', 191)->nullable();
            $table->string('alamat', 191)->nullable();
            $table->string('keterangaan_riil', 191)->nullable();
            $table->string('tka', 191)->nullable();
            $table->string('jam_kerja', 191)->nullable();
            $table->string('alur_produksi', 191)->nullable();
            $table->string('status_lkpm', 191)->nullable();
            $table->string('kendala_lkpm', 191)->nullable();
            $table->longText('masalah')->nullable();
            $table->string('luas_tanah', 191)->nullable();
            $table->string('luas_bangunan', 191)->nullable();
            $table->string('status_tanah', 191)->nullable();
            $table->date('tanggal_nib')->nullable();
            $table->integer('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('baps');
    }
};
