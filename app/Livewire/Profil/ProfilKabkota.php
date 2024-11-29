<?php

namespace App\Livewire\Profil;

use App\Models\Investasi\ProyekInvestasi;
use App\Models\Profile\ProfileKabkota;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Livewire\WithPagination;


class ProfilKabkota extends Component
{
    use WithPagination;
    protected $profil;

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
        if (Session::get('lang')) {
            if (is_array(Session::get('lang'))) {
                $this->locale = Session::get('lang')[0];
            } else {
                $this->locale = Session::get('lang');
            }
        } else {
            $this->locale = 'id';
        }
        $this->profil = \App\Models\Cjip\ProfileKabkota::paginate(4);
        $kabkota = $this->profil;
        return view('livewire.profil.profil-kabkota', compact('kabkota'));
    }
}
