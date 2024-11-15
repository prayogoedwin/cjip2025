<?php

namespace App\Filament\Clusters\CJIP\Resources\PrivacyPolicyResource\Pages;

use App\Filament\Clusters\CJIP\Resources\PrivacyPolicyResource;
use Filament\Actions;
use Filament\Actions\LocaleSwitcher;
use Filament\Resources\Pages\ListRecords;
use Locale;

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
}
