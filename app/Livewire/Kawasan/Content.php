<?php

namespace App\Livewire\Kawasan;

use App\Models\Cjip\KawasanIndustri;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Content extends Component
{
    protected $kawasanindustris;
    public $query = '';
    protected $searchs;
    public $highlightIndex = 0;

    public $locale, $marketPlace;

    protected $listeners = ['languageChange' => 'changeLanguange'];
    // protected $listeners = ['refresh' => '$refresh'];

    public function changeLanguange($lang)
    {
        //dd($lang);
        $this->locale = $lang['lang'];
    }

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

        // $this->reset(['query', 'searchs', 'highlightIndex']);
    }

    public function incrementHighlight()
    {
        if ($this->highlightIndex === count($this->searchs) - 1) {
            $this->highlightIndex = 0;
            return;
        }
        $this->highlightIndex++;
    }

    public function decrementHighlight()
    {
        if ($this->highlightIndex === 0) {
            $this->highlightIndex = count($this->searchs) - 1;
            return;
        }
        $this->highlightIndex--;
    }

    public function selectContact()
    {
        $kawasan = $this->searchs[$this->highlightIndex] ?? null;
        if ($kawasan) {
            $this->redirect(route('detail.ki', $kawasan['id']));
        }
    }

    public function updatedQuery()
    {
        $this->searchs = KawasanIndustri::where('nama_kawasan_industri', 'like', '%' . $this->query . '%')
            ->simplePaginate(5);
        //dd($this->searchs);
    }
    public function updateMarket($value)
    {
        //dd($value);
        $this->marketPlace = $value;
    }
    public function render()
    {

        if ($locale = session('locale')) {
            app()->setLocale($locale);
        }

        $this->kawasanindustris = KawasanIndustri::where('status', '1')->paginate(9);
        // $this->beritas = InvestasiKawasanIndustri::first()->where('status', '1')->paginate(6);
        $kawasans = $this->kawasanindustris;
        return view('livewire.kawasan.content', compact('kawasans'));
    }
}
