<?php

namespace App\Livewire\Profil;

use Livewire\Component;

use App\Settings\GeneralSettings;
use Illuminate\Support\Facades\Session;

class Deskripsi extends Component
{
    protected $profil;

    public $locale;

    protected $listeners = ['languageChange' => 'changeLanguange'];

    public function changeLanguange($lang)
    {
        //dd($lang);
        $this->locale = $lang['lang'];
    }
    public function render(GeneralSettings $generalSettings)
    {
        if (Session::get('lang')) {
            // dd(Session::get('lang'));
            if (is_array(Session::get('lang'))) {
                $this->locale = Session::get('lang')[0];
            } else {
                $this->locale = Session::get('lang');
            }
            // dd($this->locale);
        } else {
            $this->locale = 'id';
        }

        $this->profil = $generalSettings;
        $profil = $this->profil;
        return view('livewire.profil.deskripsi', compact('profil'));
    }
}
