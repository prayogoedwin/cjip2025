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

    // protected $listeners = ['changeLanguange' => 'languageChange'];
    protected $listeners = ['changeLanguange' => 'languageChange'];

    public function languageChange($lang)
    {
        //dd($lang);
        $this->locale = $lang['lang'];
    }

    public function mount($id)
    {

        $this->kabkota = ProfileKabkota::where('kab_kota_id', $id)->first();
        $this->proyek = ProyekInvestasi::where('status', 1)->where('kab_kota_id', $id)->get();
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

        $profil = $this->kabkota;
        // $profil->infrasturktur = json_decode($profil->infrasturktur);
        $proyeks = $this->proyek;
        return view('livewire.profil.detail-profil', compact('proyeks', 'profil'));
    }
}
