<?php

namespace App\Livewire\Frontend\Kemitraan\Minat;

use App\Models\Kemitraan\ComentProduct;
use App\Models\Kemitraan\Product;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class DetailMinatKeluar extends Component
{
    public $product;
    public $imageProduct;
    public $show = true;
    public $imageMain;
    public $title;
    public $comment;

    protected $listeners = ['commentPosted' => '$refresh'];

    public function mount($slug)
    {
        $this->product = Product::with('productMinat')->where('slug', $slug)->first();
        $this->title = 'Detail Produk ' . $this->product->name;
        $this->imageProduct = $this->product->galleryProduct;
    }
    public function changeImage($image)
    {
        $this->imageMain = $image;
    }

    public function postComment()
    {
        ComentProduct::create([
            'user_id' => Auth::user()->id,
            'product_id' => $this->product->id,
            'comment' => $this->comment
        ]);
        $this->reset('comment');
        $this->dispatch('commentPosted');
    }
    public function render()
    {
        $comments = ComentProduct::where('product_id', $this->product->id)->get();
        return view('livewire.frontend.kemitraan.minat.detail-minat-keluar', [
            'comments' => $comments,
            'jumlahDiskusi' => $comments->count()
        ])->layout('components.layouts.master');
    }
}
