<?php

namespace App\Livewire\Frontend\Sinida\Admin;

use App\Models\Sinida\Sinida;
use Livewire\Component;

class SkInsentifKepalaDpm extends Component
{
    public $record;

    public function mount(Sinida $record)
    {
        $this->record = $record;
    }
    public function render()
    {
        return view('livewire.frontend.sinida.admin.sk-insentif-kepala-dpm')->layout('components.layouts.surat');
    }
}
