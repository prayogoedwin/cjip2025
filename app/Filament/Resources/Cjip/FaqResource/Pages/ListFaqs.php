<?php

namespace App\Filament\Resources\Cjip\FaqResource\Pages;

use App\Filament\Resources\Cjip\FaqResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFaqs extends ListRecords
{
    use ListRecords\Concerns\Translatable;
    protected static string $resource = FaqResource::class;

    public static function getTranslatableLocales(): array
    {
        return ['id', 'en'];
    }
    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\CreateAction::make(),
        ];
    }
}
