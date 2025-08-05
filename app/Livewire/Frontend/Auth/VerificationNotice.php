<?php

namespace App\Livewire\Frontend\Auth;

use Livewire\Component;
use Illuminate\Http\Request;

class VerificationNotice extends Component
{
    public function resendVerificationEmail(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->route('dashboard.investor');
        }

        $request->user()->sendEmailVerificationNotification();

        session()->flash('status', 'Link verifikasi baru telah dikirim ke alamat email Anda.');
    }

    public function render()
    {
        return view('livewire.auth.verification-notice')
            ->layout('components.layouts.login');
    }
}
