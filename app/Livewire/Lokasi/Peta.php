<?php

namespace App\Livewire\Lokasi;

use App\Models\Cjip\KawasanIndustri;
use App\Models\Cjip\ProyekInvestasi;
use Livewire\Component;
use Illuminate\Support\Facades\Session;

class Peta extends Component
{
    public $location, $location1, $location2, $location3, $proyeks, $proyeks1, $proyeks2, $proyeks3, $kawasans;
    public $locale;
    protected $listeners = ['languageChange' => 'changeLanguange'];

    public function changeLanguange($lang)
    {
        $this->locale = $lang['lang'];
    }
    public function mount()
    {
        if (Session::get('lang')) {
            if (is_array(Session::get('lang'))) {
                $this->locale = Session::get('lang')[0];
            } else {
                $this->locale = Session::get('lang');
            }
        } else {
            $this->locale = 'id';
        }

        $readytoover = ProyekInvestasi::all()->where('status', '1')->where('market_id', 1);
        $prospective = ProyekInvestasi::all()->where('status', '1')->where('market_id', 2);
        $potential = ProyekInvestasi::all()->where('status', '1')->where('market_id', 3);
        $strategi = ProyekInvestasi::all()->where('status', '1')->where('market_id', 4);
        $kawasan = KawasanIndustri::all()->where('status', '1');

        $this->proyeks = $readytoover;
        $this->proyeks1 = $prospective;
        $this->proyeks2 = $potential;
        $this->proyeks3 = $strategi;
        $this->kawasans = $kawasan;

    }
    public function render()
    {
        $locations = $this->proyeks;
        $locations1 = $this->proyeks1;
        $locations2 = $this->proyeks2;
        $locations3 = $this->proyeks3;
        $kawasan = $this->kawasans;

        return view('livewire.lokasi.peta')->extends('components.layouts.peta', [
            'locations' => $locations,
            'locations1' => $locations1,
            'locations2' => $locations2,
            'locations3' => $locations3,
            'kawasans' => $kawasan,
        ]);
    }
}
