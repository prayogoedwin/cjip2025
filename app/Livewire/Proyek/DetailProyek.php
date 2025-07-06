<?php

namespace App\Livewire\Proyek;

use App\Models\Cjip\ProyekInvestasi;
use App\Models\Sidikaryo\SidikaryoPencaker;
use App\Models\Sidikaryo\SidikaryoDapodik;
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

        // Ambil semua data pencaker yang sesuai dengan kab_kota_id proyek
        $this->pencakers = SidikaryoPencaker::where('cjip_kota_id', $this->proyek->kab_kota_id)
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

            $this->potensi_lulus = SidikaryoDapodik::where('cjip_kota_id', $this->proyek->kab_kota_id)
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

            // Mengambil 5 jurusan yang paling banyak muncul
            // $topJurusan = $this->potensi_lulus
            //     ->groupBy('jurusan')
            //     ->map(function ($item) {
            //         return [
            //             'count' => $item->count(),
            //             'total_potensi' => $item->sum('total_jumlah_potensi'),
            //             'jumlah_laki_laki' => $item->sum('jumlah_laki_laki'),
            //             'jumlah_perempuan' => $item->sum('jumlah_perempuan'),
            //         ];
            //     })
            //     ->sortByDesc('count')
            //     ->take(5);

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
        $pencaker = $this->pencakers->first();
        $potensi_lulus = $this->total_potensi;
        $potensi_lulus_topjur = $this->top_jurusan;
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
    

        return view('livewire.proyek.detail-proyek', compact('proyek', 'tot', 'pencaker', 'potensi_lulus', 'potensi_lulus_topjur'));
    }
}
