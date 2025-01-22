<?php

namespace App\Filament\Pages\General;

use App\Filament\Clusters\Cjip;
use App\Settings\GeneralSettings;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;
use Faker\Provider\ar_EG\Text;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Pages\SettingsPage;
use Filament\Resources\Pages\EditRecord;
use Filament\Forms\Concerns;
use Filament\Resources\Concerns\Translatable;
use FilamentTiptapEditor\TiptapEditor;
use Nuhel\FilamentCropper\Components\Cropper;

// use Filament\Resources\Concerns\Translatable;

class General extends SettingsPage
{
    use HasPageShield, Translatable;

    protected static string $settings = GeneralSettings::class;

    protected static ?int $navigationSort = 19;

    protected static ?string $navigationGroup = 'Setting';

    protected static ?string $cluster = Cjip::class;

    protected function getFormSchema(): array
    {
        return [
            Grid::make()->schema([
                Tabs::make('Heading')
                    ->tabs([
                        // Indonesia Translatable
                        Tabs\Tab::make('ID') // Optional icon
                            ->schema([
                                Tabs::make('Heading')
                                    ->tabs([
                                        Tabs\Tab::make('General Settings')
                                            ->icon('heroicon-s-chevron-right') // Optional icon
                                            ->schema([
                                                // Settings General
                                                Card::make()->schema([
                                                    Grid::make()->schema([
                                                        TextInput::make('site_name')->label('Site Name'),
                                                        TextInput::make('site_tagline')->label('Tagline'),
                                                    ])->columns(2),
                                                    RichEditor::make('site_desc')->label('Site Description')
                                                        ->toolbarButtons([
                                                            'attachFiles',
                                                            'blockquote',
                                                            'bold',
                                                            'bulletList',
                                                            'codeBlock',
                                                            'h2',
                                                            'h3',
                                                            'italic',
                                                            'link',
                                                            'orderedList',
                                                            'redo',
                                                            'strike',
                                                            'undo',
                                                        ]),
                                                ]),
                                                Card::make()->schema([
                                                    Grid::make()->schema([
                                                        FileUpload::make('logo')
                                                            ->label('Logo')
                                                            ->hint('logo dalam format .png')
                                                            ->hintIcon('heroicon-m-photo')
                                                            ->image()
                                                            ->maxSize(1024)
                                                            ->required(),
                                                    ])->columns(1),
                                                ])
                                            ]),
                                        Tabs\Tab::make('Opening Settings')
                                            ->icon('heroicon-s-chevron-right') // Optional icon
                                            ->schema([
                                                // Settings Opening
                                                Card::make()->schema([
                                                    TextInput::make('opening_title')->label('Title'),
                                                    RichEditor::make('opening_desc')->label('Deskripsi')
                                                        ->toolbarButtons([
                                                            'attachFiles',
                                                            'blockquote',
                                                            'bold',
                                                            'bulletList',
                                                            'codeBlock',
                                                            'h2',
                                                            'h3',
                                                            'italic',
                                                            'link',
                                                            'orderedList',
                                                            'redo',
                                                            'strike',
                                                            'undo',
                                                        ]),

                                                ])->columnSpan(2),
                                                Card::make()->schema([
                                                    // FileUpload::make('opening_image')->label('Gambar')->disk('public')
                                                    //     ->directory('settings/gambar')
                                                    //     ->image()
                                                    //     ->maxSize(1024)
                                                    //     ->hintIcon('heroicon-s-photograph')
                                                    //     ->hint('File Maksimal 1 Mb')
                                                    //     ->required(),
                                                    FileUpload::make('opening_image')
                                                        // ->modalSize('xl')
                                                        // ->modalHeading("Crop Image")
                                                        // ->enableImageRotation()
                                                        // ->rotationalStep(5)
                                                        ->hintIcon('heroicon-m-photo')
                                                        // ->enableImageFlipping()
                                                        ->hint('File Maksimal 1 Mb')
                                                        ->disk('public')
                                                        ->directory('settings/gambar')
                                                        ->image()
                                                        ->required(),
                                                    // ->maxSize(1024)
                                                    // ->enabledAspectRatios([
                                                    //     '3:2', '16:9', '1:1'
                                                    // ])
                                                    // ->zoomable(true)
                                                    // ->enableZoomButtons()
                                                    // ->enableAspectRatioFreeMode()
                                                    // ->imageCropAspectRatio('1:1'),
                                                    Repeater::make('opening_button')->label('Button')
                                                        ->schema([
                                                            Grid::make()->schema([
                                                                TextInput::make('btn_name')->label('Nama Button'),
                                                                TextInput::make('btn_link')->label('URL Button')->url(),
                                                            ])->columns(2)
                                                        ])
                                                ])
                                            ]),
                                        Tabs\Tab::make('Graph Settings')
                                            ->icon('heroicon-s-chevron-right') // Optional icon
                                            ->schema([
                                                // Settings graph
                                                Card::make()->schema([
                                                    Grid::make()->schema([
                                                        Grid::make()->schema([
                                                            Placeholder::make('graph')->label('Pertumbuhan Ekonomi.'),
                                                            TextInput::make('graph_title_pert')->label('Title')->placeholder('Pertumbuhan Ekonomi'),
                                                            RichEditor::make('graph_desc_pert')->label('Deskripsi')
                                                                ->toolbarButtons([
                                                                    'attachFiles',
                                                                    'blockquote',
                                                                    'bold',
                                                                    'bulletList',
                                                                    'codeBlock',
                                                                    'h2',
                                                                    'h3',
                                                                    'italic',
                                                                    'link',
                                                                    'orderedList',
                                                                    'redo',
                                                                    'strike',
                                                                    'undo',
                                                                ]),
                                                        ])->columns(1)
                                                    ])->columnSpan(1),
                                                    Grid::make()->schema([
                                                        Grid::make()->schema([
                                                            Placeholder::make('graph')->label('Performa Investasi.'),
                                                            TextInput::make('graph_title_perf')->label('Title')->placeholder('Performa Investasi'),
                                                            RichEditor::make('graph_desc_perf')->label('Deskripsi')
                                                                ->toolbarButtons([
                                                                    'attachFiles',
                                                                    'blockquote',
                                                                    'bold',
                                                                    'bulletList',
                                                                    'codeBlock',
                                                                    'h2',
                                                                    'h3',
                                                                    'italic',
                                                                    'link',
                                                                    'orderedList',
                                                                    'redo',
                                                                    'strike',
                                                                    'undo',
                                                                ]),
                                                        ])->columns(1)
                                                    ])->columnSpan(1)
                                                ])->columns(2),
                                            ]),
                                        Tabs\Tab::make('Peluang Settings')
                                            ->icon('heroicon-s-chevron-right') // Optional icon
                                            ->schema([
                                                // Settings Peluang
                                                Card::make()->schema([
                                                    TextInput::make('peluang_title')->label('Title'),
                                                    RichEditor::make('peluang_desc')->label('Deskripsi')
                                                        ->toolbarButtons([
                                                            'attachFiles',
                                                            'blockquote',
                                                            'bold',
                                                            'bulletList',
                                                            'codeBlock',
                                                            'h2',
                                                            'h3',
                                                            'italic',
                                                            'link',
                                                            'orderedList',
                                                            'redo',
                                                            'strike',
                                                            'undo',
                                                        ]),
                                                    FileUpload::make('peluang_image')->label('Gambar')->disk('public')
                                                        ->directory('settings/gambar')
                                                        ->hintIcon('heroicon-m-photo')
                                                        ->required(),
                                                    Repeater::make('peluang_button')->label('Button')
                                                        ->schema([
                                                            TextInput::make('btn_name')->label('Nama Button'),
                                                            Textarea::make('btn_desc')->label('Deskripsi Button'),
                                                            TextInput::make('btn_link')->label('URL Button'),
                                                            FileUpload::make('btn_icon')->label('Icon Button')->disk('public')
                                                                ->directory('settings/icon')
                                                                ->imageCropAspectRatio('1:1')
                                                                ->image()
                                                                ->imageResizeTargetWidth('32')
                                                                ->imageResizeTargetHeight('32')
                                                                ->hint('format icon .png')
                                                                ->hintIcon('heroicon-m-photo')
                                                                ->required()
                                                        ]),

                                                ]),
                                            ]),
                                        Tabs\Tab::make('Profil Settings')
                                            ->icon('heroicon-s-chevron-right') // Optional icon
                                            ->schema([
                                                //Settings Profil Jateng

                                                Card::make()->schema([
                                                    Placeholder::make('biaya')->label('Profil Jawa Tengah.'),
                                                    TextInput::make('jateng_title')->label('Title'),
                                                    RichEditor::make('jateng_desc')->label('Deskripsi')
                                                        ->toolbarButtons([
                                                            'attachFiles',
                                                            'blockquote',
                                                            'bold',
                                                            'bulletList',
                                                            'codeBlock',
                                                            'h2',
                                                            'h3',
                                                            'italic',
                                                            'link',
                                                            'orderedList',
                                                            'redo',
                                                            'strike',
                                                            'undo',
                                                        ]),
                                                    FileUpload::make('jateng_image')->label('Gambar')->disk('public')
                                                        ->directory('settings/gambar')
                                                        ->image()
                                                        ->maxSize(1024)
                                                        ->hint('File Maksimal 1 Mb')
                                                        ->hintIcon('heroicon-m-photo')
                                                        ->required(),


                                                    // Settings Sumber Daya Manusia
                                                    Placeholder::make('sdm')->label('Sumber Daya Manusia.'),
                                                    Card::make()->schema([
                                                        TextInput::make('sdm_title')->label('Title'),
                                                        RichEditor::make('sdm_desc')->label('Deskripsi')
                                                            ->toolbarButtons([
                                                                'attachFiles',
                                                                'blockquote',
                                                                'bold',
                                                                'bulletList',
                                                                'codeBlock',
                                                                'h2',
                                                                'h3',
                                                                'italic',
                                                                'link',
                                                                'orderedList',
                                                                'redo',
                                                                'strike',
                                                                'undo',
                                                            ]),
                                                        FileUpload::make('sdm_image')->label('Gambar')->disk('public')
                                                            ->directory('settings/gambar')
                                                            ->image()
                                                            ->maxSize(1024)
                                                            ->hint('File Maksimal 1 Mb')
                                                            ->hintIcon('heroicon-m-photo')
                                                            ->required()
                                                    ]),

                                                    // Settings UMK
                                                    Placeholder::make('umk')->label('UMK.'),
                                                    Card::make()->schema([
                                                        TextInput::make('umk_title')->label('Title'),
                                                        RichEditor::make('umk_desc')->label('Deskripsi')
                                                            ->toolbarButtons([
                                                                'attachFiles',
                                                                'blockquote',
                                                                'bold',
                                                                'bulletList',
                                                                'codeBlock',
                                                                'h2',
                                                                'h3',
                                                                'italic',
                                                                'link',
                                                                'orderedList',
                                                                'redo',
                                                                'strike',
                                                                'undo',
                                                            ]),
                                                        FileUpload::make('umk_image')->label('Gambar')->disk('public')
                                                            ->directory('settings/gambar')
                                                            ->image()
                                                            ->maxSize(1024)
                                                            ->hint('File Maksimal 1 Mb')
                                                            ->hintIcon('heroicon-m-photo')
                                                            ->required()
                                                    ]),

                                                    // Settings Biaya Investasi
                                                    Placeholder::make('biaya')->label('Biaya Investasi.'),
                                                    Card::make()->schema([
                                                        TextInput::make('biaya_title')->label('Title'),
                                                        RichEditor::make('biaya_desc')->label('Deskripsi')
                                                            ->toolbarButtons([
                                                                'attachFiles',
                                                                'blockquote',
                                                                'bold',
                                                                'bulletList',
                                                                'codeBlock',
                                                                'h2',
                                                                'h3',
                                                                'italic',
                                                                'link',
                                                                'orderedList',
                                                                'redo',
                                                                'strike',
                                                                'undo',
                                                            ]),
                                                        FileUpload::make('biaya_image')->label('Gambar')->disk('public')
                                                            ->directory('settings/gambar')
                                                            ->image()
                                                            ->maxSize(1024)
                                                            ->hint('File Maksimal 1 Mb')
                                                            ->hintIcon('heroicon-m-photo')
                                                            ->required()
                                                    ])
                                                ])->columns(1),
                                            ]),
                                        Tabs\Tab::make('Syarat & Ketentuan Settings')
                                            ->icon('heroicon-s-chevron-right') // Optional icon
                                            ->schema([
                                                RichEditor::make('body')->label('Body')
                                                    ->toolbarButtons([
                                                        'attachFiles',
                                                        'blockquote',
                                                        'bold',
                                                        'bulletList',
                                                        'codeBlock',
                                                        'h2',
                                                        'h3',
                                                        'italic',
                                                        'link',
                                                        'orderedList',
                                                        'redo',
                                                        'strike',
                                                        'undo',
                                                    ]),
                                            ]),
                                        Tabs\Tab::make('Layanan Informasi Settings')
                                            ->icon('heroicon-s-chevron-right') // Optional icon
                                            ->schema([
                                                Repeater::make('services')
                                                    ->schema([
                                                        TextInput::make('name'),
                                                        TextInput::make('no_hp'),
                                                    ])
                                            ]),
                                    ]),
                            ]),

                        // English translation

                        Tabs\Tab::make('EN') // Optional icon
                            ->schema([
                                Tabs::make('Heading')
                                    ->tabs([
                                        Tabs\Tab::make('General Settings En')
                                            ->icon('heroicon-s-chevron-right') // Optional icon
                                            ->schema([
                                                // Settings General
                                                Card::make()->schema([
                                                    Grid::make()->schema([
                                                        TextInput::make('site_name_en')->label('Site Name En'),
                                                        TextInput::make('site_tagline_en')->label('Tagline En'),
                                                    ])->columns(2),
                                                    RichEditor::make('site_desc_en')->label('Site Description En')
                                                        ->toolbarButtons([
                                                            'attachFiles',
                                                            'blockquote',
                                                            'bold',
                                                            'bulletList',
                                                            'codeBlock',
                                                            'h2',
                                                            'h3',
                                                            'italic',
                                                            'link',
                                                            'orderedList',
                                                            'redo',
                                                            'strike',
                                                            'undo',
                                                        ]),
                                                ]),

                                            ]),
                                        Tabs\Tab::make('Opening Settings En')
                                            ->icon('heroicon-s-chevron-right') // Optional icon
                                            ->schema([
                                                // Settings Opening
                                                Card::make()->schema([
                                                    TextInput::make('opening_title_en')->label('Title En'),
                                                    RichEditor::make('opening_desc_en')->label('Deskripsi En')
                                                        ->toolbarButtons([
                                                            'attachFiles',
                                                            'blockquote',
                                                            'bold',
                                                            'bulletList',
                                                            'codeBlock',
                                                            'h2',
                                                            'h3',
                                                            'italic',
                                                            'link',
                                                            'orderedList',
                                                            'redo',
                                                            'strike',
                                                            'undo',
                                                        ]),

                                                ])->columnSpan(2),
                                                Card::make()->schema([

                                                    Repeater::make('opening_button_en')->label('Button En')
                                                        ->schema([
                                                            Grid::make()->schema([
                                                                TextInput::make('btn_name_en')->label('Nama Button En'),
                                                                TextInput::make('btn_link_en')->label('URL Button En')->url(),
                                                            ])->columns(2)
                                                        ])
                                                ])
                                            ]),
                                        Tabs\Tab::make('Graph Settings En')
                                            ->icon('heroicon-s-chevron-right') // Optional icon
                                            ->schema([
                                                // Settings graph
                                                Card::make()->schema([
                                                    Grid::make()->schema([
                                                        Grid::make()->schema([
                                                            Placeholder::make('graph')->label('Pertumbuhan Ekonomi En'),
                                                            TextInput::make('graph_title_pert_en')->label('Title En')->placeholder('Pertumbuhan Ekonomi'),
                                                            RichEditor::make('graph_desc_pert_en')->label('Deskripsi En')
                                                                ->toolbarButtons([
                                                                    'attachFiles',
                                                                    'blockquote',
                                                                    'bold',
                                                                    'bulletList',
                                                                    'codeBlock',
                                                                    'h2',
                                                                    'h3',
                                                                    'italic',
                                                                    'link',
                                                                    'orderedList',
                                                                    'redo',
                                                                    'strike',
                                                                    'undo',
                                                                ]),
                                                        ])->columns(1)
                                                    ])->columnSpan(1),
                                                    Grid::make()->schema([
                                                        Grid::make()->schema([
                                                            Placeholder::make('graph')->label('Performa Investasi En'),
                                                            TextInput::make('graph_title_perf_en')->label('Title En')->placeholder('Performa Investasi'),
                                                            RichEditor::make('graph_desc_perf_en')->label('Deskripsi En')
                                                                ->toolbarButtons([
                                                                    'attachFiles',
                                                                    'blockquote',
                                                                    'bold',
                                                                    'bulletList',
                                                                    'codeBlock',
                                                                    'h2',
                                                                    'h3',
                                                                    'italic',
                                                                    'link',
                                                                    'orderedList',
                                                                    'redo',
                                                                    'strike',
                                                                    'undo',
                                                                ]),
                                                        ])->columns(1)
                                                    ])->columnSpan(1)
                                                ])->columns(2),
                                            ]),
                                        Tabs\Tab::make('Peluang Settings En')
                                            ->icon('heroicon-s-chevron-right') // Optional icon
                                            ->schema([
                                                // Settings Peluang
                                                Card::make()->schema([
                                                    TextInput::make('peluang_title_en')->label('Title En'),
                                                    RichEditor::make('peluang_desc_en')->label('Deskripsi En')
                                                        ->toolbarButtons([
                                                            'attachFiles',
                                                            'blockquote',
                                                            'bold',
                                                            'bulletList',
                                                            'codeBlock',
                                                            'h2',
                                                            'h3',
                                                            'italic',
                                                            'link',
                                                            'orderedList',
                                                            'redo',
                                                            'strike',
                                                            'undo',
                                                        ]),

                                                    Repeater::make('peluang_button_en')->label('Button En')
                                                        ->schema([
                                                            TextInput::make('btn_name_en')->label('Nama Button En'),
                                                            Textarea::make('btn_desc_en')->label('Deskripsi Button En'),
                                                            TextInput::make('btn_link_en')->label('URL Button En'),

                                                        ]),

                                                ]),
                                            ]),
                                        Tabs\Tab::make('Profil Settings En')
                                            ->icon('heroicon-s-chevron-right') // Optional icon
                                            ->schema([
                                                //Settings Profil Jateng

                                                Card::make()->schema([
                                                    Placeholder::make('biaya')->label('Profil Jawa Tengah En'),
                                                    TextInput::make('jateng_title_en')->label('Title En'),
                                                    RichEditor::make('jateng_desc_en')->label('Deskripsi En')
                                                        ->toolbarButtons([
                                                            'attachFiles',
                                                            'blockquote',
                                                            'bold',
                                                            'bulletList',
                                                            'codeBlock',
                                                            'h2',
                                                            'h3',
                                                            'italic',
                                                            'link',
                                                            'orderedList',
                                                            'redo',
                                                            'strike',
                                                            'undo',
                                                        ]),

                                                    // Settings Sumber Daya Manusia
                                                    Placeholder::make('sdm')->label('Sumber Daya Manusia En'),
                                                    Card::make()->schema([
                                                        TextInput::make('sdm_title_en')->label('Title En'),
                                                        RichEditor::make('sdm_desc_en')->label('Deskripsi En')
                                                            ->toolbarButtons([
                                                                'attachFiles',
                                                                'blockquote',
                                                                'bold',
                                                                'bulletList',
                                                                'codeBlock',
                                                                'h2',
                                                                'h3',
                                                                'italic',
                                                                'link',
                                                                'orderedList',
                                                                'redo',
                                                                'strike',
                                                                'undo',
                                                            ]),

                                                    ]),

                                                    // Settings UMK
                                                    Placeholder::make('umk')->label('UMK En'),
                                                    Card::make()->schema([
                                                        TextInput::make('umk_title_en')->label('Title En'),
                                                        RichEditor::make('umk_desc_en')->label('Deskripsi En')
                                                            ->toolbarButtons([
                                                                'attachFiles',
                                                                'blockquote',
                                                                'bold',
                                                                'bulletList',
                                                                'codeBlock',
                                                                'h2',
                                                                'h3',
                                                                'italic',
                                                                'link',
                                                                'orderedList',
                                                                'redo',
                                                                'strike',
                                                                'undo',
                                                            ]),

                                                    ]),

                                                    // Settings Biaya Investasi
                                                    Placeholder::make('biaya')->label('Biaya Investasi En'),
                                                    Card::make()->schema([
                                                        TextInput::make('biaya_title_en')->label('Title'),
                                                        RichEditor::make('biaya_desc_en')->label('Deskripsi En')
                                                            ->toolbarButtons([
                                                                'attachFiles',
                                                                'blockquote',
                                                                'bold',
                                                                'bulletList',
                                                                'codeBlock',
                                                                'h2',
                                                                'h3',
                                                                'italic',
                                                                'link',
                                                                'orderedList',
                                                                'redo',
                                                                'strike',
                                                                'undo',
                                                            ]),

                                                    ])
                                                ])->columns(1),

                                            ]),
                                        Tabs\Tab::make('Syarat & Ketentuan Settings En')
                                            ->icon('heroicon-s-chevron-right') // Optional icon
                                            ->schema([
                                                RichEditor::make('body_en')->label('Body En')
                                                    ->toolbarButtons([
                                                        'attachFiles',
                                                        'blockquote',
                                                        'bold',
                                                        'bulletList',
                                                        'codeBlock',
                                                        'h2',
                                                        'h3',
                                                        'italic',
                                                        'link',
                                                        'orderedList',
                                                        'redo',
                                                        'strike',
                                                        'undo',
                                                    ]),
                                            ]),
                                        Tabs\Tab::make('Layanan Informasi Settings En')
                                            ->icon('heroicon-s-chevron-right') // Optional icon
                                            ->schema([
                                                Repeater::make('services_en')
                                                    ->schema([
                                                        TextInput::make('name'),
                                                        TextInput::make('no_hp'),
                                                    ])
                                            ]),
                                    ]),
                            ]),
                    ]),
            ])->columns(1)
        ];
    }
}
