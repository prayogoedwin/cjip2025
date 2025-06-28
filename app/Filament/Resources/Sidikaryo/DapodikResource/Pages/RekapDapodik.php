<?php

namespace App\Filament\Resources\Sidikaryo\DapodikResource\Pages;

use App\Filament\Resources\Sidikaryo\DapodikResource;
use App\Models\Sidikaryo\SidikaryoDapodik;
use Filament\Resources\Pages\Page;
use Illuminate\Support\Facades\DB;

class RekapDapodik extends Page
{
    protected static string $resource = DapodikResource::class;

    protected static string $view = 'filament.resources.sidikaryo.dapodik-resource.pages.rekap-dapodik';

    public $rekapData = [];

    public function mount(): void
    {
        $this->rekapData = SidikaryoDapodik::query()
            ->select([
                'cjip_kota_id',
                'kab_kota',
                DB::raw('SUM(jumlah_laki_laki) as total_laki'),
                DB::raw('SUM(jumlah_perempuan) as total_perempuan'),
                DB::raw('SUM(total_jumlah_potensi_lulusan) as total_potensi')
            ])
            ->groupBy('cjip_kota_id', 'kab_kota')
            ->orderBy('kab_kota')
            ->get()
            ->toArray();
    }
}
