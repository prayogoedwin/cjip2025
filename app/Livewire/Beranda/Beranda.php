<?php

namespace App\Livewire\Beranda;

use App\Models\Cjip\Slider;
use Livewire\Component;
use Illuminate\Support\Facades\Session;


class Beranda extends Component
{
    public $locale;
    public $sliders;
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
        $this->sliders = Slider::orderBy('created_at', 'desc')->get();
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
        return view('livewire.beranda.beranda');
    }
}
