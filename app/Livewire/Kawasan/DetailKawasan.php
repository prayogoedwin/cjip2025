<?php

namespace App\Livewire\Kawasan;

use App\Models\Cjip\KawasanIndustri;
use Illuminate\Support\Facades\Session;
use Livewire\WithPagination;
use Livewire\Component;

class DetailKawasan extends Component
{
    use WithPagination;

    public $locale, $kawasan, $tenant;

    protected $listeners = [
        'languageChange' => 'changeLanguage',
        'languageChanged' => '$refresh',
    ];

    public function changeLanguage($lang)
    {
        $this->locale = $lang['lang'];
        Session::put('lang', $this->locale);
    }

   public function mount($slug) // <-- Terima $slug dari URL
{
    $this->locale = Session::get('lang', 'id');

    // Cari berdasarkan kolom slug yang bisa diterjemahkan
    // Contoh: 'slug->id' atau 'slug->en'
    $this->kawasan = KawasanIndustri::where('slug->' . $this->locale, $slug)->firstOrFail();

    // Ambil relasi dari objek yang sudah ada (lebih efisien)
    $this->tenant = $this->kawasan->tenant;
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
        $data = $this->tenant;
        $kawasan = $this->kawasan;
        return view('livewire.kawasan.detail-kawasan', compact('kawasan', 'data'));
    }
}
