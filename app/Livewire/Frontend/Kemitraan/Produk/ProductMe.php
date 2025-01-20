<?php

namespace App\Livewire\Frontend\Kemitraan\Produk;

use App\Models\Kemitraan\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Livewire\Component;
use Livewire\WithPagination;

class ProductMe extends Component
{
    use WithPagination;
    public $title = 'Produk Saya';
    public function logout()
    {
        Auth::logout();

        return Redirect::to('/');
    }
    public function render()
    {
        $product = Product::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->paginate(6);
        return view('livewire.frontend.kemitraan.produk.product-me', [
            'products' => $product
        ])->layout('components.layouts.master');
    }
}
