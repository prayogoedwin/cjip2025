<?php

namespace App\Filament\Clusters\Cjip\Resources\PrivacyPolicyResource\Pages;

use App\Filament\Clusters\Cjip\Resources\PrivacyPolicyResource;
use Filament\Actions;
use Filament\Actions\LocaleSwitcher;
use Filament\Resources\Pages\EditRecord;
use Locale;

class EditPrivacyPolicy extends EditRecord
{
    use EditRecord\Concerns\Translatable;
    protected static string $resource = PrivacyPolicyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            LocaleSwitcher::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
