<?php

namespace App\Livewire\Frontend\Auth;

use App\Models\User;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Laravel\Fortify\Actions\EnableTwoFactorAuthentication;
use Laravel\Fortify\Actions\DisableTwoFactorAuthentication;
use Laravel\Fortify\Actions\GenerateNewRecoveryCodes;
use Livewire\Component;

class Profile extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];
    // REMOVED: UI state properties are now handled by Alpine.js
    // public $showingQrCode = false;
    // public $showingRecoveryCodes = false;
    public $confirming2faDisabling = false;


    public $profile_photo_path,
        $name,
        $email,
        $no_hp,
        $jabatan,
        $nip,
        $nama_perusahaan,
        $nib,
        $jenis_usaha,
        $telepon_perusahaan,
        $induk_perusahaan,
        $negara_asal,
        $alamat_perusahaan,
        $nama_pimpinan,
        $telepon_pimpinan,
        $alamat_pimpinan;

    public function mount()
    {
        $user = Auth::user()->load('userperusahaan');
        $company = $user->userperusahaan;

        $this->form->fill(array_merge(
            $user->toArray(),
            $company ? $company->toArray() : []
        ));
    }

    protected function getFormSchema(): array
    {
        return [
            Section::make('Foto Profil')->schema([
                FileUpload::make('profile_photo_path')
                    ->avatar()->image()->alignCenter()->hiddenLabel()
                    ->disk('public')->directory('User/Avatar'),
            ]),
            Section::make('Informasi Personal')->schema([
                TextInput::make('name')->required(),
                TextInput::make('email')->email()->required(),
                TextInput::make('no_hp')->label('No. HP')->tel()->required(),
                TextInput::make('jabatan')->required(),
                TextInput::make('nip')->label('NIP')->nullable(),
            ])->columns(2),
            Section::make('Informasi Perusahaan')->schema([
                TextInput::make('nama_perusahaan')->required(),
                TextInput::make('nib')->label('NIB')->numeric()->length(13)->required(),
                TextInput::make('jenis_usaha')->required(),
                TextInput::make('telepon_perusahaan')->label('Telp. Perusahaan')->tel()->required(),
                TextInput::make('induk_perusahaan')->label('Induk Perusahaan')->required(),
                Select::make('negara_asal')->label('Asal Negara')->options($this->getCountryOptions())->searchable()->required(),
                Textarea::make('alamat_perusahaan')->required()->columnSpanFull(),
                TextInput::make('nama_pimpinan')->label('Nama Pimpinan')->required(),
                TextInput::make('telepon_pimpinan')->label('Telp. Pimpinan')->tel()->required(),
                Textarea::make('alamat_pimpinan')->label('Alamat Pimpinan')->required()->columnSpanFull(),
            ])->columns(2),
        ];
    }

    public function updateProfileInformation()
    {
        $formData = $this->form->getState();
        $user = Auth::user();

        DB::transaction(function () use ($user, $formData) {
            $user->update([
                'name' => $formData['name'],
                'email' => $formData['email'],
                'no_hp' => $formData['no_hp'],
                'jabatan' => $formData['jabatan'],
                'nip' => $formData['nip'],
                'profile_photo_path' => $formData['profile_photo_path'],
            ]);

            $user->userperusahaan()->updateOrCreate(
                ['user_id' => $user->id],
                [
                    'nama_perusahaan' => $formData['nama_perusahaan'],
                    'nib' => $formData['nib'],
                    'jenis_usaha' => $formData['jenis_usaha'],
                    'telepon_perusahaan' => $formData['telepon_perusahaan'],
                    'induk_perusahaan' => $formData['induk_perusahaan'],
                    'negara_asal' => $formData['negara_asal'],
                    'alamat_perusahaan' => $formData['alamat_perusahaan'],
                    'nama_pimpinan' => $formData['nama_pimpinan'],
                    'telepon_pimpinan' => $formData['telepon_pimpinan'],
                    'alamat_pimpinan' => $formData['alamat_pimpinan'],
                ]
            );
        });

        session()->flash('message', 'Profil berhasil diperbarui.');
        return Redirect::to('/dashboard');
    }

    // --- Two-Factor Authentication Methods ---

    public function enableTwoFactorAuthentication(EnableTwoFactorAuthentication $enabler)
    {
        $enabler(Auth::user());

        // FIXED: Refresh the user's state from the database.
        // This ensures the new `two_factor_secret` is loaded before re-rendering.
        Auth::setUser(Auth::user()->fresh());

        $this->dispatch('two-factor-enabled');
    }

    public function regenerateRecoveryCodes(GenerateNewRecoveryCodes $generator)
    {
        $generator(Auth::user());
        $this->dispatch('recovery-codes-regenerated');
    }

    public function disableTwoFactorAuthentication(DisableTwoFactorAuthentication $disabler)
    {
        // FIXED: Manually clear the problematic data first to break the error cycle.
        $user = Auth::user();
        $user->forceFill([
            'two_factor_secret' => null,
            'two_factor_recovery_codes' => null,
            'two_factor_confirmed_at' => null, // Also clear the confirmation timestamp
        ])->save();

        // Now, run the standard disabler action.
        $disabler($user);

        $this->dispatch('two-factor-disabled');
    }


    public function getUserProperty()
    {
        return Auth::user();
    }

    public function render(): View
    {
        return view('livewire.frontend.auth.profile')->layout('components.layouts.master');
    }

    private function getCountryOptions(): array
    {
        return $countries = ["Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegowina", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Congo, the Democratic Republic of the", "Cook Islands", "Costa Rica", "Cote d'Ivoire", "Croatia (Hrvatska)", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "East Timor", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "France Metropolitan", "French Guiana", "French Polynesia", "French Southern Territories", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard and Mc Donald Islands", "Holy See (Vatican City State)", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran (Islamic Republic of)", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, Democratic People's Republic of", "Korea, Republic of", "Kuwait", "Kyrgyzstan", "Lao, People's Democratic Republic", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Macedonia, The Former Yugoslav Republic of", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia, Federated States of", "Moldova, Republic of", "Monaco", "Mongolia", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Seychelles", "Sierra Leone", "Singapore", "Slovakia (Slovak Republic)", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia and the South Sandwich Islands", "Spain", "Sri Lanka", "St. Helena", "St.Pierre and Miquelon", "Sudan", "Suriname", "Svalbard and Jan Mayen Islands", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan, Province of China", "Tajikistan", "Tanzania, United Republic of", "Thailand", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks and Caicos Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "United States Minor Outlying Islands", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Virgin Islands (British)", "Virgin Islands (U.S.)", "Wallis and Futuna Islands", "Western Sahara", "Yemen", "Yugoslavia", "Zambia", "Zimbabwe"];
    }
}
