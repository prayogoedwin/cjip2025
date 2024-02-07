<?php

namespace App\Livewire\Base;

use App\Settings\FooterSettings;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Footer extends Component
{
    protected $footer;
    public $locale;
    protected $listeners = ['languageChange' => 'changeLanguange'];
    public function changeLanguange($lang)
    {
        $this->locale = $lang['lang'];
    }
    public function render(FooterSettings $footerSettings)
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

        $this->footer = $footerSettings;
        $footer = $this->footer;
        $locale = $this->locale;
        return view('livewire.base.footer', compact('footer', 'locale'));
    }
}
