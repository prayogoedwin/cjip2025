<?php

namespace App\Livewire\Beranda;

use App\Models\Cjip\PerformaInvestasi;
use App\Models\Cjip\PertumbuhanEkonomi;
use App\Settings\GeneralSettings;
use Livewire\Component;
use Illuminate\Support\Facades\Session;


class Grafik extends Component
{
    public $pert_ekonomi;
    public $perf_investasi;
    protected $graph;
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
    public function render(GeneralSettings $generalSettings)
    {
        $this->graph = $generalSettings;
        $pert_ekonomi = PertumbuhanEkonomi::latest()->limit(10)->get();

        if ($pert_ekonomi->count() != 0) {
            foreach ($pert_ekonomi as $item) {
                $data['label'][] = $item->tahun;
                $data['data'][] = $item->pertumbuhan_jateng;
                $data['data1'][] = $item->pertumbuhan_nasional;
            }
            $this->pert_ekonomi = json_encode($data);
        }

        $perf_investasi = PerformaInvestasi::latest()->limit(10)->get();
        if ($perf_investasi->count() != 0) {
            foreach ($perf_investasi as $a) {
                $data1['label'][] = $a->tahun;
                $data1['item'][] = $a->target;
                $data1['item1'][] = $a->realisasi;
            }
            $this->perf_investasi = json_encode($data1);
        }

        if (Session::get('lang')) {
            if (is_array(Session::get('lang'))) {
                $this->locale = Session::get('lang')[0];
            } else {
                $this->locale = Session::get('lang');
            }
        } else {
            $this->locale = 'id';
        }

        $this->profil = $generalSettings;
        $profil = $this->profil;

        $graph = $this->graph;
        return view('livewire.beranda.grafik', compact('graph', 'profil'));
    }
}
