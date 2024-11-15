<?php

namespace App\Filament\Pages\General;

use App\Filament\Clusters\CJIP;
use App\Settings\CjibfSettings;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Pages\SettingsPage;

class ManageCjibf extends SettingsPage
{
    use HasPageShield;

    // protected static ?string $navigationIcon = 'heroicon-s-cog';

    protected static ?string $navigationGroup = 'CJIBF';

    protected static ?string $navigationLabel = 'Manage Cjibf';

    protected static ?string $cluster = CJIP::class;

    protected static ?int $navigationSort = 1;

    protected static ?string $pluralLabel = 'Cjibf Settings';

    protected static string $settings = CjibfSettings::class;

    protected function getFormSchema(): array
    {
        return [

            Grid::make()->schema([
                Tabs::make('Heading')
                    ->tabs([
                        Tabs\Tab::make('Banners')
                            ->icon('heroicon-m-computer-desktop')
                            ->schema([
                                TextInput::make('site_title')->label('Title'),
                                TextInput::make('site_desc')->label('Description'),
                                TextInput::make('site_tagline')->label('Tagline')->hidden(),
                                FileUpload::make('logo')->label('Logo')->disk('public')->directory('cjibf/logo/'),
                                Repeater::make('image')
                                    ->schema([
                                        FileUpload::make('image')->label('Image')->disk('public')->directory('cjibf/image/')
                                    ]),
                                Repeater::make('button')->label('Button')
                                    ->schema([
                                        TextInput::make('btn_name')->label('Nama Button'),
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
                                            ->hidden()
                                    ]),
                            ]),
                        Tabs\Tab::make('Label 1')
                            ->icon('heroicon-s-cog')
                            ->schema([
                                // ...
                            ]),
                        Tabs\Tab::make('Label 2')
                            ->icon('heroicon-s-cog')
                            ->schema([
                                // ...
                            ]),
                    ])
            ])->columns(1)
        ];
    }
}