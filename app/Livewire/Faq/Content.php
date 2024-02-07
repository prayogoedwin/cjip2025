<?php

namespace App\Livewire\Faq;

use App\Models\Cjip\Faq;
use App\Models\Cjip\PrivacyPolicy;
use App\Models\Cjip\Terms;
use App\Settings\GeneralSettings;
use Livewire\Component;
use Illuminate\Support\Facades\Session;


class Content extends Component
{
    protected $services;

    protected $faqs;

    public $locale;

    protected $listeners = ['languageChange' => 'changeLanguange'];
    // protected $listeners = ['refresh' => '$refresh'];

    public function changeLanguange($lang)
    {
        //dd($lang);
        $this->locale = $lang['lang'];
    }
    public function render(GeneralSettings $generalSettings)
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

        $this->faqs = Faq::with('jenisfaqs')->get()->groupBy('jenis_id');
        $faqs = $this->faqs;

        $privacies = PrivacyPolicy::all();

        $this->services = $generalSettings;
        $pelayanan = $this->services;
        return view('livewire.faq.content', compact('faqs', 'privacies', 'pelayanan'));
    }
}
