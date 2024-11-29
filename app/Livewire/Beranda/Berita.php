<?php

namespace App\Livewire\Beranda;

use App\Models\Cjip\Berita as CjipBerita;
use Livewire\Component;
use Illuminate\Support\Facades\Session;


class Berita extends Component
{
    public $locale, $beritas;

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
        if (Session::get('lang')) {
            if (is_array(Session::get('lang'))) {
                $this->locale = Session::get('lang')[0];
            } else {
                $this->locale = Session::get('lang');
            }
        } else {
            $this->locale = 'id';
        }

        $this->beritas = CjipBerita::offset(0)->limit(6)->orderBy('created_at', 'DESC')->where('status', '1')->get();

        $beritas = $this->beritas;

        return view('livewire.beranda.berita', compact('beritas'));
    }
}
