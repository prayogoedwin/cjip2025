<?php

namespace App\Livewire\Berita;

use App\Models\Cjip\Berita;
use Livewire\Component;
use Illuminate\Support\Facades\Session;
use Livewire\WithPagination;


class Content extends Component
{
    use WithPagination;

    protected $beritas;
    public $query = '';
    protected $searchs;
    public $highlightIndex = 0, $locale, $tagline, $featured;



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
        $berita = $this->searchs[$this->highlightIndex] ?? null;
        if ($berita) {
            $this->redirect(route('detail.berita', $berita['slug']));
        }
    }

    public function updatedQuery()
    {
        $this->searchs = Berita::where('title', 'like', '%' . $this->query . '%')
            ->orWhere('body', 'like', '%' . $this->query . '%')
            ->simplePaginate(5);
        //dd($this->searchs);
    }

    public function render()
    {
        $tagline = [];
        $this->beritas = Berita::first()->orderBy('created_at', 'DESC')->where('status', '1')->paginate(9);
        $this->tagline = Berita::offset(0)->limit(3)->orderBy('id', 'DESC')->where('status', '1')->where('featured', 0)->get();
        $this->featured = Berita::where('featured', 1)->orderBy('id', 'DESC')->where('status', '1')->get();

        $beritas = $this->beritas;

        foreach ($this->featured as $data) {
            array_push($tagline, $data);
        }
        if (count($tagline) < 3) {
            foreach ($this->tagline as $datas) {
                array_push($tagline, $datas);
            }
        }
        return view('livewire.berita.content', compact('beritas', 'tagline'));
    }
}
