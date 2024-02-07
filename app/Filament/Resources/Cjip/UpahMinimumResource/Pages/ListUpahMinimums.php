<?php

namespace App\Filament\Resources\Cjip\UpahMinimumResource\Pages;

use App\Filament\Resources\Cjip\UpahMinimumResource;
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
