<?php

namespace App\Livewire\Frontend\Auth;

use App\Models\Kepeminatan\Perusahaan;
use App\Models\User;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Livewire\Component;

class Profile extends Component implements HasForms
{
    use InteractsWithForms;

    public Perusahaan $perusahaan;
    public User $user;

    public $name;
    public $email;
    public $no_hp;
    public $photo;
    public $profile_photo_path;
    public $jabatan;
    public $nama_perusahaan, $alamat_perusahaan, $telepon_perusahaan, $nib;
    public $nama_pimpinan, $alamat_pimpinan, $telepon_pimpinan;
    public $jenis_usaha;
    public $negara_asal;
    public $induk_perusahaan;
    public $loading = false;

    public function mount()
    {
        $this->form->fill([
            'name' => auth()->user()->name,
            'email' => auth()->user()->email,
            'nip' => auth()->user()->nip,
            'jabatan' => auth()->user()->jabatan,
            'no_hp' => auth()->user()->no_hp,
            'profile_photo_path' => auth()->user()->profile_photo_path,

            'nama_perusahaan' => auth()->user()->userperusahaan->nama_perusahaan ?? '',
            'jenis_usaha' => auth()->user()->userperusahaan->jenis_usaha ?? '',
            'telepon_perusahaan' => auth()->user()->userperusahaan->telepon_perusahaan ?? '',
            'negara_asal' => auth()->user()->userperusahaan->negara_asal ?? '',
            'induk_perusahaan' => auth()->user()->userperusahaan->induk_perusahaan ?? '',
            'nama_pimpinan' => auth()->user()->userperusahaan->nama_pimpinan ?? '',
            'telepon_pimpinan' => auth()->user()->userperusahaan->telepon_pimpinan ?? '',
            'nib' => auth()->user()->userperusahaan->nib ?? '',
            'alamat_pimpinan' => auth()->user()->userperusahaan->alamat_pimpinan ?? '',
            'alamat_perusahaan' => auth()->user()->userperusahaan->alamat_perusahaan ?? '',
        ]);
    }

