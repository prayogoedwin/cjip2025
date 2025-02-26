<?php

namespace App\Livewire\Frontend\Kemitraan\Produk;

use App\Models\Kemitraan\PeminatProduct;
use App\Models\Kemitraan\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class DetailProduct extends Component
{
    public $product;
    public $imageProduct;
    public $show = true;
    public $imageMain;
    public $showAcc = false;
    public $isOwner = false;

    public function mount($slug)
    {
        $this->product = Product::where('slug', $slug)->first();
        $this->imageProduct = $this->product->galleryProduct->pluck('image')->flatten()->toArray();
        if (Auth::check()) {
            $data = PeminatProduct::where('peminat_id', Auth::user()->id)
                ->where('product_id', $this->product->id)
                ->where('status', 0)
                ->first();
            if ($data) {
                $this->show = false;
                $this->showAcc = true;
            }
        }
    }
    public function changeImage($image)
    {
        $this->imageMain = $image;
    }
    public function minatProduct($id)
    {
        $product = Product::where('id', $id)->first();
        if (!Auth::check()) {
            Session::put('product_id', $product->slug);
            return redirect()->route('login');
        }
        PeminatProduct::create([
            'peminat_id' => Auth::user()->id,
            'product_id' => $id
        ]);
        Session::forget('product_id');
        $this->show = false;
        session()->flash('message', 'Terima kasih, Keminatan Anda Dengan Produk Ini Sedang Di Proses');
    }
    public function render()
    {
        return view('livewire.frontend.kemitraan.produk.detail-product')->layout('components.layouts.master');
    }
}
