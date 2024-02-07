<?php

namespace App\Filament\Resources\Cjip\PrivacyPolicyResource\Pages;

use App\Filament\Resources\Cjip\PrivacyPolicyResource;
use Filament\Actions;
use Filament\Actions\LocaleSwitcher;
use Filament\Resources\Pages\CreateRecord;

class CreatePrivacyPolicy extends CreateRecord
{
    use CreateRecord\Concerns\Translatable;
    protected static string $resource = PrivacyPolicyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            LocaleSwitcher::make(),
        ];
    }

    public static function getTranslatableLocales(): array
    {
        return ['en', 'id'];
    }
}
