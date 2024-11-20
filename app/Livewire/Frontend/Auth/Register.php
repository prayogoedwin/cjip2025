<?php

namespace App\Livewire\Frontend\Auth;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Register extends Component
{
    public $locale;

    public $email, $password, $name;
    public $loading = false;
    public function registerStore()
    {
        $this->loading = true;

        // Validasi input
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
        ], [
            'name.required' => 'Name field is required',
            'email.required' => 'Email field is required.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'Email already exists.',
            'password.required' => 'The password field is required.',
        ]);

        $hashedPassword = Hash::make($this->password);

        $role = Role::where('name', 'perusahaan')->first();

        // Buat user baru
        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => $hashedPassword,
        ]);
        $user->syncRoles($role->id);
        session()->flash('message', 'Your registration was successful. Go to the login page.');

        $this->loading = false;
        $this->resetInputFields();
        if (Session::has('product_id')) {
            Auth::attempt(['email' => $this->email, 'password' => $this->password]);
            return redirect()->route('detail.product', Session::get('product_id'));
        } else {
            return redirect()->route('dashboard.investor');
        }
    }
    public function render()
    {
        return view('livewire.frontend.auth.register')->layout('components.layouts.login');
    }
}
