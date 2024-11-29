<?php

namespace App\Livewire\Kawasan;

use Livewire\Component;
use Illuminate\Support\Facades\Session;

class Kawasan extends Component
{
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


    public function render()
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
        return view('livewire.kawasan.kawasan');
    }
}
