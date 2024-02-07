<?php

namespace App\Livewire\Kawasan;

use App\Models\Cjip\KawasanIndustri;
use Illuminate\Support\Facades\Session;
use Livewire\WithPagination;
use Livewire\Component;

class DetailKawasan extends Component
{

    use WithPagination;

    protected $kawasan, $tenant;
    protected $kawasans;
    public $locale;
    public $lokasi;

    protected $listeners = ['changeLanguange' => 'languageChange'];

    public function languageChange($lang)
    {
        //dd($lang);
        $this->locale = $lang['lang'];
    }

    public function mount($id)
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

        $this->kawasan = KawasanIndustri::findOrFail($id);

        $this->tenant = KawasanIndustri::findOrFail($id)->tenant;

        // dd($this->tenant);
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
