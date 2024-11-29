<?php

namespace App\Livewire\Kawasan;

use App\Models\Cjip\KawasanIndustri;
use Illuminate\Support\Facades\Session;
use Livewire\WithPagination;
use Livewire\Component;

class Content extends Component
{
    use WithPagination;
    public $search = '';
    public $locale;
    protected $kawasans;

    protected $listeners = [
        'languageChange' => 'changeLanguage',
        'cariKawasans' => 'cariKawasans',
        'languageChanged' => '$refresh',
    ];

    public function changeLanguage($lang)
    {
        $this->locale = $lang['lang'];
        Session::put('lang', $this->locale);
        $this->resetPage();
        $this->cariKawasans();
    }

    public function cariKawasans()
    {
        $this->kawasans = KawasanIndustri::query()
            ->where('status', 1)
            ->where('nama', 'like', '%' . $this->search . '%')
            ->paginate(9);
    }

    public function updatedSearch()
    {
        $this->resetPage();
        $this->cariKawasans();
    }

    public function render()
    {
        $this->locale = Session::get('lang', 'id');
        if (!$this->kawasans) {
            $this->cariKawasans();
        }
        return view('livewire.kawasan.content', ['kawasans' => $this->kawasans]);
    }
}
