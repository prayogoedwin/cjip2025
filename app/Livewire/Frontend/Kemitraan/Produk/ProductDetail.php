<?php

namespace App\Livewire\Frontend\Kemitraan\Produk;

use App\Models\Kemitraan\PeminatProduct;
use App\Models\Kemitraan\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Livewire\Component;

class ProductDetail extends Component
{
    public $product;
    public $imageProduct;
    public $show = true;
    public $imageMain;
    public $title;
    public $showAcc = false;
    public $isOwner = false;
    public function mount($slug)
    {
        $this->product = Product::where('slug', $slug)->first();
        $this->title = 'Detail Produk ' . $this->product->name;
        $this->imageProduct = $this->product->galleryProduct->pluck('image')->flatten()->toArray();

        // dd($this->imageProduct);

        // Check if the current user is the owner of the product
        $this->isOwner = $this->product->user_id == Auth::user()->id;

        // Check if the current user is interested in the product
        $data = PeminatProduct::where('peminat_id', Auth::user()->id)
            ->where('product_id', $this->product->id)
            ->where('status', 0)
            ->first();
        if ($data) {
            $this->show = false;
            $this->showAcc = true;
        }
    }

    public function changeImage($image)
    {
        $this->imageMain = $image;
    }
    public function minatProduct($id)
    {
        PeminatProduct::create([
            'peminat_id' => Auth::user()->id,
            'product_id' => $id
        ]);

        $this->show = false;
        session()->flash('message', 'Terima kasih, Keminatan Anda Dengan Produk Ini Sedang Di Proses');
    }
    public function logout()
    {
        Auth::logout();

        return Redirect::to('/');
    }
    public function render()
    {
        return view('livewire.frontend.kemitraan.produk.product-detail')->layout('components.layouts.master');
    }
}
