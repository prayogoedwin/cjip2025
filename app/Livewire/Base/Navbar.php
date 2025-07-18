<?php

namespace App\Livewire\Base;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Livewire\Component;
use Illuminate\Support\Facades\Session;

class Navbar extends Component
{

    public $locale;

    protected $listeners = ['refresh' => '$refresh'];

    public function changeLanguage($lang)
    {
        Session::put('lang', $lang);
        $this->locale = $lang;
        $this->dispatch('languageChanged', $lang);
    }
    public function logout()
    {
        Auth::logout();

        return Redirect::to('/');
    }

    public function render()
    {
        if (Session::get('lang')) {
            $this->locale = is_array(Session::get('lang')) ? Session::get('lang')[0] : Session::get('lang');
        } else {
            $this->locale = 'id';
        }

        return view('livewire.base.navbar', ['locale' => $this->locale]);
    }
}
