<?php

namespace App\Livewire\Frontend\Kemitraan\Produk;

use App\Models\Kemitraan\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Livewire\Component;
use Livewire\WithPagination;

class ProductAll extends Component
{
    use WithPagination;
    public $title = 'Produk';
    public  $search;
    protected $products;
    public function cariProduct()
    {
        $this->products = Product::where('name', 'like', '%' . $this->search . '%')
            ->where('is_active', 1)->orderBy('id', 'desc')->paginate(6);
    }
    public function logout()
    {
        Auth::logout();

        return Redirect::to('/');
    }
    public function render()
    {
        $userId = Auth::id();
        if (!$this->products) {
            $this->products = Product::where('is_active', 1)->orderBy('created_at', 'desc')->paginate(6);
        }

        $products = $this->products;
        return view('livewire.frontend.kemitraan.produk.product-all', ['products' => $products])->layout('components.layouts.master');
    }
}
