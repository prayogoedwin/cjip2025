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

    protected static bool $isLazy = true;
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
        $query = Report::with('user')->latest();
        if (auth()->user()->hasRole('kabkota')) {
            $query->where('user_id', auth()->user()->id);
        }
        $this->periode = $query->first();
    }

    protected static string $view = 'filament.resources.si-mike.proyek-resource.widgets.last-import-simike';
}
