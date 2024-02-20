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

    protected $listeners = ['languageChange' => 'changeLanguange'];
    //protected $listeners = ['refresh' => '$refresh'];

    public function changeLanguange($lang)
    {
        //dd($lang);
        $this->locale = $lang['lang'];
    }

    public function mount($selectedCategory = 18)
    {

        $this->marketPlace = $selectedCategory;
        $this->reset(['query', 'searchs', 'highlightIndex']);
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
            $this->redirect(route('show-proyek', $proyek['id']));
        }
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
    public function updateMarket($value)
    {
        //dd($value);
        $this->marketPlace = $value;
        $this->active = $value;
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

        // dd($this->marketPlace);

        if ($this->marketPlace == 0) {
            $this->proyeks = ProyekInvestasi::where('status', 1)->orderBy('id', 'DESC')->paginate(9);
        } else {
            $this->proyeks = ProyekInvestasi::where('status', 1)
                ->where('sektor_id', $this->marketPlace)->orderBy('id', 'DESC')->paginate(9);
        }

        // $qconfig = Config::where('nama', 'seo_sektor')->first();
        // $config = json_decode($qconfig->detail);

        $proyeks = $this->proyeks;
        $searchs = $this->searchs;
        if ($this->active == null) {
            $acti = 18;
        } else {
            $acti = $this->active;
        }

        return view('livewire.proyek.sektor-content', compact('jenis_marketplaces', 'proyeks', 'searchs', 'acti', ));
    }
}
