<?php

namespace App\Filament\Pages\Kemitraan;

use App\Models\Kemitraan\ComentProduct;
use App\Models\Kemitraan\PeminatProduct;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;

class DetailMinat extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static bool $shouldRegisterNavigation = false;

    public PeminatProduct $product;
    public $imageProduct, $statusMinat, $jumlahDiskusi, $comments, $comment;
    public $imageMain;

    protected $listeners = ['commentPosted' => '$refresh'];

    public function mount($id)
    {
        $this->product = PeminatProduct::with('product', 'userPeminat')->where('id', $id)->firstOrFail();
        $this->imageProduct = $this->product->product->galleryProduct;

        $this->statusMinat = $this->product;
        $comment = ComentProduct::where('product_id', $this->product->product->id)->get();
        $this->jumlahDiskusi = $comment->count();
        $this->comments = $comment;
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
        $this->dispatch('commentPosted');
    }


    protected static string $view = 'filament.pages.kemitraan.detail-minat';
}
