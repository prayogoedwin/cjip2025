<?php

namespace App\Livewire\Proyek;

use App\Models\Cjip\Market;
use App\Models\Cjip\ProyekInvestasi;
use Livewire\Component;
use Illuminate\Support\Facades\Session;
use Livewire\WithPagination;

class Kesiapan extends Component
{

    use WithPagination;

    protected $paginationTheme = 'tailwind';

    protected $proyeks;
    public $flags, $flagSelected;
    public $marketPlace;
    public $marketPlaces;
    public $active;
    public $query = '';
    public $searchs;
    public $highlightIndex = 0;
    public $locale;

    protected $listeners = ['languageChange' => 'changeLanguange'];
    //    protected $listeners = ['refresh' => '$refresh'];


    public function changeLanguange($lang)
    {
        //dd($lang);
        $this->locale = $lang['lang'];
    }

    public function mount($selectedCategory = 1)
    {
        //dd(Session::all());

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

        // dd($this->locale);
        $this->marketPlace = $selectedCategory;
        $this->reset(['query', 'searchs', 'highlightIndex']);
    }


    public function updateMarket($value)
    {

        $this->marketPlace = $value;
        $this->active = $value;
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
        $proyek = $this->searchs[$this->highlightIndex] ?? null;
        if ($proyek) {
            $this->redirect(route('detail_investasi', $proyek['id']));
        }
    }

    public function updatedQuery()
    {
        $this->searchs = ProyekInvestasi::with(['sektor', 'kabkota'])
            ->where('status', 1)
            ->where('nama', 'like', '%' . $this->query . '%')
            ->orWhereHas('sektor', function ($q) {
                $q->where('nama', 'like', '%' . $this->query . '%');
            })
            ->orWhereHas('kabkota', function ($r) {
                $r->where('nama', 'like', '%' . $this->query . '%');
            })
            ->simplePaginate(20);
        // dd($this->searchs);
    }
    public function render()
    {
        $jenis_marketplaces = Market::all();

        $this->proyeks = ProyekInvestasi::where('status', 1)->orderBy('id', 'DESC')
            ->where('market_id', $this->marketPlace)->paginate(9);

        /*$qconfig = Config::where('nama', 'seo_kesiapan')->first();

        $config = json_decode($qconfig->detail);*/

        $proyeks = $this->proyeks;

        $searchs = $this->searchs;
        if ($this->active == null) {
            $acti = 1;
        } else {
            $acti = $this->active;
        }
        return view('livewire.proyek.kesiapan', compact('jenis_marketplaces', 'proyeks', 'searchs', 'acti'));
    }
}
