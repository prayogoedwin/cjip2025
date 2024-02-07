<?php

namespace App\Livewire\Kawasan;

use Livewire\Component;
use Illuminate\Support\Facades\Session;

class Kawasan extends Component
{
    public $locale;

    protected $listeners = ['languageChange' => 'changeLanguange'];
    // protected $listeners = ['refresh' => '$refresh'];


    public function changeLanguange($lang)
    {
        //dd($lang);
        $this->locale = $lang['lang'];
    }

    public function mount()
    {
        if (Session::get('lang')) {
            // dd(Session::get('lang'));
            if (is_array(Session::get('lang'))) {
                $this->locale = Session::get('lang')[0];
            } else {
                $this->locale = Session::get('lang');
            }
            // dd($this->locale);
        } else {
            $this->locale = 'id';
        }
    }


    public function render()
    {
        if ($locale = session('locale')) {
            app()->setLocale($locale);
        }
        return view('livewire.kawasan.kawasan');
    }
}
