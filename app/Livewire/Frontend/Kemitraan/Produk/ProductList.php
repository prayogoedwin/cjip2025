<?php

namespace App\Livewire\Frontend\Kemitraan\Produk;

use Livewire\Component;

class ProductList extends Component
{
    public function render()
    {
        return view('livewire.frontend.kemitraan.produk.product-list')->layout('components.layouts.master');
    }
}
