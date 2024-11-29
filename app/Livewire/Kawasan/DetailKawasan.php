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

    public function mount($id)
    {
        $this->locale = Session::get('lang', 'id');
        $this->kawasan = KawasanIndustri::findOrFail($id);
        $this->tenant = KawasanIndustri::findOrFail($id)->tenant;
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
