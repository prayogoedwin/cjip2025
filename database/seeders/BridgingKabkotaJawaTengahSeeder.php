<?php

namespace Database\Seeders;

use App\Models\BridgingKabkota;
use Illuminate\Database\Seeder;

class BridgingKabkotaJawaTengahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            // Kota
            ['id' => 1, 'nama' => 'Kota Pekalongan', 'kode' => '3375'],
            ['id' => 2, 'nama' => 'Kota Semarang', 'kode' => '3374'],
            ['id' => 3, 'nama' => 'Kota Salatiga', 'kode' => '3373'],
            ['id' => 4, 'nama' => 'Kota Magelang', 'kode' => '3371'],
            ['id' => 5, 'nama' => 'Kota Surakarta', 'kode' => '3372'],
            ['id' => 6, 'nama' => 'Kota Tegal', 'kode' => '3376'],
            
            // Kabupaten
            ['id' => 7, 'nama' => 'Kabupaten Pekalongan', 'kode' => '3326'],
            ['id' => 8, 'nama' => 'Kabupaten Jepara', 'kode' => '3320'],
            ['id' => 9, 'nama' => 'Kabupaten Pati', 'kode' => '3318'],
            ['id' => 10, 'nama' => 'Kabupaten Pemalang', 'kode' => '3327'],
            ['id' => 11, 'nama' => 'Kabupaten Magelang', 'kode' => '3308'],
            ['id' => 12, 'nama' => 'Kabupaten Sukoharjo', 'kode' => '3311'],
            ['id' => 13, 'nama' => 'Kabupaten Demak', 'kode' => '3321'],
            ['id' => 14, 'nama' => 'Kabupaten Purbalingga', 'kode' => '3303'],
            ['id' => 15, 'nama' => 'Kabupaten Batang', 'kode' => '3325'],
            ['id' => 16, 'nama' => 'Kabupaten Rembang', 'kode' => '3317'],
            ['id' => 17, 'nama' => 'Kabupaten Kebumen', 'kode' => '3305'],
            ['id' => 18, 'nama' => 'Kabupaten Grobogan', 'kode' => '3315'],
            ['id' => 19, 'nama' => 'Kabupaten Sragen', 'kode' => '3314'],
            ['id' => 20, 'nama' => 'Kabupaten Blora', 'kode' => '3316'],
            ['id' => 21, 'nama' => 'Kabupaten Temanggung', 'kode' => '3323'],
            ['id' => 22, 'nama' => 'Kabupaten Karanganyar', 'kode' => '3313'],
            ['id' => 23, 'nama' => 'Kabupaten Wonogiri', 'kode' => '3312'],
            ['id' => 24, 'nama' => 'Kabupaten Wonosobo', 'kode' => '3307'],
            ['id' => 25, 'nama' => 'Kabupaten Kendal', 'kode' => '3324'],
            ['id' => 26, 'nama' => 'Kabupaten Brebes', 'kode' => '3329'],
            ['id' => 27, 'nama' => 'Kabupaten Banyumas', 'kode' => '3302'],
            ['id' => 28, 'nama' => 'Kabupaten Banjarnegara', 'kode' => '3304'],
            ['id' => 29, 'nama' => 'Kabupaten Kudus', 'kode' => '3319'],
            ['id' => 30, 'nama' => 'Kabupaten Purworejo', 'kode' => '3306'],
            ['id' => 31, 'nama' => 'Kabupaten Cilacap', 'kode' => '3301'],
            ['id' => 32, 'nama' => 'Kabupaten Boyolali', 'kode' => '3309'],
            ['id' => 33, 'nama' => 'Kabupaten Klaten', 'kode' => '3310'],
            ['id' => 34, 'nama' => 'Kabupaten Tegal', 'kode' => '3328'],
            ['id' => 35, 'nama' => 'Kabupaten Semarang', 'kode' => '3322'],
            
            // Provinsi
            ['id' => 36, 'nama' => 'Provinsi Jawa Tengah', 'kode' => '3300'],
        ];

        foreach ($data as $item) {
            BridgingKabkota::updateOrCreate(
                ['cjip_kabkota_id' => (string)$item['id']], // Langsung menggunakan ID dari gambar
                [
                    'kabkota_id' => $item['kode'],
                    'nama_kota' => $item['nama'],
                ]
            );
        }

        $this->command->info('Data bridging kabupaten/kota Jawa Tengah berhasil ditambahkan!');
    }
}