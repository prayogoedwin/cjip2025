<?php

namespace App\Filament\Clusters\Kepeminatan\Resources\KepeminatanResource\Widgets;

use App\Models\Kepeminatan\Kepeminatan;
use Illuminate\Support\Facades\URL;
use Filament\Widgets\Widget;

class QuickReportKepeminatan extends Widget
{
    public $totalInvestasiDollar;
    public $totalInvestasiRupiah;
    public static function canView(): bool
    {
        if (URL::current() == \url('/admin')) {
            return false;
        }
        return true;
    }
    protected int | string | array $columnSpan = [
        'md' => 1,
        'xl' => 2,
    ];

    public function mount()
    {
        $this->totalInvestasiDollar = Kepeminatan::sum('nilai_investasi');
        $this->totalInvestasiRupiah = Kepeminatan::sum('nilai_investasi_rupiah');

        // Eloquent query to get investments grouped by preferensi_lokasi
        $investasiByPreferensiLokasi = Kepeminatan::select('prefensi_lokasi')
            ->selectRaw('SUM(nilai_investasi) as total_investasi_usd, SUM(nilai_investasi_rupiah) as total_investasi_rupiah')
            ->groupBy('prefensi_lokasi')
            ->get();

        // Eloquent query to get investments grouped by sektor
        $investasiBySektor = Kepeminatan::select('sektor')
            ->selectRaw('SUM(nilai_investasi) as total_investasi_usd, SUM(nilai_investasi_rupiah) as total_investasi_rupiah')
            ->groupBy('sektor')
            ->get();
    }
    protected static string $view = 'filament.clusters.kepeminatan.resources.kepeminatan-resource.widgets.quick-report-kepeminatan';
}
