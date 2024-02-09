<?php

namespace App\Livewire\Widgets;

use App\Models\Cjip\Event;
use App\Models\Cjip\Loi;
use Filament\Widgets\Widget;
use Illuminate\Support\Facades\URL;

class LoiSumNilai extends Widget
{
    public $kurs, $usd, $countUsd, $rp, $countRp;
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
        $kurs = Event::first()->kurs_dollar;
        $usd = Loi::where('event_id', 1)->sum('nilai_usd');
        $countUsd = Loi::where('event_id', 1)->whereNotNull('nilai_usd')->count();
        $rp = Loi::where('event_id', 1)->sum('nilai_rp');
        $countRp = Loi::where('event_id', 1)->whereNotNull('nilai_rp')->count();

        $this->countUsd = $countUsd;
        $this->countRp = $countRp;
        $this->kurs = $kurs;
        $this->usd = $usd;
        $this->rp = $rp;
    }
    protected static string $view = 'livewire.widgets.loi-sum-nilai';
}
