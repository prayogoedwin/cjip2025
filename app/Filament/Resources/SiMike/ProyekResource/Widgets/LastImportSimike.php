<?php

namespace App\Filament\Resources\SiMike\ProyekResource\Widgets;

use Filament\Widgets\Widget;
use App\Models\SiMike\Report;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Illuminate\Support\Facades\URL;

class LastImportSimike extends Widget
{
    use HasWidgetShield;

    public $periode, $tahun, $triwulan;

    public static function canView(): bool
    {
        if (URL::current() == \url('/admin')) {
            return false;
        }
        return true;
    }
    protected int|string|array $columnSpan = 'full';
    public function mount()
    {
        if (auth()->user()->hasRole('kabkota')) {
            $this->periode = Report::where('user_id', auth()->user()->id)->latest()->first();
        } else {
            $this->periode = Report::latest()->first();
        }
    }
    protected static string $view = 'filament.resources.si-mike.proyek-resource.widgets.last-import-simike';
}
