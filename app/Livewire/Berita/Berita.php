<?php

namespace App\Livewire\Berita;

use Livewire\Component;
use Illuminate\Support\Facades\Session;


class Berita extends Component
{
    protected $listeners = ['languageChange' => 'changeLanguange'];

    public $locale;

    public function changeLanguange($lang)
    {
        $this->locale = $lang['lang'];
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
        return view('livewire.berita.berita');
    }
}
