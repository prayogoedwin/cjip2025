<?php

namespace App\Livewire\Faq;

use Livewire\Component;
use Illuminate\Support\Facades\Session;


class Faq extends Component
{
    public $locale;

    protected $listeners = [
        'languageChange' => 'changeLanguage',
        'languageChanged' => '$refresh', // Refresh komponen setelah bahasa diubah
    ];

    public function changeLanguage($lang)
    {
        $this->locale = $lang['lang'];

        // Mengatur bahasa di sesi
        Session::put('lang', $this->locale);

        // Emit event untuk melakukan reload atau refresh halaman
        $this->emit('languageChanged');
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
        return view('livewire.faq.faq');
    }
}
