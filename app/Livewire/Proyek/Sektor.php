<?php

namespace App\Livewire\Proyek;

use Livewire\Component;
use Illuminate\Support\Facades\Session;


class Sektor extends Component
{
    public $locale;
    protected $listeners = ['languageChange' => 'changeLanguange'];

    public function changeLanguange($lang)
    {
        //dd($lang);
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

        return view('livewire.proyek.sektor');
    }
}
