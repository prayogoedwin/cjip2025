<?php

namespace App\Livewire\Frontend\Sinida;

use Livewire\Component;

class SuratPengajuan extends Component
{
    public function render()
    {
        return view('livewire.frontend.sinida.surat-pengajuan')->layout('components.layouts.master');
    }
}
