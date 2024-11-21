<?php

namespace App\Livewire\Frontend\Kepeminatan;

use App\Models\Cjip\Kabkota;
use App\Models\Cjip\ProyekInvestasi;
use Closure;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Livewire\Component;

class BerandaPengajuan extends Component implements HasForms
{
    use InteractsWithForms;

    public $name, $jabatan, $no_hp, $email, $nama_perusahaan, $jenis_usaha, $alamat_perusahaan, $negara_asal, $induk_perusahaan, $investment_interest, $proyek_id, $sektor,
        $mata_uang, $nilai_investasi;
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Detail Kontak/Contact Detail')
                    ->collapsible()
                    ->schema([
                        TextInput::make('name')
                            ->inlineLabel()
                            ->label('Nama Lengkap/Full Name')
                            ->required(),
                        TextInput::make('jabatan')
                            ->inlineLabel()
                            ->label('Jabatan/Job Title')
                            ->required(),
                        TextInput::make('no_hp')
                            ->inlineLabel()
                            ->label('No. Telpon/Phone Number')
                            ->required(),
                        TextInput::make('email')
                            ->inlineLabel()
                            ->label('Alamat Email/Email Address')
                            ->required(),
                        TextInput::make('nama_perusahaan')
                            ->inlineLabel()
                            ->label('Nama Perusahaan/Company Name')
                            ->required(),
                        TextInput::make('jenis_usaha')
                            ->inlineLabel()
                            ->label('Bidang Usaha Saat ini/Business Field')
                            ->required(),
                        TextInput::make('alamat_perusahaan')
                            ->inlineLabel()
                            ->label('Alamat Perusahaan/Company Address')
                            ->required(),
                        TextInput::make('negara_asal')
                            ->inlineLabel()
                            ->label('Negara Asal/Country of Origin')
                            ->required(),
                        TextInput::make('induk_perusahaan')
                            ->inlineLabel()
                            ->label('Induk Perusahaan/Parent Company')
                            ->required(),
                    ]),
                Section::make('INVESTMENT INTEREST / Kepemintan Investasi')
                    ->collapsible()
                    ->schema([
                        Toggle::make('investment_interest')
                            ->label('Apakah Kepeminatan dengan Proyek Jawa Tengah/What is the Interest in Central Java Project?')
                            ->inlineLabel()
                            ->columnSpanFull()
                            ->reactive(),
                        Select::make('proyek_id')
                            ->searchable()
                            ->inlineLabel()
                            ->label('Proyek Investasi/Project Interest')
                            ->options(function () {
                                $proyeks = ProyekInvestasi::where('status', 1)->pluck('nama', 'id')->toArray();
                                return $proyeks;
                            })
                            ->afterStateUpdated(function ($state, Set $set) {
                                $proyek = ProyekInvestasi::find($state);

                                if ($proyek) {
                                    $set('sektor', $proyek->sektor->nama);
                                    $set('rencana_bidang_usaha', $proyek->sektor->nama);
                                    // $set('investment_status', 'new');
                                    // $set('kab_kota_id', $proyek->kab_kota_id);
                                }
                            })
                            ->visible(function (Get $get) {
                                if ($get('investment_interest')) {
                                    return true;
                                }
                                return false;
                            })
                            ->reactive(),
                        Select::make('sektor')
                            ->inlineLabel()
                            ->label('Sektor Investasi/Sector')
                            ->required()
                            ->searchable()
                            ->options([
                                'Industri' => 'Industri',
                                'Infrastruktur' => 'Infrastruktur',
                                'Pertanian' => 'Pertanian',
                                'Pariwisata' => 'Pariwisata',
                                'Properti' => 'Properti',
                                'Energi' => 'Energi',
                                'Jasa' => 'Jasa',
                                'Lainnya' => 'Lainnya',
                            ])
                            ->visible(function (Get $get) {
                                if ($get('investment_interest')) {
                                    return true;
                                }
                                return false;
                            }),
                        TextInput::make('rencana_bidang_usaha')
                            ->required()
                            ->inlineLabel(),
                        Radio::make('status_investasi')
                            ->inlineLabel()
                            ->options([
                                0 => 'NEW (GREENFIELD) / BARU',
                                1 => 'EXPANSION (BROWNFIELD) / EXPANSI',
                            ]),
                        Select::make('prefensi_lokasi')
                            ->label('Prefensi Lokasi/Location Preference')
                            ->options([
                                Kabkota::all()->pluck('nama', 'id')->toArray(),
                            ])
                            ->searchable()
                            ->inlineLabel(),
                        Radio::make('mata_uang')
                            ->label('Mata Uang/Currency')
                            ->required()
                            ->options([
                                0 => 'USD',
                                1 => 'Rupiah',
                            ])
                            ->reactive()
                            ->inline(),
                        TextInput::make('nilai_investasi')
                            ->label('Nilai Investasi Dalam USD')
                            ->visible(function (Get $get) {
                                if ($get('mata_uang') === '0' or $get('mata_uang') === 0) {
                                    return true;
                                }
                                return false;
                            })
                            ->required(function ($get) {
                                if ($get('mata_uang') === '0' or $get('mata_uang') === 0) {
                                    return true;
                                }
                                return false;
                            })
                            ->inlineLabel()
                            ->reactive()
                            ->prefix('USD '),
                        TextInput::make('nilai_investasi_rupiah')
                            ->label('Nilai Investasi Dalam Rupiah')
                            ->visible(function (Get $get) {
                                if ($get('mata_uang') === '1' or $get('mata_uang') === 1) {
                                    return true;
                                }
                                return false;
                            })
                            ->required(function ($get) {
                                //dd($get);
                                if ($get('mata_uang') === '1' or $get('mata_uang') === 1) {
                                    return true;
                                }
                                return false;
                            })
                            ->prefix('Rp. ')
                            ->numeric()
                            ->inlineLabel()
                            ->reactive(),
                        Fieldset::make('Local Worker/ TKI')
                            ->inlineLabel()
                            ->schema([
                                TextInput::make('local_worker_plan')
                                    ->required()
                                    ->numeric()
                                    ->label('Plan/ Rencana')
                                    ->default(0)
                                    ->suffix('People/ Orang'),
                                TextInput::make('local_worker_exis')
                                    ->required()
                                    ->numeric()
                                    ->label('Existing/ Eksisting')
                                    ->default(0)
                                    ->suffix('People/ Orang'),
                            ])->columns(1),

                        Fieldset::make('Foreign Worker/ TKA')
                            ->inlineLabel()
                            ->schema([
                                TextInput::make('foreign_worker_plan')
                                    ->required()
                                    ->numeric()
                                    ->label('Plan/ Rencana')
                                    ->default(0)
                                    ->suffix('People/ Orang'),
                                TextInput::make('foreign_worker_exis')
                                    ->required()
                                    ->numeric()
                                    ->label('Existing/ Eksisting')
                                    ->default(0)
                                    ->suffix('People/ Orang'),
                            ])->columns(1)
                    ]),
                Section::make('Jadwal Proyek/ Timeline Project')
                    ->inlineLabel()
                    ->collapsible()
                    ->schema([
                        Textarea::make('deskripsi_proyek')
                            ->required()
                            ->label('Timeline Project/ Jadwal Proyek'),
                        DatePicker::make('jadwal_proyek')
                            ->required()
                            ->label('Tanggal Proyek/ Project Date'),
                            
                    ])
            ]);
    }
    public function render()
    {
        return view('livewire.frontend.kepeminatan.beranda-pengajuan')->layout('components.layouts.master');
    }
}
