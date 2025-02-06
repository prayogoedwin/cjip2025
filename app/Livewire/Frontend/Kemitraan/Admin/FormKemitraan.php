<?php

namespace App\Livewire\Frontend\Kemitraan\Admin;

use App\Models\Kemitraan\PeminatProduct;
use Livewire\Component;

class FormKemitraan extends Component
{
    public $record;
    public function mount(PeminatProduct $record)
    {
        $this->record = $record;
    }
    public function render()
    {
        return view('livewire.frontend.kemitraan.admin.form-kemitraan')->layout('components.layouts.surat');
    }
}
