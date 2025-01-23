<?php

namespace App\Filament\Clusters\Cjip\Resources\FaqResource\Pages;

use App\Filament\Clusters\Cjip\Resources\FaqResource;
use Filament\Actions;
use Filament\Actions\LocaleSwitcher;
use Filament\Resources\Pages\ListRecords;
use Locale;

class ListFaqs extends ListRecords
{

    use ListRecords\Concerns\Translatable;
    protected static string $resource = FaqResource::class;

    protected function getHeaderActions(): array
    {
        return [
            LocaleSwitcher::make(),
            Actions\CreateAction::make(),
        ];
    }
    public static function getTranslatableLocales(): array
    {
        return ['en', 'id'];
    }
}
