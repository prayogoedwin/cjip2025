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

    public function mount($kabkota = null)
    {
        $this->kabkota = $kabkota;
        $this->loadBkkData();
    }

    public function loadBkkData()
    {
        $query = SidikaryoBkk::query();
        
        if ($this->kabkota) {
            $query->where('id_kota', $this->kabkota);
        }
        
        $this->bkkData = $query->get([
            'nama_sekolah',
            'nama_bkk',
            'id_kota',
            'telpon',
            'hp',
            'email',
            'website',
            'contact_person',
            'jabatan',
            'alamat'
        ]);
    }


    public function changeLanguage($lang)
    {
        $this->locale = $lang['lang'];

        // Mengatur bahasa di sesi
        Session::put('lang', $this->locale);

        // Emit event untuk melakukan reload atau refresh halaman
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

        // Get kabupaten/kota name if kabkota_id exists
        $nama_kota = null;
        if ($this->kabkota) {
            $kota = BridgingKabkota::where('kabkota_id', $this->kabkota)->first();
            $nama_kota = $kota ? $kota->nama_kota : 'Unknown';
        }

        $this->loadBkkData(); // Pastikan data di-load sebelum render
        return view('livewire.bkk.bkk', [
            'bkkData' => $this->bkkData, // Explicitly pass the variable
            'namaKota' => $nama_kota // Pass nama kota to view
        ]);
    }
}
