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

    protected $listeners = ['languageChange' => 'changeLanguange'];

    public function mount()
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
    }
    public function cariKawasans()
    {
        $this->kawasans = KawasanIndustri::where(function ($query) {
            $query->where('nama', 'like', '%' . $this->search . '%');
        })
            ->where('status', 1)
            ->paginate(9);
    }

    public function changeLanguange($lang)
    {
        $this->locale = $lang['lang'];
        $this->cariKawasans();
    }

    public function updatedSearch()
    {
        $this->cariKawasans();
    }

    public function render()
    {
        $kawasans = KawasanIndustri::where('nama', 'like', '%' . $this->search . '%')
            ->where('status', 1)
            ->paginate(9);

        return view('livewire.kawasan.content', ['kawasans' => $kawasans]);
    }
}
