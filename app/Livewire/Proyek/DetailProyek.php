<?php

namespace App\Livewire\Proyek;

use App\Models\Cjip\ProyekInvestasi;
use Livewire\Component;
use Illuminate\Support\Facades\Session;


class DetailProyek extends Component
{

    public $proyek_id;
    protected $proyek;
    public $nama;
    public $locale;
    public $query = '';
    public $col;
    public $name;
    public $lokasi;

    // protected $listeners = ['changeLanguange' => 'languageChange'];
    protected $listeners = ['changeLanguange' => 'languageChange'];

    public function languageChange($lang)
    {
        //dd($lang);
        $this->locale = $lang['lang'];
    }

    public function mount($id)
    {
        $this->proyek = ProyekInvestasi::findOrFail($id);
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

        $proyek = $this->proyek;
        // $proyek->nama = $proyek->nama;

        // dd($proyek->nama);
        // $proyek->location = $proyek->getCoordinates();
        //$proyek->luas_lahan = json_decode($proyek->luas_lahan);
        //dd($proyek->luas_lahan);
        $col = [];
        if (strlen($proyek->latar_belakang) > 0) {
            array_push($col, 1);
        }
        if (strlen($proyek->eksisting) > 0) {
            array_push($col, 1);
        }
        if (strlen($proyek->lingkup_pekerjaan) > 0) {
            array_push($col, 1);
        }
        if (strlen($proyek->desain_layout_proyek) > 0) {
            array_push($col, 1);
        }
        if (strlen($proyek->ketersediaan_pasar) > 0) {
            array_push($col, 1);
        }
        if (strlen($proyek->ketersediaan_sd) > 0) {
            array_push($col, 1);
        }
        if (strlen($proyek->skema_investasi) > 0) {
            array_push($col, 1);
        }
        if (strlen($proyek->rincian_investasi) > 0) {
            array_push($col, 1);
        }
        $tot = count($col);

        // $proyek->lokasi = $proyek->lokasi;
        $lokasi = $proyek->lokasi;
        $name = $proyek->name;

        return view('livewire.proyek.detail-proyek', compact('proyek', 'tot'));
    }
}
