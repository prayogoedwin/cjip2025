<?php

namespace App\Livewire\Profil;

use App\Models\Cjip\ProfileKabkota;
use App\Models\Cjip\ProyekInvestasi;
use Livewire\Component;
use Illuminate\Support\Facades\Session;


class DetailProfil extends Component
{
    protected $kabkota;
    protected $proyek;
    public $locale;
    protected $listeners = ['changeLanguange' => 'languageChange'];

    public function changeLanguage($lang)
    {
        Session::put('lang', $lang);
        $this->locale = $lang;
        $this->dispatch('reloadPage');
    }

    public function mount($id)
    {
        $this->kabkota = ProfileKabkota::where('kab_kota_id', $id)->first();
        $this->proyek = ProyekInvestasi::where('status', 1)->where('kab_kota_id', $id)->get();
    }
    public function render()
    {
        if (Session::get('lang')) {
            $this->locale = is_array(Session::get('lang')) ? Session::get('lang')[0] : Session::get('lang');
        } else {
            $this->locale = 'id';
        }

        $profil = $this->kabkota;
        $proyeks = $this->proyek;
        return view('livewire.profil.detail-profil', compact('proyeks', 'profil'), ['locale' => $this->locale]);
    }
}
