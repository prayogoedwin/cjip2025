<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SidikaryoIntegrasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('sidikaryo_integrasi')->insert([
            'nama_app' => 'Emakaryo',
            'username' => 'cjip_dpmptsp',
            'password' => 'Project2025!abc', // Password di-hash
            'apikey' => '8fa050b2-74d5-4c1b-bf4d-a94521592dd6',
            'token' => null,
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null // Untuk softDeletes
        ]);
    }
}
