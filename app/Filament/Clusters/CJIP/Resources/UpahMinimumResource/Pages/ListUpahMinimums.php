<?php

namespace App\Filament\Clusters\CJIP\Resources\UpahMinimumResource\Pages;

use App\Filament\Clusters\CJIP\Resources\UpahMinimumResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListUpahMinimums extends ListRecords
{
    protected static string $resource = UpahMinimumResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
