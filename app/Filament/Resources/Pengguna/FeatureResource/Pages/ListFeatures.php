<?php

namespace App\Filament\Resources\Pengguna\FeatureResource\Pages;

use App\Filament\Resources\Pengguna\FeatureResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFeatures extends ListRecords
{
    protected static string $resource = FeatureResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
