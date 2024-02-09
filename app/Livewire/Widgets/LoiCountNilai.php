<?php

namespace App\Livewire\Widgets;

use App\Models\Cjip\Loi;
use Filament\Widgets\Widget;

class LoiCountNilai extends Widget
{
    public $usd, $countUsd, $rp, $countRp;

    protected int|string|array $columnSpan = 'full';

    public static function canView(): bool
    {
        if (auth()->user()->hasRole('koordinator lo') or auth()->user()->hasRole('super_admin')) {
            return true;
        }

        return false;
    }

    public function mount()
    {
        $usd = Loi::sum('nilai_usd');
        $countUsd = Loi::whereNotNull('nilai_usd')->count();
        $rp = Loi::sum('nilai_rp');
        $countRp = Loi::whereNotNull('nilai_rp')->count();

        $this->usd = $usd;
        $this->countUsd = $countUsd;
        $this->countRp = $countRp;
        $this->rp = $rp;
    }
    protected static string $view = 'livewire.widgets.loi-count-nilai';
}
