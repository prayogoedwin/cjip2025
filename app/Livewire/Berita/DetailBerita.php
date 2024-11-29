<?php

namespace App\Livewire\Berita;

use App\Models\Cjip\Berita;
use Livewire\Component;
use Illuminate\Support\Facades\Session;

class DetailBerita extends Component
{
    protected $berita, $count, $post, $update;
    protected $beritas;

    public $locale, $slug;
    protected $listeners = [
        'languageChange' => 'changeLanguage',
        'languageChanged' => '$refresh',
    ];
    public function changeLanguage($lang)
    {
        $this->locale = $lang['lang'];
        Session::put('lang', $this->locale);
    }

    public function mount($slug)
    {
        $this->slug = $slug;
        if (Session::get('lang')) {
            if (is_array(Session::get('lang'))) {
                $this->locale = Session::get('lang')[0];
            } else {
                $this->locale = Session::get('lang');
            }
        } else {
            $this->locale = 'id';
        }

        //dd($slug);
        $this->berita = Berita::where('slug->' . $this->locale, $this->slug)->first();

        // dd($this->berita);

        // $this->post = Berita::find($slug);

        // $update = ['count' => $this->berita->count + 1,];
        // Berita::where('slug->' . $this->locale, $this->slug)->update($update);

        $this->beritas = Berita::where('status', '1')->inRandomOrder()->take(5)->get();


        // $this->beritas = Berita::where('slug', '!=', $slug)->inRandomOrder()->take(3)->get();
        // $this->berita = Berita::where('slug', $slug);



    }
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
        $this->berita = Berita::where('slug->' . $this->locale, $this->slug)->first();

        $this->beritas = Berita::where('status', '1')->inRandomOrder()->take(5)->get();

        $berita = $this->berita;
        $beritas = $this->beritas;
        return view('livewire.berita.detail-berita', compact('berita', 'beritas'));
    }
}
