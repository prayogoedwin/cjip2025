<?php

namespace App\Livewire\Profil;

use App\Models\Cjip\ProfileKabkota;
use App\Models\Cjip\ProyekInvestasi;
use App\Models\Sidikaryo\SidikaryoPencaker;
use App\Models\Sidikaryo\SidikaryoDapodik;
use Livewire\Component;
use Illuminate\Support\Facades\Session;


class DetailProfil extends Component
{
    protected $kabkota;
    protected $proyek;
    public $locale;
    protected $listeners = ['changeLanguange' => 'languageChange'];
    public $pencakers;
    public $total_potensi;

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

        $this->pencakers = SidikaryoPencaker::where('cjip_kota_id', $this->kabkota->kab_kota_id)
            ->select([
                'l',
                'p',
                'lulusan_sma_smk',
                'lulusan_dibawah_sma_smk', 
                'lulusan_sarjana_keatas',
                'jurusan_terbanyak'
            ])
            ->get();
             // Debugging: Cek struktur data yang diambil
            //dd($this->pencakers->first());  

            $this->potensi_lulus = SidikaryoDapodik::where('cjip_kota_id', $this->kabkota->kab_kota_id)
                ->select([
                    'jumlah_laki_laki',
                    'jumlah_perempuan',
                    'total_jumlah_potensi',
                    'jurusan', 
                ])
                ->get();

            // Menghitung total jumlah
            $total = [
                'jumlah_laki_laki' => $this->potensi_lulus->sum('jumlah_laki_laki'),
                'jumlah_perempuan' => $this->potensi_lulus->sum('jumlah_perempuan'),
                'total_jumlah_potensi' => $this->potensi_lulus->sum('total_jumlah_potensi'),
            ];

            $potensi_lulus_topjur = $this->potensi_lulus
                ->groupBy('jurusan')
                ->keys() // Ambil hanya nama-nama jurusan
                ->take(5);

            // Menyimpan hasil
            $this->total_potensi = $total;

            $this->top_jurusan = $potensi_lulus_topjur;
        
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
        $pencaker = $this->pencakers->first();
        $potensi_lulus = $this->total_potensi;
        $potensi_lulus_topjur = $this->top_jurusan;
        return view('livewire.profil.detail-profil', compact('proyeks', 'profil','pencaker', 'potensi_lulus', 'potensi_lulus_topjur'), ['locale' => $this->locale]);
    }
}
