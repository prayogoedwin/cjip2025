<?php

namespace App\Livewire\Cjibf;

use App\Settings\CjibfSettings;
use Livewire\Component;

class Dashboard extends Component
{

    protected $cjibf;

    public function mount(CjibfSettings $cjibfSettings)
    {
        $this->cjibf = $cjibfSettings;
    }

    public function render()
    {
        $cjibf = $this->cjibf;
        return view('livewire.cjibf.dashboard', compact('cjibf'));
    }
}
