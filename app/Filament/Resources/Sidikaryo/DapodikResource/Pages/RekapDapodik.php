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
                DB::raw('SUM(kelulusan_laki) as total_kelulusan_laki'),
                DB::raw('SUM(kelulusan_perempuan) as total_kelulusan_perempuan'),
            ])
            ->groupBy('cjip_kota_id', 'kab_kota')
            ->orderBy('kab_kota')
            ->get()
            ->toArray();
    }
}
