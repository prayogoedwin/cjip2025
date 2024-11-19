<?php

namespace App\Livewire\Frontend\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Login extends Component
{
    public $email, $password;
    public $loading = false;
    public $rdr = "";
    public function mount()
    {
        $rdr = request()->query('rdr');
        $this->rdr = $rdr;
        $this->loading = false;
    }

    public function render()
    {
        return view('livewire.frontend.auth.login')->layout('components.layouts.login');
    }

    public function loginAction()
    {
        $this->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'The email field is required.',
            'email.email' => 'Please enter a valid email address.',
            'password.required' => 'The password field is required.',
        ]);

        $this->loading = true;
        // dd($this->rdr);
        if (Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
            if ($this->rdr != "" && $this->rdr === "sinida") {
                return redirect()->route('dashboard.sinida');
            }
            $product = Session::get('product_id');
            if ($product) {
                return redirect()->route('detail.product', $product);
            }
            return redirect()->route('dashboard.investor');
        } else {
            session()->flash('error', 'Invalid email or password.');
        }
        $this->loading = false;
    }
}
