<?php

namespace App\Livewire\Frontend\Kemitraan\Minat;

use App\Models\Kemitraan\PeminatProduct;
use App\Models\Kemitraan\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Livewire\Component;

class MinatMasuk extends Component
{
    public function render()
    {
        $peminatMasuk = collect();
        $minatMasuk = Product::where('user_id', Auth::user()->id)->get();
        foreach ($minatMasuk as $value) {
            $peminat = PeminatProduct::with('product', 'userPeminat')->where('product_id', $value->id)->get();
            $peminatMasuk = $peminatMasuk->merge($peminat);
        }
        return view('livewire.frontend.kemitraan.minat.minat-masuk', [
            'peminatMasuk' => $peminatMasuk
        ])->layout('components.layouts.master');
    }
    public function logout()
    {
        Auth::logout();

        return Redirect::to('/');
    }
}
