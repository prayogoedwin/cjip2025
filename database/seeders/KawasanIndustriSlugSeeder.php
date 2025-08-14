<?php

namespace Database\Seeders;

use App\Models\Cjip\KawasanIndustri;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class KawasanIndustriSlugSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // Ambil semua data Kawasan Industri
        $kawasanIndustriItems = KawasanIndustri::all();

        // Tampilkan pesan di console
        $this->command->info('Memulai proses pembuatan slug untuk ' . $kawasanIndustriItems->count() . ' data Kawasan Industri...');

        // Buat progress bar untuk visualisasi
        $bar = $this->command->getOutput()->createProgressBar($kawasanIndustriItems->count());
        $bar->start();

        // Loop setiap item
        foreach ($kawasanIndustriItems as $kawasan) {
            // Dapatkan semua terjemahan dari kolom 'nama'
            $namaTranslations = $kawasan->getTranslations('nama');

            $slugs = [];

            // Loop setiap terjemahan nama (misal: 'id', 'en', dll.)
            foreach ($namaTranslations as $locale => $nama) {
                // Buat slug dari nama dan tambahkan ke array slugs
                // Pastikan nama tidak null atau kosong sebelum membuat slug
                if (!empty($nama)) {
                    $slugs[$locale] = Str::slug($nama);
                }
            }

            // Simpan semua terjemahan slug ke kolom 'slug'
            $kawasan->setTranslations('slug', $slugs);

            // Simpan perubahan ke database tanpa mengubah updated_at
            $kawasan->timestamps = false;
            $kawasan->save();
            $kawasan->timestamps = true;

            // Lanjutkan progress bar
            $bar->advance();
        }

        $bar->finish();
        $this->command->info("\nProses pembuatan slug selesai.");
    }
}
