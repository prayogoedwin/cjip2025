<?php

namespace App\Livewire\Lokasi;

use App\Models\Cjip\ProyekInvestasi;
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
        $readytoover = ProyekInvestasi::all()->where('status', '1')->where('market_id', 1);
        $prospective = ProyekInvestasi::all()->where('status', '1')->where('market_id', 2);
        $potential = ProyekInvestasi::all()->where('status', '1')->where('market_id', 3);
        $strategi = ProyekInvestasi::all()->where('status', '1')->where('market_id', 4);

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
