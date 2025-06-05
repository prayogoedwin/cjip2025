<?php

namespace App\Livewire\Cjibf;

use App\Models\Cjibf\CjibfRegisterO3m;
use App\Models\Cjip\Kabkota;
use App\Models\Cjip\KawasanIndustri;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Get;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class RegisterO3m extends Component implements HasForms
{
    use InteractsWithForms;

    public $name,
        $event_id,
        $company_name,
        $mobile_phone,
        $o3m_interest_id,
        $kawasan_id,
        $kab_kota_id;
    public $locale;
    public ?array $data = [];

    protected $listeners = [
        'languageChange' => 'changeLanguange',
    ];

    public function mount(): void
    {
        if (Session::get('lang')) {
            if (is_array(Session::get('lang'))) {
                $this->locale = Session::get('lang')[0];
            } else {
                $this->locale = Session::get('lang');
            }
        } else {
            $this->locale = 'id';
        }
        $this->form->fill();
    }

    protected function getFormSchema(): array
    {
        return [
            Hidden::make("event_id")->default('1'),
            TextInput::make('name')
                ->label('Name / Nama')
                ->required(),
            TextInput::make('company_name')
                ->label('Company / Nama Perusahaan')
                ->required(),
            TextInput::make('mobile_phone')
                ->label('WhatsApp Contact (Mobile Phone) / Kontak WhatsApp (Ponsel)')
                ->required()
                ->numeric(),
            Radio::make('o3m_interest_id')
                ->label('Whom do you wish to meet during the One on One Meeting? / Siapa yang ingin Anda temui pada One on One Meeting?')
                ->options([
                    '1' => 'Regencial/Municipal Government (Pemerintah Kabupaten/Kota)',
                    '2' => 'Industrial Park Management (Pengelola Kawasan Industri)',
                    '3' => 'PT Geo Dipa Energi (Persero) (Geothermal Energy Potential in Central Java)'
                ])
                ->reactive()
                ->required(),

            Select::make('kawasan_id')
                ->label('Industrial Parks / Kawasan Industri')
                ->options(options: KawasanIndustri::all()->pluck('nama', 'id'))
                ->searchable()
                ->preload()
                ->visible(function (Get $get) {
                    if ($get('o3m_interest_id') === '2') {
                        return true;
                    }
                    return false;
                }),
            Select::make('kab_kota_id')
                ->label('Regency/City / Kabupaten/Kota')
                ->options(options: Kabkota::all()->pluck('nama', 'id'))
                ->searchable()
                ->preload()
                ->visible(function (Get $get) {
                    if ($get('o3m_interest_id') === '1') {
                        return true;
                    }
                    return false;
                }),
        ];
    }

    public function store()
    {
        CjibfRegisterO3m::create($this->form->getState());
        $this->form->fill([]);
        $this->dispatch('o3m-registered');
    }
    public function render()
    {
        return view('livewire.cjibf.register-o3m')->layout('components.layouts.master');
    }
}
