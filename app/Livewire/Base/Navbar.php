<?php

namespace App\Livewire\Base;

use Livewire\Component;
use Illuminate\Support\Facades\Session;

class Navbar extends Component
{

    protected $navbar;
    public $locale;

    protected $listeners = ['refresh' => '$refresh'];

    public function changeLanguage($lang)
    {

        if (Session::exists('lang')) {
            Session::put('lang', $lang);
        } else {
            Session::push('lang', $lang);
        }

        if (is_array(Session::get('lang'))) {
            $this->locale = Session::get('lang')[0];
        } else {
            $this->locale = Session::get('lang');
        }

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
        $locale = $this->locale;
        return view('livewire.base.navbar', compact('locale'));
    }
}
