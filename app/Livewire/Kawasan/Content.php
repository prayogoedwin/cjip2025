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
        'languageChanged' => '$refresh',  // Optional: Refresh if any changes in language require reactivity
    ];

    // Handle language change
    public function changeLanguage($lang)
    {
        $this->locale = $lang['lang'];
        Session::put('lang', $this->locale);
        $this->resetPage();  // Reset pagination when language changes
        $this->cariKawasans();
    }

    // Search KawasanIndustri based on the search query
    public function cariKawasans()
    {
        $this->kawasans = KawasanIndustri::query()
            ->where('status', 1)
            ->where('nama', 'like', '%' . $this->search . '%')
            ->paginate(9);  // Paginate results
    }

    // Reactively update the search query and reset pagination
    public function updatedSearch()
    {
        $this->resetPage();  // Reset pagination when the search query changes
        $this->cariKawasans();
    }

    // Render the component
    public function render()
    {
        // Get the locale from session or default to 'id'
        $this->locale = Session::get('lang', 'id');

        // Paginate results if not set
        if (!$this->kawasans) {
            $this->cariKawasans(); // Trigger search if not loaded
        }

        return view('livewire.kawasan.content', ['kawasans' => $this->kawasans]);
    }
}
