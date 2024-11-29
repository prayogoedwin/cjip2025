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
        'languageChanged' => '$refresh', // Keep this if you have other listeners that need refreshing after language change
    ];

    // Set language preference and store it in session
    public function changeLanguage($lang)
    {
        $this->locale = $lang['lang'];
        Session::put('lang', $this->locale);
    }

    // Mount the component, fetch the KawasanIndustri and its tenant
    public function mount($id)
    {
        // Set the default language (or use the session if available)
        $this->locale = Session::get('lang', 'id');

        // Fetch KawasanIndustri and its related tenant in a single query
        $this->kawasan = KawasanIndustri::findOrFail($id);

        $this->tenant = KawasanIndustri::findOrFail($id)->tenant;
    }

    // Render the component view
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
