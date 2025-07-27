<?php

namespace App\Filament\Clusters\Kepeminatan\Resources\KepeminatanResource\Widgets;

use App\Models\Kepeminatan\Kepeminatan;
use Illuminate\Support\Facades\URL;
use Filament\Widgets\Widget;

class QuickReportKepeminatan extends Widget
{
    public $totalInvestasiDollar;
    public $totalInvestasiRupiah;
    public $totalKepeminatan;
    public $sumKepeminatan;
    public $usdToIdrRate;
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
        // Define the current exchange rate
        // Note: For a real application, you should fetch this from an API for live data.
        $this->usdToIdrRate = 16359.89; // As of late July 2025

        $kepeminatanToday = Kepeminatan::whereDate('created_at', today())->get();

        // Calculate raw numeric values
        $rawKepeminatan = $kepeminatanToday->count();
        $rawUsd = (float) $kepeminatanToday->sum('nilai_investasi');
        $rawIdr = (float) $kepeminatanToday->sum('nilai_investasi_rupiah'); // This is the sum from the database column

        // Calculate sumKepeminatan based on the current rate
        $calculatedIdr = $rawUsd * $this->usdToIdrRate;

        // Update public properties
        $this->totalKepeminatan = $rawKepeminatan;
        $this->totalInvestasiDollar = $rawUsd;
        $this->totalInvestasiRupiah = $rawIdr; // The original sum from the DB
        $this->sumKepeminatan = $calculatedIdr; // The newly calculated sum
    }
    protected static string $view = 'filament.clusters.kepeminatan.resources.kepeminatan-resource.widgets.quick-report-kepeminatan';
}
