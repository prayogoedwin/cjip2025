<?php

namespace App\Filament\Resources\SiRusa\NibResource\Widgets;

use App\Models\SiRusa\ReportImport;
use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\Widget;
use Illuminate\Support\Facades\URL;

class LastImportNib extends StatsOverviewWidget
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
        // $this->periode = ReportImport::where('user_id', auth()->user()->id)->latest()->first();
        $this->periode = ReportImport::latest()->first();
    }

    protected static string $view = 'filament.resources.si-rusa.nib-resource.widgets.last-import-nib';
}
