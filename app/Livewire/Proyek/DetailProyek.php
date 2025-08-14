<?php

namespace App\Livewire\Proyek;

use App\Models\Cjip\ProyekInvestasi;
use Livewire\Component;
use Illuminate\Support\Facades\Session;

class DetailProyek extends Component
{
    // Hapus properti yang tidak perlu atau duplikat
    public ProyekInvestasi $proyek; // Gunakan type-hinting untuk properti model, lebih bersih
    public $locale;
    public $tot;

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
    }

    /**
     * Render method disederhanakan.
     */
    public function render()
    {
        // Logika untuk menghitung kolom yang terisi
        $col = [];
        if (!empty($this->proyek->getTranslation('latar_belakang', $this->locale))) array_push($col, 1);
        if (!empty($this->proyek->getTranslation('eksisting', $this->locale))) array_push($col, 1);
        if (!empty($this->proyek->getTranslation('lingkup_pekerjaan', $this->locale))) array_push($col, 1);
        if (!empty($this->proyek->getTranslation('desain_layout_proyek', $this->locale))) array_push($col, 1);
        if (!empty($this->proyek->getTranslation('ketersediaan_pasar', $this->locale))) array_push($col, 1);
        if (!empty($this->proyek->getTranslation('ketersediaan_sd', $this->locale))) array_push($col, 1);
        if (!empty($this->proyek->getTranslation('skema_investasi', $this->locale))) array_push($col, 1);
        if (!empty($this->proyek->getTranslation('rincian_investasi', $this->locale))) array_push($col, 1);

        $this->tot = count($col);

        // Kirim properti langsung ke view
        return view('livewire.proyek.detail-proyek', [
            'proyek' => $this->proyek,
            'tot' => $this->tot,
        ]);
    }
}
