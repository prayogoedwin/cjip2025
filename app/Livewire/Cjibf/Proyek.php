<?php

namespace App\Livewire\Cjibf;

use App\Models\Cjip\Market;
use App\Models\Cjip\ProyekInvestasi;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Livewire\WithPagination;

class Proyek extends Component
{
    use WithPagination;

    public $search = '';
    public $marketPlace;
    public $active;
    protected $proyeks;
    public $searchs = [];
    public $highlightIndex = 0;
    public $locale;
    public $acti;

    protected $listeners = [
        'languageChange' => 'changeLanguange',
        'minatProyek' => 'updateState'
    ];

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
            ->where('is_cjibf', 1)
            ->where('market_id', $this->marketPlace)
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
    }

    public function updateState($id)
    {
        Session::put('id_proyek', $id);
        return redirect()->to('/kepeminatan');
    }
    public function changeLanguange($lang)
    {
        $this->locale = $lang['lang'];
        $this->cariProyeks();
    }

    public function mount($selectedCategory = 1)
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
    public function render()
    {
        $jenis_marketplaces = Market::all();
        return view('livewire.cjibf.proyek',  [
            'jenis_marketplaces' => $jenis_marketplaces,
            'proyeks' => $this->proyeks,
            'acti' => $this->acti,
        ]);
    }
}
