<?php

namespace App\Livewire\Berita;

use Livewire\Component;
use Illuminate\Support\Facades\Session;


class Berita extends Component
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
    }
    public function render()
    {
        $this->locale = Session::get('lang', 'id');
        return view('livewire.berita.berita');
    }
}
