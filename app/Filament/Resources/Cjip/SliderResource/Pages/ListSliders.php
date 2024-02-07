<?php

namespace App\Filament\Resources\Cjip\SliderResource\Pages;

use App\Filament\Resources\Cjip\SliderResource;
use Filament\Actions;
use Filament\Actions\LocaleSwitcher;
use Filament\Resources\Pages\ListRecords;

class ListSliders extends ListRecords
{
    use ListRecords\Concerns\Translatable;
    protected static string $resource = SliderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            LocaleSwitcher::make(),
            Actions\CreateAction::make(),
        ];
    }
    public static function getTranslatableLocales(): array
    {
        return ['id', 'en'];
    }
}