    protected function getFormSchema(): array
    {
        return [
            Section::make('Foto Profil')->schema([
                FileUpload::make('profile_photo_path')
                    ->avatar()
                    ->image()
                    ->alignCenter()
                    ->hiddenLabel()
                    ->acceptedFileTypes(['image/png', 'image/jpg', 'image/jpeg'])
                    ->disk('public')
                    ->preserveFilenames()
                    ->directory('User/Avatar')
                    ->required()
                    ->label('Foto Profil'),
            ]),
            Section::make('User')->schema([
                TextInput::make('name')
                    ->label('Nama')
                    ->required(),
                TextInput::make('email')
                    ->label('Email')
                    ->required(),
                TextInput::make('no_hp')
                    ->label('No. Hp')
                    ->numeric()
                    ->required(),
                TextInput::make('jabatan')
                    ->label('Jabatan')
                    ->required(),
            ])->columns(2),
            Section::make('Perusahaan')->schema([
                TextInput::make('nama_perusahaan')
                    ->label('Nama Perusahaan')
                    ->placeholder('Masukan Nama Perusahaan')
                    ->required(),
                TextInput::make('nib')
                    ->label('NIB')
                    ->required(),
                TextInput::make('jenis_usaha')
                    ->required(),
                TextInput::make('telepon_perusahaan')
                    ->label('Telp. Perusahaan')
                    ->numeric()
                    ->placeholder('Masukan Nomor Kontak/Telp. Perusahaan')
                    ->required(),
                TextInput::make('induk_perusahaan')
                    ->required()
                    ->label('Induk Perusahaan'),
                Select::make('negara_asal')
                    ->label('Asal Negara')
                    ->options(function () {
                        $negara = [
                            "Afghanistan",
                            "Albania",
                            "Algeria",
                            "American Samoa",
                            "Andorra",
                            "Angola",
                            "Anguilla",
                            "Antarctica",
                            "Antigua and Barbuda",
                            "Argentina",
                            "Armenia",
                            "Aruba",
                            "Australia",
                            "Austria",
                            "Azerbaijan",
                            "Bahamas",
                            "Bahrain",
                            "Bangladesh",
                            "Barbados",
                            "Belarus",
                            "Belgium",
                            "Belize",
                            "Benin",
                            "Bermuda",
                            "Bhutan",
                            "Bolivia",
                            "Bosnia and Herzegowina",
                            "Botswana",
                            "Bouvet Island",
                            "Brazil",
                            "British Indian Ocean Territory",
                            "Brunei Darussalam",
                            "Bulgaria",
                            "Burkina Faso",
                            "Burundi",
                            "Cambodia",
                            "Cameroon",
                            "Canada",
                            "Cape Verde",
                            "Cayman Islands",
                            "Central African Republic",
                            "Chad",
                            "Chile",
                            "China",
                            "Christmas Island",
                            "Cocos (Keeling) Islands",
                            "Colombia",
                            "Comoros",
                            "Congo",
                            "Congo, the Democratic Republic of the",
                            "Cook Islands",
                            "Costa Rica",
                            "Cote d'Ivoire",
                            "Croatia (Hrvatska)",
                            "Cuba",
                            "Cyprus",
                            "Czech Republic",
                            "Denmark",
                            "Djibouti",
                            "Dominica",
                            "Dominican Republic",
                            "East Timor",
                            "Ecuador",
                            "Egypt",
                            "El Salvador",
                            "Equatorial Guinea",
                            "Eritrea",
                            "Estonia",
                            "Ethiopia",
                            "Falkland Islands (Malvinas)",
                            "Faroe Islands",
                            "Fiji",
                            "Finland",
                            "France",
                            "France Metropolitan",
                            "French Guiana",
                            "French Polynesia",
                            "French Southern Territories",
                            "Gabon",
                            "Gambia",
                            "Georgia",
                            "Germany",
                            "Ghana",
                            "Gibraltar",
                            "Greece",
                            "Greenland",
                            "Grenada",
                            "Guadeloupe",
                            "Guam",
                            "Guatemala",
                            "Guinea",
                            "Guinea-Bissau",
                            "Guyana",
                            "Haiti",
                            "Heard and Mc Donald Islands",
                            "Holy See (Vatican City State)",
                            "Honduras",
                            "Hong Kong",
                            "Hungary",
                            "Iceland",
                            "India",
                            "Indonesia",
                            "Iran (Islamic Republic of)",
                            "Iraq",
                            "Ireland",
                            "Israel",
                            "Italy",
                            "Jamaica",
                            "Japan",
                            "Jordan",
                            "Kazakhstan",
                            "Kenya",
                            "Kiribati",
                            "Korea, Democratic People's Republic of",
                            "Korea, Republic of",
                            "Kuwait",
                            "Kyrgyzstan",
                            "Lao, People's Democratic Republic",
                            "Latvia",
                            "Lebanon",
                            "Lesotho",
                            "Liberia",
                            "Libyan Arab Jamahiriya",
                            "Liechtenstein",
                            "Lithuania",
                            "Luxembourg",
                            "Macau",
                            "Macedonia, The Former Yugoslav Republic of",
                            "Madagascar",
                            "Malawi",
                            "Malaysia",
                            "Maldives",
                            "Mali",
                            "Malta",
                            "Marshall Islands",
                            "Martinique",
                            "Mauritania",
                            "Mauritius",
                            "Mayotte",
                            "Mexico",
                            "Micronesia, Federated States of",
                            "Moldova, Republic of",
                            "Monaco",
                            "Mongolia",
                            "Montserrat",
                            "Morocco",
                            "Mozambique",
                            "Myanmar",
                            "Namibia",
                            "Nauru",
                            "Nepal",
                            "Netherlands",
                            "Netherlands Antilles",
                            "New Caledonia",
                            "New Zealand",
                            "Nicaragua",
                            "Niger",
                            "Nigeria",
                            "Niue",
                            "Norfolk Island",
                            "Northern Mariana Islands",
                            "Norway",
                            "Oman",
                            "Pakistan",
                            "Palau",
                            "Panama",
                            "Papua New Guinea",
                            "Paraguay",
                            "Peru",
                            "Philippines",
                            "Pitcairn",
                            "Poland",
                            "Portugal",
                            "Puerto Rico",
                            "Qatar",
                            "Reunion",
                            "Romania",
                            "Russian Federation",
                            "Rwanda",
                            "Saint Kitts and Nevis",
                            "Saint Lucia",
                            "Saint Vincent and the Grenadines",
                            "Samoa",
                            "San Marino",
                            "Sao Tome and Principe",
                            "Saudi Arabia",
                            "Senegal",
                            "Seychelles",
                            "Sierra Leone",
                            "Singapore",
                            "Slovakia (Slovak Republic)",
                            "Slovenia",
                            "Solomon Islands",
                            "Somalia",
                            "South Africa",
                            "South Georgia and the South Sandwich Islands",
                            "Spain",
                            "Sri Lanka",
                            "St. Helena",
                            "St. Pierre and Miquelon",
                            "Sudan",
                            "Suriname",
                            "Svalbard and Jan Mayen Islands",
                            "Swaziland",
                            "Sweden",
                            "Switzerland",
                            "Syrian Arab Republic",
                            "Taiwan, Province of China",
                            "Tajikistan",
                            "Tanzania, United Republic of",
                            "Thailand",
                            "Togo",
                            "Tokelau",
                            "Tonga",
                            "Trinidad and Tobago",
                            "Tunisia",
                            "Turkey",
                            "Turkmenistan",
                            "Turks and Caicos Islands",
                            "Tuvalu",
                            "Uganda",
                            "Ukraine",
                            "United Arab Emirates",
                            "United Kingdom",
                            "United States",
                            "United States Minor Outlying Islands",
                            "Uruguay",
                            "Uzbekistan",
                            "Vanuatu",
                            "Venezuela",
                            "Vietnam",
                            "Virgin Islands (British)",
                            "Virgin Islands (U.S.)",
                            "Wallis and Futuna Islands",
                            "Western Sahara",
                            "Yemen",
                            "Yugoslavia",
                            "Zambia",
                            "Zimbabwe"
                        ];
                        return array_combine($negara, $negara);
                    })
                    ->searchable()
                    ->required(),
                Textarea::make('alamat_perusahaan')
                    ->required()
                    ->label('Alamat Perusahaan')
                    ->columnSpanFull(),
                TextInput::make('nama_pimpinan')
                    ->label('Nama Pimpinan')
                    ->required(),
                TextInput::make('telepon_pimpinan')
                    ->label('Telp. Pimpinan')
                    ->numeric()
                    ->required(),
                Textarea::make('alamat_pimpinan')
                    ->required()
                    ->label('Alamat Pimpinan')
                    ->columnSpanFull()

            ])->columns(2)
        ];
    }
    public function store()
    {
        $user = auth()->user();
        $user->update([
            'name' => $this->name,
            'email' => $this->email,
            'no_hp' => $this->no_hp,
            'jabatan' => $this->jabatan,
            'profile_photo_path' => $this->form->getState()['profile_photo_path'],
        ]);
        $perusahaan = $user->userperusahaan;
        if ($perusahaan) {
            $perusahaan->update([
                'nama_perusahaan' => $this->nama_perusahaan,
                'nib' => $this->nib,
                'jenis_usaha' => $this->jenis_usaha,
                'telepon_perusahaan' => $this->telepon_perusahaan,
                'induk_perusahaan' => $this->induk_perusahaan,
                'negara_asal' => $this->negara_asal,
                'alamat_perusahaan' => $this->alamat_perusahaan,
                'nama_pimpinan' => $this->nama_pimpinan,
                'telepon_pimpinan' => $this->telepon_pimpinan,
                'alamat_pimpinan' => $this->alamat_pimpinan,
            ]);
        } else {
            $perusahaan = Perusahaan::create([
                'user_id' => $user->id,
                'nama_perusahaan' => $this->nama_perusahaan,
                'nib' => $this->nib,
                'jenis_usaha' => $this->jenis_usaha,
                'telepon_perusahaan' => $this->telepon_perusahaan,
                'induk_perusahaan' => $this->induk_perusahaan,
                'negara_asal' => $this->negara_asal,
                'alamat_perusahaan' => $this->alamat_perusahaan,
                'nama_pimpinan' => $this->nama_pimpinan,
                'telepon_pimpinan' => $this->telepon_pimpinan,
                'alamat_pimpinan' => $this->alamat_pimpinan,
            ]);
        }
        session()->flash('message', 'Data saved successfully!');
        return Redirect::to('/dashboard');
    }
    public function logout()
    {
        Auth::logout();
        return Redirect::to('/');
    }
    public function render()
    {
        return view('livewire.frontend.auth.profile')->layout('components.layouts.master');
    }
}
