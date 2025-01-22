<?php

namespace App\Livewire\Frontend\Kemitraan\Minat;

use App\Models\Kemitraan\PeminatProduct;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class MinatKeluar extends Component
{
    public function render()
    {
        $peminatKeluar = PeminatProduct::where('peminat_id', Auth::user()->id)->with('product')->get();
        return view('livewire.frontend.kemitraan.minat.minat-keluar', [
            'peminatKeluar' => $peminatKeluar
        ])->layout('components.layouts.master');
    }
}
