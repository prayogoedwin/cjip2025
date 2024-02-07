<?php

namespace App\Livewire\Beranda;

use App\Models\Cjip\KawasanIndustri;
use Illuminate\Support\Facades\Session;


use Livewire\Component;

class Kawasan extends Component
{

    public $locale, $kawasan_industris;
    protected $listeners = ['languageChange' => 'changeLanguange'];

    public function changeLanguange($lang)
    {
        //dd($lang);
        $this->locale = $lang['lang'];
    }
    public function render()
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

        $this->kawasan_industris = KawasanIndustri::offset(0)->limit(3)->get();

        // dd($this->kawasan_industris);

        $kawasan_industris = $this->kawasan_industris;
        return view('livewire.beranda.kawasan', compact('kawasan_industris'));
    }
}
