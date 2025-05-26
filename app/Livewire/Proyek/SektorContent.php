<?php

namespace App\Livewire\Proyek;

use App\Models\Cjip\Market;
use App\Models\Cjip\ProyekInvestasi;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Session;

class SektorContent extends Component
{
    use WithPagination;
    protected $proyeks;
    public $marketPlace;
    public $marketPlaces;
    public $query = '';

    public $active, $locale;
    public $searchs;
    public $highlightIndex = 0;

    public $acti, $search = '';

    protected $listeners = [
        'languageChange' => 'changeLanguage',
        'languageChanged' => '$refresh',
    ];

    public function changeLanguage($lang)
    {
        $this->locale = $lang['lang'];

        Session::put('lang', $this->locale);

        $this->emit('languageChanged');
    }

    // public function mount($selectedCategory = 18)
    // {

    //     $this->marketPlace = $selectedCategory;
    //     $this->reset(['query', 'searchs', 'highlightIndex']);
    // }

    public function cariProyeks()
    {
        $this->proyeks = ProyekInvestasi::where(function ($query) {
            $query->where('nama', 'like', '%' . $this->search . '%')
                ->orWhereHas('kabkota', function ($subQuery) {
                    $subQuery->where('nama', 'like', '%' . $this->search . '%');
                })
                ->orWhereHas('sektor', function ($subQuery) {
                    $subQuery->where('nama', 'like', '%' . $this->search . '%');
                });
        })
            ->where('status', 1)
            // ->where('is_cjibf', 1)
            ->where('sektor_id', $this->marketPlace)
            ->orderBy('id', 'desc')
            ->paginate(6);
    }

     public function updatedSearch()
    {
        $this->cariProyeks();
    }

    public function updateMarket($id)
    {
        $this->marketPlace = $id;
        $this->acti = $id;
        $this->resetPage();
        $this->cariProyeks();
        $this->active = $id;
    }

     public function mount($selectedCategory = 18)
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

        $this->marketPlace = $selectedCategory;
        $this->acti = $selectedCategory;
        $this->cariProyeks();
    }

    public function updatedQuery()
    {
        $this->searchs = ProyekInvestasi::with(['sektor', 'kabKota'])
            ->where('status', 1)
            ->where('nama', 'like', '%' . $this->query . '%')
            ->orWhereHas('sektor', function ($q) {
                $q->where('nama', 'like', '%' . $this->query . '%');
            })
            ->orWhereHas('kabKota', function ($r) {
                $r->where('nama', 'like', '%' . $this->query . '%');
            })
            ->simplePaginate(15);
        // dd($this->searchs);
    }

    public function render()
    {
        if (Session::get('lang')) {
            // dd(Session::get('lang'));
            if (is_array(Session::get('lang'))) {
                $this->locale = Session::get('lang')[0];
            } else {
                $this->locale = Session::get('lang');
            }
            // dd($this->locale);
        } else {
            $this->locale = 'id';
        }

         $jenis_marketplaces = Market::all();

        $proyeks = ProyekInvestasi::where(function ($query) {
            $query->where('nama', 'like', '%' . $this->search . '%')
                ->orWhereHas('kabkota', function ($subQuery) {
                    $subQuery->where('nama', 'like', '%' . $this->search . '%');
                })
                ->orWhereHas('sektor', function ($subQuery) {
                    $subQuery->where('nama', 'like', '%' . $this->search . '%');
                });
        })
            ->where('status', 1)
            ->where('sektor_id', $this->marketPlace)
            ->orderBy('id', 'desc')
            ->paginate(6);

        return view('livewire.proyek.sektor-content', compact('jenis_marketplaces', 'proyeks'));
    }
}
