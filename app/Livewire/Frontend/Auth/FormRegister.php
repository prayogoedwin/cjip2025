<?php

namespace App\Livewire\Frontend\Auth;

use App\Models\User;
use DominionSolutions\FilamentCaptcha\Forms\Components\Captcha;
use Filament\Forms\Components\Component;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rules\Password;
use Spatie\Permission\Models\Role;
use Livewire\Component as LivewireComponent;

class FormRegister extends LivewireComponent implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public function mount(): void
    {
        // Pre-fill the form with empty values
        $this->form->fill();
    }

    /**
     * Define the structure of the registration form.
     */
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Nama Lengkap')
                    ->required()
                    ->maxLength(255)
                    ->autofocus(),
                TextInput::make('email')
                    ->label('Email')
                    ->email()
                    ->required()
                    ->maxLength(255)
                    ->unique(table: User::class),
                TextInput::make('password')
                    ->label('Password')
                    ->password()
                    ->helperText('Password must be at least 8 characters long, containing uppercase letters, lowercase letters, numbers, and symbols.')
                    ->required()
                    ->rule(
                        Password::min(8)
                            ->mixedCase()
                            ->numbers()
                            ->symbols()
                    )
                    ->revealable()
                    ->validationAttribute('password'),
                TextInput::make('password_confirmation')
                    ->label('Konfirmasi Password')
                    ->password()
                    ->required()
                    ->revealable()
                    ->same('password')
                    ->validationAttribute('password confirmation'),
                Captcha::make('captcha')
                    ->rules(['captcha'])
                    ->required()
                    ->validationMessages([
                        'captcha'  =>  __('Captcha does not match the image'),
                    ]),
            ])
            ->statePath('data'); // This will store form state in the $data public property
    }

    /**
     * Handle the registration submission.
     */
    public function register()
    {
        // Validate the form data
        $data = $this->form->getState();

        try {
            // Use a transaction to ensure data integrity
            $user = DB::transaction(function () use ($data) {
                $role = Role::where('name', 'perusahaan')->firstOrFail();

                $user = User::create([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'password' => Hash::make($data['password']),
                ]);

                $user->assignRole($role);

                // Send the verification email
                $user->sendEmailVerificationNotification();

                return $user;
            });

            // Log the new user in
            Auth::login($user);

            // Redirect to the verification notice page
            return redirect()->route('verification.notice');

        } catch (\Throwable $e) {
            // You can log the error or show a generic error message
            if (app()->environment('local')) {
                // If in a local environment, flash the actual exception message.
                session()->flash('error', 'Error: ' . $e->getMessage());
            } else {
                // In production, show a generic error message for security.
                session()->flash('error', 'Pendaftaran gagal. Silakan coba lagi.');
            }
            return;
        }
    }

    public function render(): \Illuminate\Contracts\View\View
    {
        return view('livewire.frontend.auth.register')
            ->layout('components.layouts.login');
    }
}
