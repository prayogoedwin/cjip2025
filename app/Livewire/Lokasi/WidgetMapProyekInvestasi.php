<?php

namespace App\Livewire\Lokasi;

use App\Models\Cjip\ProyekInvestasi;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class WidgetMapProyekInvestasi extends Component
{
    public $location, $location1, $location2, $location3, $proyeks, $proyeks1, $proyeks2, $proyeks3;
    public $locale = 'id';
    protected $listeners = ['languageChange' => 'changeLanguage'];
    public function changeLanguage($lang)
    {
        $this->locale = $lang['lang'];
    }

    public function mount()
    {
        $readytoover = ProyekInvestasi::query()
            ->where('status', 1)
            ->where('market_id', 1)
            ->when(Auth::user()->hasRole('admin_cjip'), function (Builder $query) {
                $query->where('kab_kota_id', Auth::user()->kabkota->id);
            })
            ->get();

        $prospective = ProyekInvestasi::query()
            ->where('status', 1)
            ->where('market_id', 2)
            ->when(Auth::user()->hasRole('admin_cjip'), function (Builder $query) {
                $query->where('kab_kota_id', Auth::user()->kabkota->id);
            })
            ->get();

        $potential = ProyekInvestasi::query()
            ->where('status', 1)
            ->where('market_id', 3)
            ->when(Auth::user()->hasRole('admin_cjip'), function (Builder $query) {
                $query->where('kab_kota_id', Auth::user()->kabkota->id);
            })
            ->get();

        $strategi = ProyekInvestasi::query()
            ->where('status', 1)
            ->where('market_id', 4)
            ->when(Auth::user()->hasRole('admin_cjip'), function (Builder $query) {
                $query->where('kab_kota_id', Auth::user()->kabkota->id);
            })
            ->get();

        $this->proyeks = $readytoover;
        $this->proyeks1 = $prospective;
        $this->proyeks2 = $potential;
        $this->proyeks3 = $strategi;
    }

    public function render()
    {
        // Pass data to the view with locations for each type
        $locations = $this->proyeks;
        $locations1 = $this->proyeks1;
        $locations2 = $this->proyeks2;
        $locations3 = $this->proyeks3;

        return view('livewire.lokasi.widget-map-proyek-investasi', [
            'locations' => $locations,
            'locations1' => $locations1,
            'locations2' => $locations2,
            'locations3' => $locations3,
            'locale' => $this->locale,  // Pass the current locale to the view
        ])->layout('components.layouts.master');
    }
}
