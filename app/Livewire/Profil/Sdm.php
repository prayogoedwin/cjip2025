<?php

namespace App\Livewire\Profil;

use Livewire\Component;
use Illuminate\Support\Facades\Session;
use App\Settings\GeneralSettings;

class Sdm extends Component
{
    protected $profil;
    public $locale;
    protected $listeners = [
        'languageChange' => 'changeLanguage',
        'languageChanged' => '$refresh',
    ];

    public function changeLanguage($lang)
    {
        $this->locale = $lang['lang'];
        Session::put('lang', $this->locale);
        $this->emit('languageChanged');
    }
    // use WithPagination;

    // protected $umks;

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
        $this->profil = $generalSettings;
        $profil = $this->profil;
        return view('livewire.profil.sdm', compact('profil'));
    }
}
