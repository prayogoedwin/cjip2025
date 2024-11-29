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
    }

    public function render()
    {
        $this->locale = Session::get('lang', 'id');
        return view('livewire.kawasan.kawasan');
    }
}

