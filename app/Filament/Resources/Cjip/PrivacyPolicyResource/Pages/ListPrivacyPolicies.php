<?php

namespace App\Filament\Resources\Cjip\PrivacyPolicyResource\Pages;

use App\Filament\Resources\Cjip\PrivacyPolicyResource;
use Filament\Actions;
use Filament\Actions\LocaleSwitcher;
use Filament\Resources\Pages\ListRecords;

class ListPrivacyPolicies extends ListRecords
{
    use ListRecords\Concerns\Translatable;
    protected static string $resource = PrivacyPolicyResource::class;

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
