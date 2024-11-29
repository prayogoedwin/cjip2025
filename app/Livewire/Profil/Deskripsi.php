<?php

namespace App\Livewire\Profil;

use Livewire\Component;
use App\Settings\GeneralSettings;
use Illuminate\Support\Facades\Session;

class Deskripsi extends Component
{
    public $locale;
    protected $profil;

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

    public function render(GeneralSettings $generalSettings)
    {
        $this->locale = Session::get('lang', 'id');
        $this->profil = $generalSettings;
        return view('livewire.profil.deskripsi', [
            'profil' => $this->profil,
        ]);
    }
}
