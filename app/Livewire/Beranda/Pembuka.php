<?php

namespace App\Livewire\Beranda;

use App\Models\Cjip\InfrastrukturPendukung;
use App\Settings\GeneralSettings;
use Livewire\Component;
use Illuminate\Support\Facades\Session;

class Pembuka extends Component
{
    protected $opening;
    public $locale, $infrastrukturs;
    protected $listeners = ['languageChange' => 'changeLanguange'];

    public function changeLanguange($lang)
    {
        //dd($lang);
        $this->locale = $lang['lang'];
    }
    public function render(GeneralSettings $generalSettings)
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

        $this->opening = $generalSettings;
        $opening = $this->opening;

        $this->infrastrukturs = InfrastrukturPendukung::all();
        $infrastrukturs = $this->infrastrukturs;
        return view('livewire.beranda.pembuka', compact('infrastrukturs', 'opening'));
    }
}
