<?php

namespace App\Livewire\Frontend\Kemitraan\Produk;

use App\Models\Kemitraan\Product;
use Livewire\Component;

class ProductList extends Component
{
    public $locale, $search;
    protected $products;

    public function cariProduct()
    {
        $this->products = Product::where('name', 'like', '%' . $this->search . '%')
            ->where('is_active', 1)->orderBy('created_at', 'desc')->paginate(12);
    }
    public function mount()
    {
        $this->products = Product::where('is_active', 1)->orderBy('created_at', 'desc')->paginate(12);
    }
    public function render()
    {
        if (!$this->products) {
            $this->products = Product::where('is_active', 1)->orderBy('created_at', 'desc')->paginate(12);
        }
        $products = $this->products;
        return view('livewire.frontend.kemitraan.produk.product-list', compact('products'))->layout('components.layouts.master');
    }
}
