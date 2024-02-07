<?php

namespace App\Filament\Resources\Cjip;

use App\Filament\Resources\Cjip\LoiResource\Pages;
use App\Filament\Resources\Cjip\LoiResource\RelationManagers;
use App\Models\Cjip\Event;
use App\Models\Cjip\KawasanIndustri;
use App\Models\Cjip\Loi;
use App\Models\Cjip\ProyekInvestasi;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LoiResource extends Resource
{
    protected static ?string $model = Loi::class;
    protected static ?string $navigationGroup = 'Cjibf';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Event')->schema([
                    Select::make('event_id')
                        ->label('Nama Event')
                        ->relationship('event', 'nama')
                        ->preload()
                        ->required()
                        ->searchable()
                        ->default(function () {
                            return Event::first()->id;
                        })
                ]),
                Section::make('Contact Detail/ Detail Kontak')->schema([
                    Grid::make()->schema([
                        TextInput::make('nama_pengusaha')
                            ->label('Nama Lengkap Pengusaha')
                            ->required(),
                        TextInput::make('jabatan_pengusaha')
                            ->label('Jabatan Perusahaan')
                            ->required(),
                        TextInput::make('phone')
                            ->label('Phone Number')
                            ->tel()
                            ->required(),
                        TextInput::make('email')
                            ->label('Email')
                            ->email()
                            ->required(),

                        TextInput::make('nama_perusahaan')
                            ->label('Nama Perusahaan')
                            ->required(),
                        TextInput::make('bidang_usaha')
                            ->label('Bidang Usaha Saat Ini')
                            ->required(),
                        Textarea::make('alamat_perusahaan')
                            ->label('Alamat Perusahaan')
                            ->required(),
                        Select::make('asal_negara')
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

                        TextInput::make('parent_company')
                            ->label('Induk Perusahaan'),
                    ])->columns(1)
                ]),
                Section::make('Investment Interest/ Kepeminatan Investasi')->schema([
                    Grid::make()->schema([
                        Toggle::make('is_proyek_jateng')
                            ->label('Apakah Kepeminatan dengan Proyek Jawa Tengah')
                            ->reactive()
                            ->afterStateUpdated(function (\Filament\Forms\Set $set) {
                                $set('rencana_bidang_usaha', null);
                                $set('investment_status', null);
                                $set('kab_kota_id', null);
                            })
                            ->inlineLabel(),
                        Select::make('proyek_id')
                            ->label('Proyek Investasi Jateng')
                            ->searchable()
                            ->options(function () {
                                $proyeks = ProyekInvestasi::where('status', 1)->pluck('nama', 'id')->toArray();
                                //dd($proyeks);
                                return $proyeks;
                            })
                            ->reactive()
                            ->afterStateUpdated(function ($state, \Filament\Forms\Set $set) {
                                $proyek = ProyekInvestasi::find($state);

                                if ($proyek) {
                                    $set('sektor', $proyek->sektor->nama);
                                    $set('rencana_bidang_usaha', $proyek->sektor->nama);
                                    $set('investment_status', 'new');
                                    $set('kab_kota_id', $proyek->kab_kota_id);
                                }


                            })
                            ->visible(function (\Filament\Forms\Get $get) {
                                if ($get('is_proyek_jateng')) {
                                    return true;
                                }
                                return false;
                            }),
                        Select::make('sektor')
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
                            ]),
                        TextInput::make('rencana_bidang_usaha')
                            ->label('Rencana Bidang Usaha')
                            ->required(),
                        Forms\Components\Radio::make('investment_status')
                            ->label('Status Investasi')
                            ->required()
                            ->options([
                                'new' => 'New/ Baru',
                                'expansion' => 'Expansion/ Ekspansi',
                            ])
                            ->descriptions([
                                'new' => 'Greenfield',
                                'expansion' => 'Brownfield',
                            ])
                            ->inline(),
                        Toggle::make('is_kawasan')
                            ->reactive()
                            ->label('Apakah lokasi berada di Kawasan Industri?')->inlineLabel(),

                        Select::make('kab_kota_id')->label('Preferensi Lokasi Proyek (Kab/ Kota)')
                            ->reactive()
                            ->searchable()
                            ->required(function ($get) {
                                //dd($get);
                                if ($get('is_kawasan') === false) {
                                    return true;
                                }
                                return false;
                            })
                            ->preload()
                            ->relationship('kabkota', 'nama')
                            ->visible(function (\Filament\Forms\Get $get) {
                                if ($get('is_kawasan')) {
                                    return false;
                                }
                                return true;
                            }),

                        Select::make('kawasan_industri_id')->label('Preferensi Lokasi Proyek (Kawasan)')
                            ->reactive()
                            ->searchable()
                            ->required(function ($get) {
                                //dd($get);
                                if ($get('is_kawasan') === false) {
                                    return false;
                                }
                                return true;
                            })
                            ->options(function () {
                                $kawasans = KawasanIndustri::pluck('nama', 'id')->toArray();
                                return $kawasans;
                            })
                            ->visible(function (\Filament\Forms\Get $get) {
                                if ($get('is_kawasan')) {
                                    return true;
                                }
                                return false;
                            }),

                        Forms\Components\Radio::make('mata_uang')
                            ->label('Mata Uang')
                            ->required()
                            ->options([
                                0 => 'USD',
                                1 => 'Rupiah',
                            ])
                            ->reactive()
                            ->inline(),
                        TextInput::make('nilai_usd')
                            ->label('Nilai Investasi Dalam USD')
                            ->visible(function (\Filament\Forms\Get $get) {
                                //dd($get('mata_uang'));
                                if ($get('mata_uang') === '0' or $get('mata_uang') === 0) {
                                    return true;
                                }
                                return false;
                            })
                            ->required(function ($get) {
                                //dd($get);
                                if ($get('mata_uang') === '0' or $get('mata_uang') === 0) {
                                    return true;
                                }
                                return false;
                            })
                            ->prefix('USD ')
                            ->mask(
                                fn(TextInput\Mask $mask) => $mask
                                    ->numeric()
                                    ->decimalPlaces(2) // Set the number of digits after the decimal point.
                                    ->decimalSeparator(',') // Add a separator for decimal numbers.
                                    ->integer() // Disallow decimal numbers.
                                    ->mapToDecimalSeparator([',']) // Map additional characters to the decimal separator.
                                    ->minValue(1) // Set the minimum value that the number can be.
                                    ->normalizeZeros() // Append or remove zeros at the end of the number.
                                    ->padFractionalZeros() // Pad zeros at the end of the number to always maintain the maximum number of decimal places.
                                    ->thousandsSeparator(','), // Add a separator for thousands.
                            ),
                        TextInput::make('nilai_rp')
                            ->label('Nilai Investasi Dalam Rupiah')
                            ->visible(function (\Filament\Forms\Get $get) {
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
                            ->mask(
                                fn(TextInput\Mask $mask) => $mask
                                    ->numeric()
                                    ->decimalPlaces(2) // Set the number of digits after the decimal point.
                                    ->decimalSeparator(',') // Add a separator for decimal numbers.
                                    ->integer() // Disallow decimal numbers.
                                    ->mapToDecimalSeparator([',']) // Map additional characters to the decimal separator.
                                    ->minValue(1) // Set the minimum value that the number can be.
                                    ->normalizeZeros() // Append or remove zeros at the end of the number.
                                    ->padFractionalZeros() // Pad zeros at the end of the number to always maintain the maximum number of decimal places.
                                    ->thousandsSeparator(','), // Add a separator for thousands.
                            ),

                        Forms\Components\Fieldset::make('Local Worker/ TKI')
                            ->schema([
                                TextInput::make('rencana_tki')
                                    ->required()
                                    ->label('Plan/ Rencana')
                                    ->default(0)
                                    ->suffix('People/ Orang'),
                                TextInput::make('eksisting_tki')
                                    ->required()
                                    ->label('Existing/ Eksisting')
                                    ->default(0)
                                    ->suffix('People/ Orang'),
                            ])->columns(2),

                        Forms\Components\Fieldset::make('Foreign Worker/ TKA')
                            ->schema([
                                TextInput::make('rencana_tka')
                                    ->required()
                                    ->label('Plan/ Rencana')
                                    ->default(0)
                                    ->suffix('People/ Orang'),
                                TextInput::make('eksisting_tka')
                                    ->required()
                                    ->label('Existing/ Eksisting')
                                    ->default(0)
                                    ->suffix('People/ Orang'),
                            ])->columns(2)

                    ])->columns(1),

                ]),
                Section::make('Detail Information/ Detail Informasi')->schema([
                    Grid::make()->schema([
                        Textarea::make('deskripsi_proyek')
                            ->label('Deskripsi Proyek')
                            ->required(),
                        Textarea::make('timeline_proyek')
                            ->label('Timeline/ Jadwal Proyek')
                            ->required(),
                    ])->columns(1)
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama_perusahaan')
                    ->wrap()
                    ->label('Nama Perusahaan')->searchable()->sortable(),
                TextColumn::make('sektor')
                    ->wrap()
                    ->searchable()->sortable(),
                TextColumn::make('bidang_usaha')
                    ->wrap()
                    ->label('Bidang Usaha')->searchable()->sortable(),
                TextColumn::make('rencana_bidang_usaha')
                    ->wrap()
                    ->label('Rencana Bidang Usaha')->searchable()->sortable(),
                TextColumn::make('rencana_investasi')->label('Rencana Investasi')
                    ->formatStateUsing(function (Model $record) {
                        if ($record->nilai_usd) {
                            //dd($record);
                            return 'USD ' . number_format($record->nilai_usd);
                        }
                        return 'Rp. ' . number_format($record->nilai_rp);
                    }),
                TextColumn::make('lokasi')
                    ->wrap()
                    ->formatStateUsing(function (Model $record) {
                        //dd($record->is_kawasan);
                        if ($record->is_kawasan === 1) {
                            //dd($record);
                            return $record->kawasan->nama;
                        }
                        return $record->kabKota->nama;
                    }),
                BadgeColumn::make('investment_status')
                    ->colors([
                        'success' => 'new',
                        'danger' => 'expansion',
                    ]),
                TextColumn::make('lo.name')->label('LO')->searchable()->sortable(),
            ])->defaultSort('updated_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('sektor')
                    ->label('Sektor')
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
                    ->searchable(),
                Tables\Filters\SelectFilter::make('investment_status')
                    ->label('Investment Status')
                    ->options([
                        'new' => 'New/ Baru',
                        'expansion' => 'Expansion/ Ekspansi',
                    ])
                    ->searchable(),
                Tables\Filters\SelectFilter::make('kab_kota_id')
                    ->label('Kab/ Kota')
                    ->relationship('kabKota', 'nama')
                    ->searchable(),
                Tables\Filters\SelectFilter::make('kawasan_industri_id')
                    ->label('Kawasan Industri')
                    ->relationship('kawasan', 'nama')
                    ->searchable(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLois::route('/'),
            'create' => Pages\CreateLoi::route('/create'),
            'edit' => Pages\EditLoi::route('/{record}/edit'),
        ];
    }
}
