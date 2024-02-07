<?php

namespace App\Filament\Resources\Cjip\FaqResource\Pages;

use App\Filament\Resources\Cjip\FaqResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateFaq extends CreateRecord
{
    use CreateRecord\Concerns\Translatable;
    protected static string $resource = FaqResource::class;

    public static function getTranslatableLocales(): array
    {
        return ['en', 'id'];
    }
    
    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            // ...
        ];
    }
}
