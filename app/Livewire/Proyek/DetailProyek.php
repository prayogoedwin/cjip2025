<?php

namespace App\Livewire\Proyek;

use App\Models\Cjip\ProyekInvestasi;
use App\Models\Sidikaryo\SidikaryoPencaker;
use App\Models\Sidikaryo\SidikaryoDapodik;
use Livewire\Component;
use Illuminate\Support\Facades\Session;

class DetailProyek extends Component
{
    // Hapus properti yang tidak perlu atau duplikat
    public ProyekInvestasi $proyek; // Gunakan type-hinting untuk properti model, lebih bersih
    public $locale;
    public $query = '';
    public $col;
    public $name;
    public $lokasi;
    public $pencakers;
    public $total_potensi;

    // Listener tidak perlu diubah
    protected $listeners = ['changeLanguange' => 'languageChange'];

    public function languageChange($lang)
    {
        $this->locale = $lang['lang'];
        Session::put('lang', $this->locale); // Simpan ke session agar konsisten
    }

    /**
     * Mount method diubah untuk menerima $slug dan mencari berdasarkan itu.
     */
    public function mount($slug)
    {
        // Tetapkan locale terlebih dahulu
        $this->locale = Session::get('lang', 'id');

        // Cari proyek berdasarkan slug yang sesuai dengan bahasa aktif
        $this->proyek = ProyekInvestasi::where('slug->' . $this->locale, $slug)->firstOrFail();

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

        $potensi_lulus_topjur = $this->potensi_lulus
            ->groupBy('jurusan')
            ->keys() // Ambil hanya nama-nama jurusan
            ->take(5);

        // Menyimpan hasil
        $this->total_potensi = $total;

        $this->top_jurusan = $potensi_lulus_topjur;
    }

    /**
     * Render method disederhanakan.
     */
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
        if (!empty($this->proyek->getTranslation('latar_belakang', $this->locale))) array_push($col, 1);
        if (!empty($this->proyek->getTranslation('eksisting', $this->locale))) array_push($col, 1);
        if (!empty($this->proyek->getTranslation('lingkup_pekerjaan', $this->locale))) array_push($col, 1);
        if (!empty($this->proyek->getTranslation('desain_layout_proyek', $this->locale))) array_push($col, 1);
        if (!empty($this->proyek->getTranslation('ketersediaan_pasar', $this->locale))) array_push($col, 1);
        if (!empty($this->proyek->getTranslation('ketersediaan_sd', $this->locale))) array_push($col, 1);
        if (!empty($this->proyek->getTranslation('skema_investasi', $this->locale))) array_push($col, 1);
        if (!empty($this->proyek->getTranslation('rincian_investasi', $this->locale))) array_push($col, 1);

        $tot = count($col);
        // $proyek->lokasi = $proyek->lokasi;
        $lokasi = $proyek->lokasi;
        $name = $proyek->name;


        return view('livewire.proyek.detail-proyek', compact('proyek', 'tot', 'pencaker', 'potensi_lulus', 'potensi_lulus_topjur'));
    }
}
