<?php

namespace App\Livewire\Profil;

use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Link extends Component
{
    public $locale;
    protected $listeners = ['languageChange' => 'changeLanguange'];

    public function changeLanguange($lang)
    {
        $this->locale = $lang['lang'];
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
        return view('livewire.profil.link');
    }
}
