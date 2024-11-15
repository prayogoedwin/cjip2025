<?php

namespace App\Filament\Clusters\CJIP\Resources\FaqResource\Pages;

use App\Filament\Clusters\CJIP\Resources\FaqResource;
use Filament\Actions;
use Filament\Actions\LocaleSwitcher;
use Filament\Resources\Pages\EditRecord;

class EditFaq extends EditRecord
{
    use EditRecord\Concerns\Translatable;
    protected static string $resource = FaqResource::class;

    protected function getHeaderActions(): array
    {
        return [
            LocaleSwitcher::make(),
            Actions\DeleteAction::make(),
        ];
    }
    public static function getTranslatableLocales(): array
    {
        return ['en', 'id'];
    }
}
