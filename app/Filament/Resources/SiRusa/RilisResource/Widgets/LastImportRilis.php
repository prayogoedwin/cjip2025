<?php

namespace App\Filament\Resources\SiRusa\RilisResource\Widgets;

use App\Models\SiRusa\ReportRilis;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\Widget;
use Illuminate\Support\Facades\URL;

class LastImportRilis extends StatsOverviewWidget
{

    public $periode, $total_nib, $total_proyek, $tahun, $triwulan;
    protected static ?int $sort = 1;
    protected static ?string $pollingInterval = null;

    public static function canView(): bool
    {
        /*return auth()->user()->hasRole('kabkota');*/
        if (URL::current() == \url('/admin')) {
            return false;
        }
        return true;
    }

    public function mount()
    {
        $this->periode = ReportRilis::where('user_id', auth()->user()->id)->latest()->first();
    }
    protected static string $view = 'filament.resources.si-rusa.rilis-resource.widgets.last-import-rilis';
}
