<?php

namespace App\Livewire\Frontend\Kemitraan\Minat;

use App\Models\Kemitraan\ComentProduct;
use App\Models\Kemitraan\PeminatProduct;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class DetailMinatMasuk extends Component
{
    public $product;
    public $imageProduct;
    public $show = true;
    public $imageMain;
    public $title;
    public $comment;
    public $statusMinat;

    protected $listeners = ['commentPosted' => '$refresh'];

    public function mount($id)
    {
        $this->product = PeminatProduct::with('product', 'userPeminat')->where('id', $id)->first();
        $this->title = 'Detail Produk ' . $this->product->product->name;
        $this->imageProduct = $this->product->product->galleryProduct;
        $this->statusMinat = $this->product->first();
    }

    public function changeImage($image)
    {
        $this->imageMain = $image;
    }

    public function postComment()
    {
        ComentProduct::create([
            'user_id' => Auth::user()->id,
            'product_id' => $this->product->product->id,
            'comment' => $this->comment
        ]);
        $this->reset('comment');
        $this->emit('commentPosted');
    }
    public function render()
    {
        $comments = ComentProduct::where('product_id', $this->product->product->id)->get();
        return view('livewire.frontend.kemitraan.minat.detail-minat-masuk', [
            'comments' => $comments,
            'jumlahDiskusi' => $comments->count()
        ]);
    }
}
