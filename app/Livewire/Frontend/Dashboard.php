<?php

namespace App\Livewire\Frontend;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Livewire\Component;

class Dashboard extends Component
{
    public function logout()
    {
        Auth::logout();

        return Redirect::to('/');
    }
    public function render()
    {
        return view('livewire.frontend.dashboard-pilihan')->layout('components.layouts.master');
    }
}
