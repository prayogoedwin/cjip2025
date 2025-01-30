<?php

namespace App\Livewire\Beranda;

use App\Models\Cjip\Partner;
use Livewire\Component;
use Illuminate\Support\Facades\Session;


class Link extends Component
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
        $this->emit('languageChanged');
    }

    public function render()
    {
        $partners = Partner::orderBy('created_at', 'DESC')->get();

        if (Session::get('lang')) {
            if (is_array(Session::get('lang'))) {
                $this->locale = Session::get('lang')[0];
            } else {
                $this->locale = Session::get('lang');
            }
        } else {
            $this->locale = 'id';
        }
        return view('livewire.beranda.link', compact('partners'));
    }
}
