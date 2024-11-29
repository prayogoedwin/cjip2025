<?php

namespace App\Livewire\Kawasan;

use App\Models\Cjip\KawasanIndustri;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Content extends Component
{
    protected $kawasans;
    public $search = '';
    public $locale;

    protected $listeners = [
        'languageChange' => 'changeLanguange',
        'cariKawasans' => 'cariKawasans',
        'languageChanged' => '$refresh',
    ];

    public function changeLanguange($lang)
    {
        $this->locale = $lang['lang'];
        Session::put('lang', $this->locale);
        $this->emit('languageChanged');
        $this->cariKawasans();
    }

    public function cariKawasans()
    {
        $this->kawasans = KawasanIndustri::where(function ($query) {
            $query->where('nama', 'like', '%' . $this->search . '%');
        })
            ->where('status', 1)
            ->paginate(9);
    }

    public function updatedSearch()
    {
        $this->cariKawasans();
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
        $kawasans = KawasanIndustri::where('nama', 'like', '%' . $this->search . '%')
            ->where('status', 1)
            ->paginate(9);

        return view('livewire.kawasan.content', ['kawasans' => $kawasans]);
    }
}
