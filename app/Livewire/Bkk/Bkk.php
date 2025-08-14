<?php

namespace App\Livewire\Bkk;

use Livewire\Component;
use Illuminate\Support\Facades\Session;
use App\Models\Sidikaryo\SidikaryoBkk;
use App\Models\BridgingKabkota;


class Bkk extends Component
{
    public $locale;

    protected $listeners = [
        'languageChange' => 'changeLanguage',
        'languageChanged' => '$refresh', // Refresh komponen setelah bahasa diubah
    ];

    public function changeLanguage($lang)
    {
        $this->locale = $lang['lang'];

        // Mengatur bahasa di sesi
        Session::put('lang', $this->locale);

        // Emit event untuk melakukan reload atau refresh halaman
        $this->emit('languageChanged');
    }

    public $kabkota; // Tambahkan property untuk menyimpan nilai kabkota

    public function mount($kabkota = null)
    {
        $this->kabkota = $kabkota;
        
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

        $nama_kota = null;
        if ($this->kabkota) {
            $kota = BridgingKabkota::where('kabkota_id', $this->kabkota)->first();
            $nama_kota = $kota ? $kota->nama_kota : 'Unknown';
        }

        return view('livewire.bkk.bkk', [
            'kabkota' => $this->kabkota, // Teruskan parameter ke view
            'namaKota'=> $nama_kota
        ]);
    }
}
