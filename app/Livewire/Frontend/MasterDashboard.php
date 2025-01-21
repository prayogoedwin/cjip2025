<?php

namespace App\Livewire\Frontend;

use Filament\Forms\Concerns\InteractsWithForms;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class MasterDashboard extends Component
{

    use InteractsWithForms;
    
    public ?array $data = [];

    public function logout()
    {
        Auth::logout();

        return Redirect::to('/');
    }
    public function render()
    {
        return view('livewire.frontend.master-dashboard')->layout('components.layouts.master');
    }
}
