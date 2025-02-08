<?php

namespace App\Filament\Clusters\Cjip\Resources\FaqResource\Pages;

use App\Filament\Clusters\Cjip\Resources\FaqResource;
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
