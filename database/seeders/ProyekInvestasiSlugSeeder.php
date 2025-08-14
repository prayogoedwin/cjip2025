<?php

namespace Database\Seeders;

use App\Models\Cjip\ProyekInvestasi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProyekInvestasiSlugSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil semua data Proyek Investasi
        $proyekItems = ProyekInvestasi::all();

        // Tampilkan pesan di console
        $this->command->info('Memulai proses pembuatan slug untuk ' . $proyekItems->count() . ' data Proyek Investasi...');

        // Buat progress bar untuk visualisasi
        $bar = $this->command->getOutput()->createProgressBar($proyekItems->count());
        $bar->start();

        // Loop setiap item
        foreach ($proyekItems as $proyek) {
            // Dapatkan semua terjemahan dari kolom 'nama'
            $namaTranslations = $proyek->getTranslations('nama');

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
            $proyek->setTranslations('slug', $slugs);

            // Simpan perubahan ke database tanpa mengubah updated_at
            $proyek->timestamps = false;
            $proyek->save();
            $proyek->timestamps = true;

            // Lanjutkan progress bar
            $bar->advance();
        }

        $bar->finish();
        $this->command->info("\nProses pembuatan slug untuk Proyek Investasi selesai.");
    }
}
