<?php

namespace App\Livewire\Cjibf;

use App\Settings\CjibfSettings;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Dashboard extends Component
{
    public $locale;
    protected $cjibf;
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

    public function render(CjibfSettings $cjibfSettings)
    {
        $this->cjibf = $cjibfSettings;
        $this->locale = Session::get('lang', 'id');
        $cjibf = $this->cjibf;
        return view('livewire.cjibf.dashboard', compact('cjibf'));
    }
}
