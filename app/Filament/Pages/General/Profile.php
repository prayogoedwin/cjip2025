<?php

namespace App\Filament\Pages\General;

use BezhanSalleh\FilamentShield\Traits\HasPageShield;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Hash;

class Profile extends Page
{
    use HasPageShield;

    protected static ?string $navigationGroup = 'Settings';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $pluralModelLabel = 'Profil';

    protected static ?string $title = 'Profil';

    protected static ?string $modelLabel = 'Profil';

    protected static ?string $navigationLabel = 'Profil';

    protected static bool $shouldRegisterNavigation = false;


    protected static ?int $navigationSort = -3;

    protected static string $view = 'filament.pages.general.profile';

    public $name;

    public $email, $telp, $profile_photo_path, $nik, $address, $jabatan;

    public $current_password;

    public $new_password;

    public $new_password_confirmation;

    public function mount()
    {
        $this->form->fill([
            'name' => auth()->user()->name,
            'email' => auth()->user()->email,
            'nik' => auth()->user()->nik,
            'telp' => auth()->user()->telp,
            'jabatan' => auth()->user()->jabatan,
            'address' => auth()->user()->address,
            'profile_photo_path' => auth()->user()->profile_photo_path,

        ]);
    }

    public function submit()
    {
        $this->form->getState();

        //dd($this->form->getState());
        $state = array_filter([
            'name' => $this->name,
            'email' => $this->email,
            'nik' => $this->nik,
            'jabatan' => $this->jabatan,
            'telp' => $this->telp,
            'address' => $this->address,
            'password' => $this->new_password ? Hash::make($this->new_password) : null,
            'profile_photo_path' => $this->form->getState()['profile_photo_path'],
        ]);

        //dd(auth()->user());
        auth()->user()->update($state);

        $this->reset(['current_password', 'new_password', 'new_password_confirmation']);

        Notification::make()
            ->title('Profile Berhasil Disimpan')
            ->success()
            ->send();

        // return redirect()->route('filament.pages.dashboard');        
    }
    public function getCancelButtonUrlProperty()
    {
        return static::getUrl();
    }
    protected function getFormSchema(): array
    {
        return [
            Section::make('Foto Profil')->schema([
                FileUpload::make('profile_photo_path')
                    ->label('Foto Profil')
                    ->disk('public')
                    ->alignCenter()
                    ->disableLabel()
                    ->directory('User/Avatar')
                    ->avatar()
            ])->collapsible()->icon('heroicon-o-photo'),

            Section::make('Profil')->schema([
                Grid::make()->schema([
                    TextInput::make('name')
                        ->label('Nama Lengkap')
                        ->required(),
                    TextInput::make('nik')
                        ->label('NIK/NIP')
                        ->maxLength(20)
                        ->required(),
                ])->columns(2),
                Grid::make()->schema([
                    TextInput::make('jabatan')
                        ->label('Jabatan')
                        ->required(),
                    TextInput::make('telp')
                        ->label('No. Hp')
                        ->required(),
                    TextInput::make('email')
                        ->label('Email')
                        ->required(),
                ])->columns(3),
                Textarea::make('address')
                    ->label('Alamat')

            ])->collapsible()->icon('heroicon-o-user'),

            Section::make('Ubah Password')
                ->icon('heroicon-o-key')
                ->columns(2)
                ->schema([
                    Grid::make()
                        ->schema([
                            TextInput::make('current_password')
                                ->label('Current Password')
                                ->password()
                                ->rules(['required_with:new_password'])
                                ->currentPassword()
                                ->autocomplete('off')
                                ->columnSpan(1),
                            TextInput::make('new_password')
                                ->label('New Password')
                                ->password()
                                ->rules(['confirmed'])
                                ->autocomplete('new-password'),
                            TextInput::make('new_password_confirmation')
                                ->label('Confirm Password')
                                ->password()
                                ->rules([
                                    'required_with:new_password',
                                ])
                                ->autocomplete('new-password'),
                        ])->columns(3),
                ])->collapsible()->collapsed(),

        ];
    }
}