<?php

namespace App\Filament\Resources\Pengguna\FeatureResource\Pages;

use App\Filament\Resources\Pengguna\FeatureResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFeature extends EditRecord
{
    protected static string $resource = FeatureResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
