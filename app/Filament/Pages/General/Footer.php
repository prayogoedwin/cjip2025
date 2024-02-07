<?php

namespace App\Filament\Pages\General;

use App\Settings\FooterSettings;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;
use BladeUI\Icons\Components\Icon;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Pages\SettingsPage;

class Footer extends SettingsPage
{
    use HasPageShield;

    // protected static ?string $navigationIcon = 'heroicon-s-cog';

    protected static string $settings = FooterSettings::class;

    protected static ?int $navigationSort = 20;

    protected static ?string $navigationGroup = 'Cjip';

    protected function getFormSchema(): array
    {
        return [
            Grid::make()->schema([
                Tabs::make('Heading')
                    ->tabs([
                        Tabs\Tab::make('ID')
                            ->schema([
                                Tabs::make('Heading')
                                    ->tabs([
                                        Tabs\Tab::make('Contacts')
                                            ->icon('heroicon-s-identification')
                                            ->schema([
                                                Card::make()->schema([
                                                    Grid::make()->schema([
                                                        TextInput::make('copyright'),
                                                        TextInput::make('email')->email(),
                                                        TextInput::make('contact')->tel()
                                                    ])->columns(3),
                                                    Grid::make()->schema([
                                                        Textarea::make('alamat')
                                                    ])->columns(1),
                                                ]),
                                            ]),
                                        Tabs\Tab::make('Links')
                                            ->icon('heroicon-s-link')
                                            ->schema([
                                                Card::make()->schema([
                                                    Repeater::make('links')
                                                        ->schema([
                                                            TextInput::make('name'),
                                                            TextInput::make('url')->url()->hint('URL Link'),
                                                            Textarea::make('desc')->label('Deskripsi Link'),
                                                        ])
                                                ])->columnSpan(1),
                                            ]),
                                        Tabs\Tab::make('Sosmeds')
                                            ->icon('heroicon-s-globe-alt') // Optional icon
                                            ->schema([
                                                Card::make()->schema([
                                                    Repeater::make('medsos')->schema([
                                                        TextInput::make('name'),
                                                        FileUpload::make('medsos_image')->image()->imageCropAspectRatio('1:1')->imagePreviewHeight(50)->maxSize(100),
                                                        // SpatieMediaLibraryFileUpload::make('medsos_image')
                                                        //     ->collection('medsos')
                                                        //     ->image()
                                                        //     ->imageCropAspectRatio('1:1')
                                                        //     ->imagePreviewHeight(50)
                                                        //     ->maxSize(100),
                                                        TextInput::make('url')
                                                            ->hint('URL profile medsos')
                                                    ]),
                                                ])->columnSpan(1),
                                            ]),
                                    ]),
                            ]),
                        Tabs\Tab::make('EN')
                            ->schema([
                                Tabs::make('Heading')
                                    ->tabs([
                                        Tabs\Tab::make('Contacts')
                                            ->icon('heroicon-s-identification')
                                            ->schema([
                                                Card::make()->schema([
                                                    Grid::make()->schema([
                                                        TextInput::make('copyright_en'),
                                                        TextInput::make('email_en')->email(),
                                                        TextInput::make('contact_en')->tel()
                                                    ])->columns(3),
                                                    Grid::make()->schema([
                                                        Textarea::make('alamat_en')
                                                    ])->columns(1),
                                                ]),
                                            ]),
                                        Tabs\Tab::make('Links')
                                            ->icon('heroicon-s-link')
                                            ->schema([
                                                Card::make()->schema([
                                                    Repeater::make('links_en')
                                                        ->schema([
                                                            TextInput::make('name_en'),
                                                            TextInput::make('url_en')->url()->hint('URL Link'),
                                                            Textarea::make('desc_en')->label('Deskripsi Link'),
                                                        ])
                                                ])->columnSpan(1),
                                            ]),
                                        Tabs\Tab::make('Sosmeds')
                                            ->icon('heroicon-s-globe-alt') // Optional icon
                                            ->schema([
                                                Card::make()->schema([
                                                    Repeater::make('medsos_en')->schema([
                                                        TextInput::make('name_en'),
                                                        FileUpload::make('medsos_image_en')->image()->imageCropAspectRatio('1:1')->imagePreviewHeight(50)->maxSize(100),
                                                        // SpatieMediaLibraryFileUpload::make('medsos_image')
                                                        //     ->collection('medsos')
                                                        //     ->image()
                                                        //     ->imageCropAspectRatio('1:1')
                                                        //     ->imagePreviewHeight(50)
                                                        //     ->maxSize(100),
                                                        TextInput::make('url_en')
                                                            ->hint('URL profile medsos')
                                                    ]),
                                                ])->columnSpan(1),
                                            ]),
                                    ]),
                            ]),

                    ])
            ])->columns(1)
        ];
    }
}
