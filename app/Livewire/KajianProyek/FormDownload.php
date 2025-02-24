<?php

namespace App\Livewire\KajianProyek;

use App\Models\Cjip\PermintaanFileKajian;
use App\Models\Cjip\ProyekInvestasi;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Illuminate\Support\Facades\Session;
use Livewire\Component;


class FormDownload extends Component implements HasForms
{
    use InteractsWithForms;

    public $proyek_id;
    public $name;
    public $email;
    public $phone;
    public $company;
    public $message;
    public $status;
    public $pemohon;

    public $locale;
    protected $listeners = [
        'languageChange' => 'changeLanguage',
        'languageChanged' => '$refresh',
    ];

    public function mount()
    {
        $this->locale = Session::get('lang', 'id');  // Get 'lang' from session, default to 'id'
        Session::put('lang', $this->locale);  // Set the language in session
    }
    public ?array $data = [];

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()->schema([
                    Select::make('proyek_id')
                        ->label('Proyek Investasi')
                        ->placeholder('Pilih Proyek Investasi')
                        ->options(function () {
                            $proyeks = ProyekInvestasi::where('status', 1)->pluck('nama', 'id')->toArray();
                            return $proyeks;
                        })
                        ->searchable()
                        ->required(),
                    TextInput::make('name')
                        ->required()
                        ->label('Nama Lengkap')
                        ->placeholder('Masukan Nama Lengkap Anda'),
                    TextInput::make('email')
                        ->required()
                        ->email()
                        ->label('Email')
                        ->placeholder('Masukan Email Anda'),
                    TextInput::make('phone')
                        ->numeric()
                        ->placeholder('Masukan Nomor Telepon Anda')
                        ->label('Nomor Telepon'),
                    TextInput::make('company')
                        ->label('Perusahaan/Institusi')
                        ->placeholder('Masukan Nama Perusahaan/institusi Anda'),
                    // Textarea::make('message')
                    //     ->label('Pesan')
                    //     ->placeholder('Masukan Pesan Anda'),
                    Hidden::make('status')
                        ->default(0),
                ])
            ]);
    }
    public function create()
    {
        $pemohon = PermintaanFileKajian::create([
            'proyek_id' => $this->proyek_id ? (int) $this->proyek_id : null,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'company' => $this->company,
            'message' => $this->message,
            'status' => 0
        ]);
        // dd($pemohon);
        return redirect()->route('confirm_kajian_proyek');
    }
    public function render()
    {
        return view('livewire.kajian-proyek.form-download')->layout('components.layouts.master');
    }
}
